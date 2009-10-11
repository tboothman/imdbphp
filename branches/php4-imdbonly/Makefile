# Makefile for imdbphp
# $Id$

DESTDIR=
prefix=/usr/local
libdir=$(DESTDIR)/usr/share/php
datarootdir=$(DESTDIR)$(prefix)/share
datadir=$(datarootdir)/imdbphp
docdir=$(datarootdir)/doc/imdbphp
INSTALL=install
INSTALL_DATA=$(INSTALL) -m 644
WEBROOT=$(DESTDIR)/var/www
LINKTO=$(WEBROOT)/imdbphp

install: installdirs
	cp -pr doc/* $(docdir)
	$(INSTALL_DATA) *.class.php $(libdir)
	$(INSTALL_DATA) cache.php imdb.php imdb_person.php imdbsearch.php *.html $(datadir)
	$(INSTALL_DATA) test/* $(datadir)/test
	if [ ! -e $(LINKTO) ]; then ln -s $(datadir) $(LINKTO); fi

installdirs:
	mkdir -p $(datadir)/cache
	mkdir -p $(datadir)/images
	mkdir -p $(datadir)/test
	chmod 0777 $(datadir)/cache $(datadir)/images
	mkdir -p $(docdir)/apidoc/Api
	mkdir -p $(libdir)
	if [ ! -d $(WEBROOT) ]; then mkdir -p $(WEBROOT); fi

uninstall:
	if [ "`readlink $(LINKTO)`" = "$(datadir)" ]; then rm -f $(LINKTO); fi
	rmdir --ignore-fail-on-non-empty $(datadir)/cache
	rmdir --ignore-fail-on-non-empty $(datadir)/images
	rm -f $(datadir)/*.html
	rm -f $(datadir)/*.php
	rm -rf $(datadir)/test
	rm -f $(libdir)/imdb_base.class.php $(libdir)/imdb.class.php $(libdir)/imdb_config.class.php $(libdir)/imdb_person.class.php $(libdir)/imdb_request.class.php $(libdir)/browseremulator.class.php $(libdir)/imdb_charts.class.php $(libdir)/imdb_nowplaying.class.php $(libdir)/imdb_trailers.class.php
	rmdir --ignore-fail-on-non-empty $(datadir)
	rm -rf $(docdir)
