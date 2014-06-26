# Custom Development

## New features

You must extend your new controller with the Syntara BaseController, like this :

    /*
    app/controller/FeatureControler.php
    */
    use MrJuliuss\Syntara\Controllers\BaseController;

    class HomeController extends BaseController
    {
        public function getIndex()
        {
            $this->layout = View::make('index');
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

To find your current loggued user, you need to add the ```basicAuth``` filter to your route : 

    Route::get('dashboard/home', array(
        'as' => 'test_home',
        'before' => 'basicAuth|hasPermissions:user.create',
        'uses' => 'HomeController@getIndex'
        )
    );

HomeController getIndex view :

    /*
    app/views/index.blade.php
    */

    @extends(Config::get('syntara::views.master'))
    @section('content')

    {{var_dump($currentUser);}}

    @stop

## New permissions
Add permission to your new Controller route :

    Route::get('routes', array('as' => 'route_name', 'before' => 'hasPermissions:permission', 'uses' => 'Namespace\ControlerRoute'));

Where 'permission' is the name of your permission

Example :

    Route::get('blog/article/new', array('as' => 'new_article', 'before' => 'hasPermissions:create-article',
    'uses' => 'MrJuliuss\Syntara\Controllers\ArticleController@getCreate'));

## Custom view

To change a views by nother, you need tu override the config in ```app/routes.php``` or ```app/filters.php``` :

    Config::set('syntara::views.dashboard-index', 'my-view')

Please see ```syntara/src/config/views.php``` for more views

## Change site name

You can set the site name with View::composer in filters.php (or routes.php)

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->with('siteName', 'My Site');
    });

## Extend the user navigation

Pass in 2 views, 'left-nav' and 'right-nav'. These add links to the left or right of the navigation bar.

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->nest('navPages', 'left-nav');
        $view->nest('navPagesRight', 'right-nav');
    });

View ```left-nav.blade.php``` example :

    <li class=""><a href=""><i class="glyphicon glyphicon-home"></i> <span>Home</span></a></li>
    <li class="dropdown" >
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-home"></i> <span>Blog</span></a>
        <ul class="dropdown-menu">
            <li><a href="">Articles</a></li>
            <li><a href="">Comments</a></li>
        </ul>
    </li>


## Favicon

To add your own favicon to Syntara, you need to use a view composer

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->with('favicon', 'favicon_path');
        $view->with('faviconType', 'favicon_type');
    });


## Lists

** Not yet release, available only on development branch **

Possibility to change number of items per page in lists (users/groups/permissions) 
Change the ```item-perge-page``` value in the main config file : ```app/config/packages/mrjuliuss/syntara/config.php```


## Change validator rules

Change rules in the published validator config file : ```app/config/packages/mrjuliuss/syntara/validator.php```

more informations about rules : http://laravel.com/docs/validation

## Permissions models

In your custom development, you might need to use the permission system : 

### Permission Provider

    use MrJuliuss\Syntara\Facades\PermissionProvider;

Find a permission by id

    $permission = PermissionProvider::findById($id);

Find a permission by value

    $permission = PermissionProvider::findByValue('value');

Find all permissions

    $permission = PermissionProvider::findAll();


### Permission Model

Create a permission 

    $attributes = array(
        'name' => 'New',
        'value' => 'new-permission',
        'description' => 'This is a new permission'
    );
    $permissionModel = PermissionProvider::createPermission($attributes);

Create an empty permission

    $permissionModel = PermissionProvider::createModel();

## User / Group models

Syntara uses Sentry 2 models for Users & Groups management, please read Sentry 2 docs :
http://docs.cartalyst.com/sentry-2

## User activation by email

** Not yet release, available only on development branch ** 

While creating user, he can be automatically activated or activated from an email. By default, user is activated automatically, you can change the activation in **app/config/packages/mrjuliuss/syntara/config.php**, change ```user-activation``` from **auto** to **email**

    <?php

    return array(

        /**
         * User activation :
         * Values : auto (default), email
         */
        'user-activation' => 'email',
    );

### Email in queue

Emails sent from Syntara are automatically send in a queue. For better performance you need to config a queue component in your application : http://laravel.com/docs/queues

### Email view

Change the email activation view :

In **app/config/packages/mrjuliuss/syntara/mails.php**, change ```user-activation-view``` with your custom view

    <?php
    return array(
        /**
         * View for user activation email
         */
        'user-activation-view' => 'syntara::mail.user-activation',
    );

### Email object

Possibility to change the email object :

In **app/config/packages/mrjuliuss/syntara/mails.php**, change ```user-activation-object``` with your custom object

### Email contact name

Possibility to change the email contact name :

In **app/config/packages/mrjuliuss/syntara/mails.php**, change ```contact``` with your custom name

### Email sender

Possibility to change the email sender :

In **app/config/packages/mrjuliuss/syntara/mails.php**, change ```email``` with your custom email

## RTL (Right to Left) languages

Since 1.1.19 & 1.2.3, Syntara support RTL languages.
In **app/config/packages/mrjuliuss/syntara/config.php** , change ```direction``` from **LTR** to **RTL**
