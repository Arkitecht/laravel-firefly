[![Latest Stable Version](https://img.shields.io/packagist/v/AndreasElia/laravel-firefly.svg)](https://packagist.org/packages/AndreasElia/laravel-firefly)
[![PHP version](https://img.shields.io/packagist/php-v/AndreasElia/laravel-firefly.svg)](https://packagist.org/packages/AndreasElia/laravel-firefly)
[![License](https://img.shields.io/packagist/l/AndreasElia/laravel-firefly.svg)](https://packagist.org/packages/AndreasElia/laravel-firefly)
[![StyleCI](https://github.styleci.io/repos/149909240/shield?branch=master)](https://github.styleci.io/repos/149909240?branch=master)

![Laravel Firefly Logo](/logo.png?raw=true "Laravel Firefly Logo")

# Laravel Firefly

Firefly is a simple forum package for Laravel, created for ease of use and expansion.

## Installation

Install the package:

```bash
composer require andreaselia/laravel-firefly
```

Publish package files:

```bash
php artisan vendor:publish --provider="Firefly\FireflyServiceProvider"
```

Run the migrations:

```bash
php artisan migrate
```

Add the FireflyUser trait to your User model:

```php
<?php

namespace App\Models;

use Firefly\Traits\FireflyUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, FireflyUser;
}
```

## Contributing

You're more than welcome to submit a pull request, or if you're not feeling up to it - create an issue so someone else can pick it up.
