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
from subprocess import Popen

from fabric.api import local, settings, run, cd, lcd, sudo
from fabric.contrib.files import exists
from fabric.colors import green
from fabric.operations import get

def add_vagrant_ssh_key():
    """Adds Vagrant's insecure key to SSH's keys

    Vagrant uses a public "insecure key" to manage connections to its VMs. This key insn't, by
    default, added to SSH's keys. If we want to connect to our VM, we need to add it first, which
    is what we do here.

    WARNING: If our host machine has never run vagrant at all, this key will not exist and this
    function will fail. Only call this after you've called a vagrant command yourself at least once.
    """
    if not op.exists(op.expanduser('~/.ssh/config')):
        print "Your ~/.ssh/config file doesn't exist and needs to exist for ssh-add to work. Creating an empty config"
        with open(op.expanduser('~/.ssh/config'), 'wt') as fp:
            fp.write("IdentityFile ~/.ssh/id_rsa")
    local('ssh-add %s' % op.expanduser('~/.vagrant.d/insecure_private_key'))

def add_local_host(hostname, ipaddr):
    """Tweaks /etc/hosts to make `hostname` point to `ipaddr`.

    Requires admin privilege.
    """
    if not op.exists('/etc/hosts'):
        print "Your system doesn't have a /etc/hosts. You need to manually make %s point to %s" % (hostname, ipaddr)
        return
    ETCHOSTS_LINE = "%s" % hostname
    if ETCHOSTS_LINE not in open('/etc/hosts', 'rt').read():
        print green("Adding %s to /etc/hosts." % hostname)
        local('echo "%s %s" | sudo tee -a /etc/hosts' % (ipaddr, hostname))
    else:
        print green("Adjusting %s in /etc/hosts." % hostname)
        local('sudo sed -i \'/ %s/c\\%s %s\' /etc/hosts' % (hostname, ipaddr, hostname))

def setup_tracking_branches(env, target_path):
    """Sets up git tracking branch for remote pushing.

    We add a remote set up with our current role's host (using our role's name as a remote name)
    and create a tracking branch to push on it.

    env: Fabric's environment
    target_path: The path on the remote machine where we want to push our stuff.
    """
    role = env.roles[0]
    print green("Setting up %s branches" % role)
    if ':' in env.host_string:
        # We can't have a SSH address with a port and path in it because we're going to have
        # something that looks like user@host:port:/my/path. However, git supports a SSH URL
        # in the form of ssh://user@host:port/my/path as long as the path is absolute. So we're
        # going to take advantage of this.
        giturl = 'ssh://%s%s' % (env.host_string, target_path)
    else:
        giturl = '%s:%s' % (env.host_string, target_path)
    with settings(warn_only=True):
        local("git remote add %s %s" % (role, giturl))
    local("git config remote.%s.fetch +refs/heads/master:refs/remotes/%s/master" % (role, role))
    local("git config remote.%s.push +refs/heads/%s:refs/heads/master" % (role, role))

def configure_remote_git_repo(env, target_path):
    """Sets up a remote repo so we can push in it.

    env: Fabric's environment
    target_path: The path on the remote machine where we want to push our stuff.
    """
    print green("Setting up %s remote configuration" % env.roles[0])
    if not exists(op.join(target_path, '.git')):
        print "Not git repo. Initializing."
        run("git init %s" % target_path)
    with cd(target_path):
        run("git config receive.denyCurrentBranch false")

def pushcode(env, target_path, commit='HEAD', chgrp_to=None, usesudo=False):
    """Push code from our local repo into the remote host.

    env: Fabric's environment
    target_path: The path on the remote machine where we want to push our stuff.
    commit: The commit we want to push.
    """
    if not commit:
        raise ValueError("Please specify a branch to push, ex: fab -R dev push:0.1.2")
    role = env.roles[0]
    setup_tracking_branches(env, target_path)
    configure_remote_git_repo(env, target_path)
    local("git branch -f %s %s" % (role, commit))
    local("git push %s" % role)
    with cd(target_path):
        run('git reset --hard %s' % commit)
    if chgrp_to:
        fixperm(target_path, chgrp_to, usesudo=usesudo)

