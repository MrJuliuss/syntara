<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Response;
use Request;
use Sentry;

class UserController extends BaseController {

	/**
	 * Display a list of all users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users =  Sentry::getUserProvider()->getEmptyUser()->paginate(20);
		
        $datas['links'] = $users->links();
        $datas['users'] = $users;
        if(Request::ajax())
        {
			$html = View::make('syntara::user.list-users', array('datas' => $datas))->render();
            
			return Response::json(array('html' => $html));
        }
        
		$this->layout = View::make('syntara::user.index', array('datas' => $datas));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}