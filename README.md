imdbphp
=======

PHP library for retrieving film and TV information from IMDb.
Retrieve most of the information you can see on IMDb including films, TV series, TV episodes, people.
Search for titles on IMDb, including filtering by type (film, tv series, etc).
Download film posters and actor images.


Getting started
===============

* Include [imdbphp/imdbphp](https://packagist.org/packages/imdbphp/imdbphp) using [composer](https://www.getcomposer.org), clone this repo or download the latest release zip.
* Find a film you want the metadata for e.g. Lost in translation http://www.imdb.com/title/tt0335266/
```php
$imdb = new \imdb('0335266');
$rating = $imdb->rating();
$plotOutline = $imdb->plotoutline();
```

Configuration
=============

imdbphp needs no configuration by default but can cache imdb lookups, store images and change languages if configured.

Configuration is done by the \mdb_config class in mdb_config.class.php which has detailed explanations of all the config options available.
You can alter the config by creating the object, modifying its properties then passing it to the constructor for imdb.
```php
$config = new \mdb_config();
$config->language = 'de';
$imdb = new \imdb('0335266', $config);
$imdb->title(); // ...
```