def fixperm(target_path, chgrp_to, usesudo=False):
    runcmd = sudo if usesudo else run
    with cd(target_path):
        with settings(warn_only=True):
            runcmd('chgrp -R %s . --silent' % chgrp_to)
            runcmd('chmod -R g+w . --silent')
            runcmd('umask 002')
            # http://stackoverflow.com/questions/1321168/bash-scripting-how-to-set-the-group-that-new-files-will-be-created-with
            runcmd('chmod -R g+s . --silent')

def set_env_helpers(env, remote=True):
    """Sets a couple of helpers and put them in ``env``.

    Notably, we set ``env.run()`` and ``env.cd()`` which are alias to ``run()/cd()`` or
    ``local()/lcd()`` depending on whether ``remote`` is True.

    The signatures of those functions aren't exactly the same, but we try to make them fit.
    """
    if remote:
        def remote_run(*args, **kwargs):
            if kwargs.get('capture'):
                del kwargs['capture']
                kwargs['quiet'] = True
            return run(*args, **kwargs)
        env.cd = cd
        env.run = remote_run
    else:
        def local_run(*args, **kwargs):
            if kwargs.get('quiet'):
                del kwargs['quiet']
                kwargs['capture'] = True
            return local(*args, **kwargs)
        env.cd = lcd
        env.run = local_run

# --- Django related ---

def depcheck(base_path):
    """Checks for available PyPI updates within our dependencies."""
    with cd(base_path):
        run('./env/bin/pip install pip-tools')
        # for an unknown reason, if we directly execute ./env/bin/pip-review, it doesn't review
        # our virtualenv, but our global env. With an ectivate, it works as expected.
        run('. env/bin/activate && pip-review --local')

def dumpjson(remote_base_path, local_base_path, fixtures):
    """Refreshes out fixtures from our DB and copy them to the local machine.

    ``remote_base_path`` is the base Django path on the remote (the folder containing the
    manage.py file). ``local_base_path`` is the same thing, but locally.

    The ``fixture`` argument is a list of fixtures to dump. The format of each item of the list
    if ``(appname, models_to_dump, dest_fixture)``. Example:

    [
        ('myapp', ['Poll', 'Question'], 'initial_data'),
        ('otherapp', ['SomeModel'], 'initial_data'),
        ('flatpages_i18n', [], 'myapp/fixtures/flatpages.json'),
    ]

    ``dest_fixture`` can be either a json name (which will be expanded into a full path) or a full
    path, which will be left untouched.
    """

    with cd(remote_base_path):
        for app, models, dest in fixtures:
            if models:
                models_str = ' '.join('%s.%s' % (app, model) for model in models)
            else:
                models_str = app
            if '/' not in dest:
                # short dest, expand
                dest = '%s/fixtures/%s.json' % (app, dest)
            cmd = '../env/bin/python manage.py dumpdata %s | python -m json.tool > /tmp/fixture.json' % models_str
            run(cmd)
            ldest = op.join(local_base_path, dest)
            if op.exists(ldest):
                local('rm %s' % ldest)
            get('/tmp/fixture.json', ldest)

def django_develop(remote_base_path, instance_url):
    """Starts a debugging server the django way.

    On the guest machine, start a debugging server using "manage.py runserver" on the port 8080.

    Additionally, it starts a background "vagrant rsync-auto" so that changes you make to the
    project are automatically synced to the VM. The sync is not instantaneous. It can take about
    1 second for the sync to be triggered.
    """
    print green("Starting a parallel vagrant rsync-auto...")
    p = Popen(['vagrant', 'rsync-auto'])

    print green("Starting debug server. It is available from {}:8080".format(instance_url))

    with cd(remote_base_path):
        with settings(warn_only=True):
            try:
                run('../env/bin/python manage.py runserver 0.0.0.0:8080')
            except KeyboardInterrupt:
                print green("Server stopped by CTRL+C!")
    print green("Stopping vagrant rsync-auto...")
    p.terminate()

