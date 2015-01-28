<?php

class ArticleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::paginate(10);
		return View::make('articles.index')
		->with('articles',$articles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('articles.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validate = Validator::make(Input::all(),Article::valid());
		if($validate->fails()){
			return Redirect::to('articles/create')
			->withErrors($validate)
			->withInput();
		}else{
			$articles = New Article;
			$articles->title 	= Input::get('title');
			$articles->content 	= Input::get('content');
			$articles->author 	= Input::get('author');
			$articles->save();
			
			Session::flash('notice', 'Success add article');
			return Redirect::to('articles');	
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
		$article = Article::find($id);
		$comments = Article::find($id)->comments->sortBy('Comment.created_at');
		
		return View::make('articles.show')
		->with('article',$article)
		->with('comments',$comments);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::find($id);
		return View::make('articles.edit')
		->with('article',$article);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validate = Validator::make(Input::all(), Article::valid($id));
		if($validate->fails()){
			return Redirect::to('articles/'.$id.'/edit')
			->withErrors($validate)
			->withInput();
		}else{
			$articles = Article::find($id);
			$articles->title 	= Input::get('title');
			$articles->content 	= Input::get('content');
			$articles->author 	= Input::get('author');
			$articles->save();

			Session::flash('notice','Success update article');
			return Redirect::to('articles');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$articles = Article::find($id);
		$articles->comments()->delete();
		$articles->delete();

		Session::flash('notice','Article success delete');
		return Redirect::to('articles');
	}

	public function export($id)
	{
	$articles = Article::find($id);
	$comments = Article::find($id)->comments->sortBy('Comment.created_at');
	$data = array(
    	array('title', 'content','author'),
    	array($articles->title,$articles->content,$articles->author)
	);
	
	Excel::create($articles->title, function($excel) use($data,$comments) {

     // article sheet
    	$excel->sheet('Article', function($sheet) use($data) {
    		$sheet->rows($data);
   		});
    
    // comment sheet
    	$excel->sheet('Comment', function($sheet) use($comments) {
    		$sheet->fromModel($comments);
    	});

    })->download('xlsx');

	}
	
	public function form_import()
	{
		return View::make('articles.upload');
	}

	public function import(){
		
		$file_name = Input::file('file')->getClientOriginalName();
		$path_save_image = public_path().'/upload_excel';
		$message = array(
				'req_excel' => 'File must MS excel'
			);
		$validate = Validator::make(Input::all(), Article::validImport(),$message);
	
   	    if($validate->fails()) {
      		return Redirect::to('import')
        		->withErrors($validate);
   		}else{
		if (Input::hasFile('file'))
		{
		
    	  if(!File::exists($path_save_image)) {
    	    File::makeDirectory($path_save_image, $mode = 0777, true, true);
  		  }
  		  Input::file('file')->move($path_save_image, $file_name);

	
		$excel = Excel::selectSheetsByIndex(0)->load($path_save_image.'/'.$file_name, function($reader){})->get()->toArray();
	
			foreach($excel as $ex){

				$data['title']		= $ex["title"];
    			$data['content']	= $ex["content"];
    			$data['author']		= $ex["author"];
				$validate = Validator::make($data, Article::valid());
					
					if($validate->fails()){

						File::delete($path_save_image.'/'.$file_name);
						Session::flash('error','Import Data Failed');
						return Redirect::to('/')->withErrors($validate);	
					}else{			
						$articles = Article::create($data);
						Session::flash('notice','Import Data Success');
						return Redirect::to('/');	
					}
			}

		}else{
			File::delete($path_save_image.'/'.$file_name);
			Session::flash('error','Import Data Failed');
			return Redirect::to('/');		
		}

		}
	}

}
