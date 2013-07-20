<?php namespace MrJuliuss\Syntara\Controllers;

use View;

class GroupController extends BaseController {

    /**
     * List of groups
     */
    public function getIndex()
    {
        $this->layout = View::make('syntara::group.index-group');
    }
    
    /**
     * Show create group view
     */
    public function getCreate()
    {
        $this->layout = View::make('syntara::group.new-group');
    }

    /**
     * Create group
     */
    public function postCreate()
    {
        
    }
}