# Feast-dev

## Install

Prerequisites:

1. [Docker 1.5+][docker]
2. [Fabric 1.8+][fabric]

Put the DB dump in `tools/dumps/dump.sql.gz`, and then:

    $ cd tools
    $ fab make_images
    $ fab start
    $ fab loaddb
    $ fab chpass

The site is now running on http://localhost/!

For a complete list of available commands, it's `fab -l`.

[docker]: https://www.docker.com/
[fabric]: http://www.fabfile.org/en/latest/

