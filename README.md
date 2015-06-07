imdbphp
=======

PHP library for retrieving film and TV information from IMDb.
Retrieve most of the information you can see on IMDb including films, TV series, TV episodes, people.
Search for titles on IMDb, including filtering by type (film, tv series, etc).
Download film posters and actor images.


Quick Start
===========

* Include [imdbphp/imdbphp](https://packagist.org/packages/imdbphp/imdbphp) using [composer](https://www.getcomposer.org), clone this repo or download the latest [release zip](https://github.com/tboothman/imdbphp/releases).
* Find a film you want the metadata for e.g. Lost in translation http://www.imdb.com/title/tt0335266/
* If you're not using composer or an autoloader include `bootstrap.php`.
* Get some data
```php
$title = new \Imdb\Title('0335266');
$rating = $title->rating();
$plotOutline = $title->plotoutline();
```

Installation
============

This library scrapes imdb.com so changes their site can cause parts of this library to fail. You will probably need to update a few times a year. Keep this in mind when choosing how to install/configure.

For notifications of new releases try [Sibbell](https://sibbell.com)

* [Composer](https://www.getcomposer.org) (recommended). Include the [imdbphp/imdbphp](https://packagist.org/packages/imdbphp/imdbphp) package.
* Git clone. Checkout the latest release tag.
* [APT/RPM/ARK packages](http://apt.izzysoft.de/). Updated soon after a release.
* [Zip/Tar download](https://github.com/tboothman/imdbphp/releases)


Configuration
=============

imdbphp needs no configuration by default but can cache imdb lookups, store images and change languages if configured.

Configuration is done by the `\Imdb\Config` class in `src/Imdb/Config.php` which has detailed explanations of all the config options available.
You can alter the config by creating the object, modifying its properties then passing it to the constructor for imdb.
```php
$config = new \Imdb\Config();
$config->language = 'de-DE';
$imdb = new \Imdb\Title('0335266', $config);
$imdb->title(); // Lost in Translation - Zwischen den Welten
$imdb->orig_title(); // Lost in Translation
```

If you're using a git clone you might prefer to configure IMDbPHP by putting an ini file in the `conf` folder. `900_localconf.sample` has some sample settings.

The cache folder is `./cache` by default. Requests from imdb will be cached there for an hour (by default) to speed up future requests.

Searching for a film
====================

```php
// include "bootstrap.php"; // Load the class in if you're not using an autoloader
$search = new \Imdb\TitleSearch(); // Optional $config parameter
$results = $search->search('The Matrix', [\Imdb\TitleSearch::MOVIE]); // Optional second parameter restricts types returned

// $results is an array of Title objects
// The objects will have title, year and movietype available
//  immediately, but any other data will have to be fetched from IMDb
foreach ($results as $result) { /* @var $result \Imdb\Title */
    echo $result->title() . ' ( ' . $result->year() . ')';
}
```

Searching for a person
======================
```php
// include "bootstrap.php"; // Load the class in if you're not using an autoloader
$search = new \Imdb\PersonSearch(); // Optional $config parameter
$results = $search->search('Forest Whitaker');

// $results is an array of Person objects
// The objects will have name available, everything else must be fetched from IMDb
foreach ($results as $result) { /* @var $result \Imdb\Person */
    echo $result->name();
}
```
