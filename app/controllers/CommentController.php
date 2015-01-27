<?php

class CommentController extends \BaseController {

	protected $layout = 'layouts.application';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		$validate = Validator::make(Input::all(),Comment::valid());
		if($validate->fails()){
			return Redirect::to('articles/'.Input::get('article_id'))
			->withErrors($validate)
			->withInput();
		}else{
			$comments = new Comment;
			$comments->content 		= Input::get('content');
			$comments->article_id	= Input::get('article_id');
			$comments->user			= Input::get('user');
			$comments->save();

			Session::flash('notice','Success add comment');
			return Redirect::to('articles/'.Input::get('article_id'));
		}
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
