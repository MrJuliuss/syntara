<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Validator;
use Input;
use Config;

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
        var_dump(Input::all());
        try
        {
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.groups.create')
            );

            if($validator->fails())
            {
                return Response::json(array('userCreated' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }
        }
        catch(Exception $e)
        {
            
        }
    }
    
    /**
    * Delete groupe
    * @return Response
    */
    public function delete()
    {
        try
        {
            $group = Sentry::getGroupProvider()->findById(Input::get('userId'));
            $group->delete();
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('deletedGroup' => false));
        }
        
        return Response::json(array('deletedGroup' => true));
    }
}