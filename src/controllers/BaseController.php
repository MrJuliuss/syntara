<?php 

namespace MrJuliuss\Syntara\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Config;

class BaseController extends Controller 
{
    /**
    * Setup the layout used by the controller.
    *
    * @return void
    */
    protected function setupLayout()
    {
        $this->layout = View::make(Config::get('syntara::views.master'));
        $this->layout->title = 'Syntara - Dashboard';
        $this->layout->breadcrumb = array();
    }
}