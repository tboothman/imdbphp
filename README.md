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
* Include the imdb class (It's in imdb.class.php). This is automatic if you use composer.
* Get some data
```php
$imdb = new imdb('0335266');
$rating = $imdb->rating();
$plotOutline = $imdb->plotoutline();
```

Installation
============

This library scrapes imdb.com so changes their site can cause parts of this library to fail. You will probably need to update a few times a year. Keep this in mind when choosing how to install/configure.

Watch this repo get a notification from GitHub when a new release happens.

* [Composer](https://www.getcomposer.org) (recommended). Include the imdbphp/imdbphp package.
* Git clone. Checkout the latest release tag.
* [APT/RPM/ARK packages](http://apt.izzysoft.de/). Updated soon after a release.
* [Zip/Tar download](https://github.com/tboothman/imdbphp/releases)


Configuration
=============

imdbphp needs no configuration by default but can cache imdb lookups, store images and change languages if configured.

Configuration is done by the `mdb_config` class in mdb_config.class.php which has detailed explanations of all the config options available.
You can alter the config by creating the object, modifying its properties then passing it to the constructor for imdb.
```php
$config = new mdb_config();
$config->language = 'de-DE';
$imdb = new imdb('0335266', $config);
$imdb->title(); // Lost in Translation - Zwischen den Welten
$imdb->orig_title(); // Lost in Translation
```

If you're using a git clone you might prefer to configure IMDbPHP by putting an ini file in the `conf` folder. `900_localconf.sample` has some sample settings.

The cache folder is `./cache` by default. Create it and pages requested from imdb will be cached there to speed up future requests.

Searching for a film
====================

```php
// include "imdbsearch.class.php"; // Load the class in if you're not using an autoloader
$search = new imdbsearch(); // Optional $config parameter
$results = $search->search('The Matrix', [imdbsearch::MOVIE]); // Optional second parameter restricts types returned

// $results is an array of imdb objects
// The objects will have title, year and movietype available
//  immediately, but any other data will have to be fetched from IMDb
foreach ($results as $result) { /* @var $result imdb */
    echo $result->title() . ' ( ' . $result->year() . ')';
}
```

Searching for a person
======================
```php
// include "imdb_person_search.class.php"; // Load the class in if you're not using an autoloader
$search = new imdb_person_search(); // Optional $config parameter
$results = $search->search('Forest Whitaker');

// $results is an array of imdb_person objects
// The objects will have name available, everything else must be fetched from IMDb
foreach ($results as $result) { /* @var $result imdb_person */
    echo $result->name();
}
```
