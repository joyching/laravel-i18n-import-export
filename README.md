# Laravel i18n Tool

[![StyleCI](https://github.styleci.io/repos/194485478/shield)](https://github.styleci.io/repos/194485478)
<a href="https://travis-ci.org/joyching/laravel-i18n-tool"><img src="https://travis-ci.org/laravel/socialite.svg" alt="Build Status"></a>

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
