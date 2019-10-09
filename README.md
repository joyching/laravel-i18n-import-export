# Laravel i18n Tool

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joyching/laravel-i18n-tool.svg?style=flat-square)](https://packagist.org/packages/joyching/laravel-i18n-tool)
[![StyleCI](https://github.styleci.io/repos/194485478/shield)](https://github.styleci.io/repos/194485478)
<a href="https://travis-ci.org/joyching/laravel-i18n-tool"><img src="https://api.travis-ci.org/repos/joyching/laravel-i18n-tool.svg" alt="Build Status"></a>

## Installation

Run `composer require` to install the package.

```
$ composer require joyching/laravel-i18n-tool
```

Finally add the following line to the `providers` array of your `config/app.php` file:

```
Joyching\I18n\I18nServiceProvider::class
```

## Configuration

Publish configuration in Laravel 5
```
$ php artisan vendor:publish --provider="Joyching\I18n\I18nServiceProvider"
```

## Export

Export the all i18n files to `.csv` files

```
$ php artisan i18n-tool:export
```

Export specific locale i18n files to `.csv` file, example: en

```
$ php artisan i18n-tool:export --locale=en
```

It will export `.env` files in laravel project `storage/app/i18n-exports` folder
