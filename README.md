# primaxwebgui - web interface for primax scanners #

## Introduction ##

**primaxwebgui** is a *very* simple web interface for easy scanning of documents in a local network using a primax scanner hooked to a [possibly headless] linux box.

## Dependencies ##

### Server Side ###

* Linux (tested on Archlinux x86\_64 and Ubuntu Server 12.04 LTS x86\_84)
* The GNU g++ compiler (for setup only)
* A working copy of [primaxscan](http://primax.sourceforge.net/), the set of drivers for Primax scanners on linux
* A live webserver with php support (tested on Apache 2.2 and php 5.4)

### Client Side ###

* Any modern web browser with javascrit support

## Setup ##

* Run INSTALL.sh from within the root directory of **primaxwebgui** granting root privileges
* Setup the web server to serve **primaxwebgui**'s root directory

## License ##

**primaxwebgui** is distributed under the **BSD 2-clause license**. See accompanying file LICENSE.txt for its full text.