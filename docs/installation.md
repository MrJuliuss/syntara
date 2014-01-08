# Installation

You need to have an installed Laravel 4, if not : please read the [L4 install doc](http://laravel.com/docs/installation)

## Composer
In the require key of composer.json file add the following line

If your application uses **Laravel 4.0** :

```"mrjuliuss/syntara": "1.1.*"```

If your application uses **Laravel 4.1** :

```"mrjuliuss/syntara": "1.2.*"```

Run the **Composer** update command

```composer update```

## Application

### Config providers & alias

In **app/config/app.php** <br/>
Add ```'Cartalyst\Sentry\SentryServiceProvider'``` <br/>and ```'Mrjuliuss\Syntara\SyntaraServiceProvider'``` to the end of the **$providers** array


    'providers' => array(
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Cartalyst\Sentry\SentryServiceProvider',
        'Mrjuliuss\Syntara\SyntaraServiceProvider'
    ),

Add  ```'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry'``` to the end of the **$aliases** array

    'aliases' => array(

        'App'             => 'Illuminate\Support\Facades\App',
        'Artisan'         => 'Illuminate\Support\Facades\Artisan',
        ...
        'Sentry'          => 'Cartalyst\Sentry\Facades\Laravel\Sentry'
    ),

Before the next step, don't forget to configure your database in ```app/config/database.php```
Please note that syntara is **not compatible with sqlite**.

### Install command
```php artisan syntara:install```

### Create first user 

The first user must add to the "Admin" group, to allow you an access to all features

```php artisan create:user username email password Admin```

Now you can access to the login page : ```http://your-url/dashboard/login```


### Update command

To update Syntara, you need to start an update via composer : ```composer update```
After this update, just start ```php artisan syntara:update```

This command does the same as the install command, only it won't publish again the config files, overwriting your changes, allowing users to run any new database migrations or publish any new assets.