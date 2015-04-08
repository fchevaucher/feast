# coding: utf-8
#
#    Copyright (C) 2015 Savoir-faire Linux Inc. (<www.savoirfairelinux.com>).
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

#********************************
# WARNING WARNING WARNING
#********************************

# This is a *library* unit, copied from:
# http://gitlab.savoirfairelinux.com/virgil.dupras/sfl-fablib
# Copying the unit around, for Fabric utilities, is the easiest way to go.

# This means that:
# 1. Once in a while, think about updating this file.
# 2. If you modify this file, you *have* to merge it back into the source repo

#********************************
# END WARNING
#********************************

from __future__ import unicode_literals

import os.path as op

from fabric.colors import red, green
from fabric.utils import abort

def ps(env, running_only=False):
    args = '' if running_only else '-a'
    result = env.run('docker ps %s' % args, capture=True)
    lines = result.stdout.splitlines()
    # container name is supposed to be the last column
    assert lines[0].strip().endswith('NAMES')
    return [line.strip().split(' ')[-1] for line in lines[1:]]

def tryrun(env, imgname, containername=None, opts='', mounts=[], cmd='', restart=True):
    # mounts is a list of (from, to, canwrite) path tuples. ``from`` is relative to the project root.
    # Returns True if the container was effectively ran (false if it was restarted or aborted)
    if mounts and not hasattr(env, 'PROJECT_ROOT'):
        print red("You need to set env.PROJECT_ROOT to use mounts.")
        raise Exception()
    if containername and containername in ps(env, running_only=True):
        print green("%s already running" % containername)
        return False
    if containername and containername in ps(env, running_only=False):
        if restart:
            print green("%s already exists and is stopped. Restarting!" % containername)
            env.run('docker restart %s' % containername)
        else:
            print red("There's a dangling container %s! That's not supposed to happen. Aborting" % containername)
            print "Run 'docker rm %s' to remove that container" % containername
        return False
    for from_path, to_path, canwrite in mounts:
        abspath = from_path if from_path.startswith('/') else op.join(env.PROJECT_ROOT, from_path)
        opt = ' -v %s:%s' % (abspath, to_path)
        if not canwrite:
            opt += ':ro'
        opts += opt
    if containername:
        containername_opt = '--name %s' % containername
    else:
        containername_opt = ''
    env.run('docker run %s %s %s %s' % (opts, containername_opt, imgname, cmd))
    return True

def ensureruns(env, containername):
    # Makes sure that containername runs. If it doesn't, try restarting it. If the container
    # doesn't exist, spew an error.
    if containername not in ps(env, running_only=True):
        if containername in ps(env, running_only=False):
            env.run('docker restart %s' % containername)
            return True
        else:
            return False
    else:
        return True

def ensure_data_container(env, containername, volume_paths=None, base_image='busybox'):
    # Make sure that we have our data containers running. Data containers are *never* removed.
    # Their only purpose is to hold volume data.
    # Returns whether a container was created by this call
    if containername not in ps(env, running_only=False):
        if volume_paths:
            volume_args = ' '.join('-v %s' % volpath for volpath in volume_paths)
        else:
            volume_args = ''
        env.run('docker create %s --name %s %s' % (volume_args, containername, base_image))
        return True
    return False

def isrunning(env, containername):
    # Check if the containername is running.
    if containername not in ps(env, running_only=True):
        return False
    else:
        return True

def fixperms(env, target_folder, target_pattern=None):
    # We used to use os.getuid() and os.getgid() but it didn't work remotely. That's why we use
    # the command line here.
    uid = env.run('id -u', capture=True).stdout
    gid = env.run('id -g', capture=True).stdout
    if target_pattern:
        target = op.join('/data', target_pattern)
    else:
        target = '/data'
    tryrun(
        env,
        'ubuntu:trusty',
        containername=None,
        opts='--rm',
        cmd='chown -R %s:%s %s' % (uid, gid, target),
        mounts=[(target_folder, '/data', True)]
    )

def mysql_run(env, cmd, dbname, target_container):
    # Always use single quotes (') in your SQL code.
    cmd = cmd.replace("'", "'\\''")
    tryrun(
        env,
        'dockerfile/mariadb',
        None,
        '-it --rm --link %s:mysql' % target_container,
        cmd="bash -c 'mysql -h mysql -D %s --execute \"%s\"'" % (dbname, cmd),
        restart=False,
    )

def mysql_dump(env, dbname, dumpname, target_container):
    filename = '%s.sql.gz' % dumpname
    tmpname = '%s_tmp.sql.gz' % dumpname
    print green("Dumping SQL to %s" % filename)
    tryrun(
        env,
        'dockerfile/mariadb',
        opts='--rm --link %s:mysql' % target_container,
        cmd='bash -c \'mysqldump -h mysql %s | gzip -c > /tmp/%s\'' % (dbname, tmpname),
        restart=False,
        mounts=[
            ('tools/dumps', '/tmp', True),
        ]
    )
    fixperms(env, 'tools/dumps', tmpname)
    absroot = op.join(env.PROJECT_ROOT, 'tools', 'dumps')
    tmppath = op.join(absroot, tmpname)
    filepath = op.join(absroot, filename)
    filesize = int(env.run('stat --printf="%%s" %s' % tmppath, capture=True).stdout.strip())
    if filesize < 1000:
        abort("That dump is way too small! Something is wrong, aborting!")
    env.run('rm %s' % filepath)
    env.run('mv %s %s' % (tmppath, filepath))

def mysql_load(env, dbname, dumpname, target_container):
    filename = '%s.sql.gz' % dumpname
    print green("Loading SQL from %s" % filename)
    tryrun(
        env,
        'dockerfile/mariadb',
        opts='--rm --link %s:mysql' % target_container,
        cmd='bash -c \'gunzip -c /tmp/%s | mysql -h mysql -D %s\'' % (filename, dbname),
        restart=False,
        mounts=[
            ('tools/dumps', '/tmp/', False),
        ],
    )

