# coding: utf-8
#
#    Copyright (C) 2014 Savoir-faire Linux Inc. (<www.savoirfairelinux.com>).
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as
#    published by the Free Software Foundation, either version 3 of the
#    License, or (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
#
from __future__ import unicode_literals
import os.path as op
import time

from fabric.api import env, task
from fabric.colors import red
from fabric.utils import abort

# http://gitlab.savoirfairelinux.com/virgil.dupras/sfl-fablib
import fablib
import fablib_docker

PROJECT_NAME = 'feast'
DB_NAME = 'mowdata'

env.roledefs['local'] = ["local@local"]

if not env.roles:
    print "No specified role. 'local' by default."
    env.roles = ['local']

role = env.roles[0]
PROJECT_ROOT = {
    'local': op.dirname(op.dirname(__file__)),
}[role]
env.PROJECT_ROOT = PROJECT_ROOT

PROJECT_URL = {
    'local': 'http://localhost',
}[role]

PROJECT_PORT = {
    'local': 80,
}[role]

fablib.set_env_helpers(env, remote=False)

def imgname(basename):
    return 'sfl-%s-%s' % (PROJECT_NAME, basename)

def contname(basename, suffix='run'):
    return 'sfl-%s-%s-%s-%s' % (PROJECT_NAME, role, basename, suffix)

ALL_CONTAINERS = [
    contname('apache'),
    contname('mysql'),
]

DATA_CONTAINERS = [
    contname('mysql', suffix='data'),
]

@task
def make_images():
    with env.cd(op.join(PROJECT_ROOT, 'tools')):
        env.run('docker build -t %s apache/' % imgname('apache'))
        env.run('docker pull mariadb')

@task
def clean(only=None, withdata=False):
    if only:
        containers = [contname(only)]
    else:
        containers = ALL_CONTAINERS
    if withdata:
        containers += DATA_CONTAINERS
    for containername in containers:
        if containername in fablib_docker.ps(env, running_only=True):
            print red("%s is still running. You have to stop the container first!" % containername)
            print red("Run fab stop")
            continue
        if containername not in fablib_docker.ps(env):
            print "%s doesn't exist, skipping" % containername
            continue
        env.run('docker rm -v %s' % containername)

@task
def start(port=None):
    if not port:
        port = PROJECT_PORT
    created = fablib_docker.ensure_data_container(
        env,
        contname('mysql', suffix='data'),
        base_image='dockerfile/mariadb',
    )
    fablib_docker.tryrun(
        env,
        'dockerfile/mariadb',
        contname('mysql'),
        '-d --volumes-from %s' % contname('mysql', suffix='data'),
    )
    if created:
        # If a freshly created container, we have to create a new DB.
        time.sleep(2)
        fablib_docker.tryrun(
            env,
            'dockerfile/mariadb',
            contname('mysql-cmd'),
            '-it --rm --link %s:mysql' % contname('mysql'),
            cmd='bash -c \'mysqladmin -h mysql create %s\'' % DB_NAME,
            restart=False,
        )
    fablib_docker.tryrun(
        env,
        imgname('apache'),
        contname('apache'),
        '-d -p %s:80 --link %s:mysql' % (
            port,
            contname('mysql'),
        ),
        mounts=[
            ('src', '/var/www', False),
        ]
    )

@task
def stop(only=None, clean=True):
    if only:
        containers = [contname(only)]
    else:
        containers = ALL_CONTAINERS
    for containername in containers:
        if containername in fablib_docker.ps(env, running_only=True):
            env.run('docker kill %s' % containername)
            if clean:
                env.run('docker rm -v %s' % containername)

@task
def dumpdb():
    if fablib_docker.ensureruns(env, contname('mysql')):
        fablib_docker.mysql_dump(env, DB_NAME, 'dump', target_container=contname('mysql'))
    else:
        abort("Can't dumpdb: mysql container doesn't exist!")

@task
def loaddb():
    fablib_docker.mysql_load(env, DB_NAME, 'dump', target_container=contname('mysql'))

@task
def chpass(username='kateri', password='foobar'):
    print "Changing password for user '%s' to '%s'" % (username, password)
    cmd = "update usr_settings set md5phash=MD5('%s') where usrname='%s'" % (password, username)
    fablib_docker.mysql_run(env, cmd, DB_NAME, target_container=contname('mysql'))

