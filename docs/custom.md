# Custom Development

## New features

You must extend your new controller with the Syntara BaseController, like this :

    use MrJuliuss\Syntara\Controllers\BaseController;

    class FeatureController extends BaseController
    {
        public function getIndex()
        {
            $this->layout = View::make('index-view');
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

## New permissions
Add permission to your new Controller route :

    Route::get('routes', array('as' => 'route_name', 'before' => 'hasPermissions:permission', 'uses' => 'Namespace\ControlerRoute'));

Where 'permission' is the name of your permission

Example :

    Route::get('blog/article/new', array('as' => 'new_article', 'before' => 'hasPermissions:create.article', 
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
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-home"></i><span>Blog</span></a></a>
        <ul class="dropdown-menu">
            <li><a href="">Articles</a></li>
            <li><a href="">Comments</a></li>
        </ul>
    </li>


## Favicon

To add your own favicon to Syntara, you need to use a view composer

    View::composer('syntara::layouts.dashboard.master', function($view)
    {
        $view->nest('favicon', 'favicon_path');
        $view->nest('faviconType', 'favicon_type');
    });


## Change validator rules

Change rules in the published validator config file :

```app/config/packages/mrjuliuss/syntara/validator.php```

more informations about rules : http://laravel.com/docs/validation

## Permissions models

In your custom development, you might need to use the permission system : 

### Permission Provider

    use PermissionProvider;

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
    $permissionModel = PermissionProvider::createPermission();

Create an empty permission

    $permissionModel = PermissionProvider::createModel();

## User / Group models

Syntara uses Sentry 2 models for Users & Groups management, please read Sentry 2 docs :
http://docs.cartalyst.com/sentry-2