# Makefile for imdbphp
# $Id$

DESTDIR=
prefix=/usr/local
datarootdir=$(DESTDIR)$(prefix)/share
datadir=$(datarootdir)/imdbphp
docdir=$(datarootdir)/doc/imdbphp
INSTALL=install
INSTALL_DATA=$(INSTALL) -m 644
WEBROOT=$(DESTDIR)/var/www
LINKTO=$(WEBROOT)/imdbphp

install: installdirs
	cp -pr doc/* $(docdir)
	$(INSTALL_DATA) *.php $(datadir)
	$(INSTALL_DATA) *.html $(datadir)
	rm -f $(datadir)/Makefile
	if [ ! -e $(LINKTO) ]; then ln -s $(datadir) $(LINKTO); fi

installdirs:
	mkdir -p $(datadir)/cache
	mkdir -p $(datadir)/images
	mkdir -p $(docdir)/apidoc/Api
	if [ ! -d $(WEBROOT) ]; then mkdir -p $(WEBROOT); fi

uninstall:
	linkstat=`readlink $(LINKTO)`
	if [ "$linkstat" = "$(datadir)" ]; then rm -f $(LINKTO); fi
	rmdir --ignore-fail-on-non-empty $(datadir)/cache
	rmdir --ignore-fail-on-non-empty $(datadir)/images
	rm -f $(datadir)/*.html
	rm -f $(datadir)/*.php
	rmdir --ignore-fail-on-non-empty $(datadir)
	rm -rf $(docdir)
