# primaxwebgui - web interface for primax scanners #

## Introduction ##

**primaxwebgui** is a *very* simple web interface for easy scanning documents through a local network using a primax scanner hooked in a headless linux server.

## Dependencies ##

### Runtime ###

* Unix like operating systems (tested under Archlinux x86_64 and Ubuntu Server 12.04 LTS x86_84)
* On the server side, **primaxwebgui** requires a working webserver with php support and the primax binaries installed (tested under Apache 2.2 and php 5.4). 
* On the client side, all is needed is a modern browser with javascrit support.

### Instalation ###

* A working copy of the gnu g++ compiler.

## Instalation ##

* Run INSTALL.sh from within primaxwebgui/ with root privileges
* Setup the web server to serve primaxwebgui/ as primax/
* Check the setup by visiting http://yourdomain/primax

## License ##

**primaxwebgui** is distributed under the **BSD 2-clause license**. See accompanying file LICENSE.txt for its full text.