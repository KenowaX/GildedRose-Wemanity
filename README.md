# GildedRose Kata - PHP Version - Arthur Deryckere

This version of the exercice was done using :

- Ubuntu 22.04.1
- PHP 7.4.29

## Installation

Recommended:

- [Git](https://git-scm.com/downloads)

Clone the repository

```shell script
git clone git@github.com:emilybache/GildedRose-Refactoring-Kata.git
cd ./GildedRose-Wemanity/php
```

Install required env. packages with:

```shell script
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.4
sudo apt install php7.4-xml
sudo apt-get install php7.4-mbstring
php -v
```

Install all the project dependencies using composer:

```shell script
composer install
```

## Folders

- `src` - contains the two classes:
    - `Item.php` - this class should not be changed
    - `GildedRose.php` - this class needs to be refactored, and the new feature added
- `tests` - contains the tests
    - `GildedRoseTest.php` - starter test.
        - Tip: ApprovalTests has been included as a dev dependency, see the PHP version of
          the [Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata/)
          for an example
- `Fixture`
    - `texttest_fixture.php` this could be used by an ApprovalTests, or run from the command line

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
composer test
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The test-coverage report will be created in /builds, it is best viewed by opening /builds/**index.html** in your
browser.

## Code Standard

Easy Coding Standard (ECS) is configured for style and code standards, **PSR-12** is used. The current code is not upto
standard!

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
composer phpstan
```
