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
	$(INSTALL_DATA) cache.php person.php imdbXML.php movie.php search.php *.html $(datadir)
	$(INSTALL_DATA) conf/* $(libdir)/conf
	$(INSTALL_DATA) test/* $(datadir)/test
	if [ ! -e $(LINKTO) ]; then ln -s $(datadir) $(LINKTO); fi

installdirs:
	mkdir -p $(libdir)/conf
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
	rm -f $(libdir)/browseremulator.class.php $(libdir)/imdb_movielist.class.php $(libdir)/imdbsearch.class.php $(libdir)/mdb_config.class.php $(libdir)/movieposterdb.class.php $(libdir)/pilotsearch.class.php $(libdir)/imdb_charts.class.php $(libdir)/imdb_nowplaying.class.php $(libdir)/imdb_trailers.class.php $(libdir)/mdb_request.class.php $(libdir)/person_base.class.php $(libdir)/imdb.class.php $(libdir)/imdb_person.class.php $(libdir)/mdb_base.class.php $(libdir)/movie_base.class.php $(libdir)/pilot.class.php $(libdir)/pilot_person.class.php
	rmdir --ignore-fail-on-non-empty $(datadir)
	rm -rf $(docdir)


