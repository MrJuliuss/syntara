# Syntara Dashboard (Laravel 4 package)

Syntara is an admin system for Laravel 4.

<img src="https://raw.github.com/MrJuliuss/syntara/master/screenshots/user_list.png" />

[Others screenshots](https://github.com/MrJuliuss/syntara/tree/master/screenshots)

## Features

* Authentication
* Users management
* Groups & permissions management

## Requirements
* PHP 5.3+

## Dependencies

* [Cartalyst Sentry package](https://github.com/cartalyst/sentry)
* jQuery 2.0.*
* Twitter Bootstrap 3 RC1

## Installation

In the require key of composer.json file add the following line

```"mrjuliuss/syntara": "1.*"```

Run the Composer update command

```$ composer update```

In **app/config/app.php** :

Add  ``` 'Cartalyst\Sentry\SentryServiceProvider'``` and  ```'Mrjuliuss\Syntara\SyntaraServiceProvider'``` to the end of the $providers array

    'providers' => array(
        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Cartalyst\Sentry\SentryServiceProvider',
        'Mrjuliuss\Syntara\SyntaraServiceProvider'
    ),

Add ```'Sentry'          => 'Cartalyst\Sentry\Facades\Laravel\Sentry'``` to the end of the $aliases array

    'aliases' => array(

        'App'             => 'Illuminate\Support\Facades\App',
        'Artisan'         => 'Illuminate\Support\Facades\Artisan',
        ...
        'Sentry'          => 'Cartalyst\Sentry\Facades\Laravel\Sentry'
    ),

Launch install commands :

```php artisan syntara:install```

Create first user (the first user must add to the "Admin" group, to allow you an access to all features)

``` php artisan create:user username email password Admin ```

Now go to login page :

http://your-url/dashboard/login


## Custom Development

To add a new feature to Syntara dashboard, you must extend your new controller with the Syntara BaseController, like this :

    <?php

    use MrJuliuss\Syntara\Controllers\BaseController;

    class FeatureController extends BaseController
    {
        public function getIndex()
        {
            $this->layout = View::make('syntara::dashboard.index');

            $this->layout->title = 'My new feature';

            // add breadcrumb to current page
            $this->layout->breadcrumb = array(
                array(
                    'title' => 'My new feature',
                    'link' => 'dashboard',
                    'icon' => 'glyphicon-home'
                ),
                array(
                    'title' => 'Current Page',
                    'link' => 'dashboard/current',
                    'icon' => 'glyphicon-plus'
                ),
            );
        }
    }

Extend the user navigation by creating a view composer:

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->nest('navPages', 'nav');
        $view->nest('navPagesRight', 'navright');
        $view->with('siteName', 'My Site');
    });

This passes in 2 views, nav and navright these add links to the left or right of the navigation bar.

Pass a string called siteName to the view composer to change the site name.


## TODO

* Ban/unban user
* User permission (besides group permissions)

## License

Syntara is released under the MIT License. See the licence file for details.
