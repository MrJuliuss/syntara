<?php 

namespace MrJuliuss\Syntara\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controllers\Controller;

class BaseController extends Controller 
{
    /**
    * Setup the layout used by the controller.
    *
    * @return void
    */
    protected function setupLayout()
    {
        $this->layout = View::make('syntara::layouts.dashboard.master');
        
        $this->layout->title = '';
        $this->layout->breadcrumb = array();
    }
}