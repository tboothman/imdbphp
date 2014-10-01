These tests mostly retrieve pages from IMDb and assert the parsing.

Running the tests
-----------------
If you've got composer - from the root of the repo:
```
composer install
vendor/bin/phpunit tests
```

Otherwise get the PHPUnit phar from [github](https://github.com/sebastianbergmann/phpunit)
```
php phpunit.phar tests
```
