<?php

class Article extends \Eloquent {
	protected $guarded = array('id');
	protected $fillable = array('title','content','author');

	public static function valid($id=''){
		return array(
			'title'		=> 'required|min:10|unique:articles,title'.($id ? ",$id":''),
			'content'	=> 'required|min:100|unique:articles,content'.($id ? ",$id":''),
			'author'	=> 'required'
			);
	}
	public static function validImport(){
		Validator::extend('req_excel', function($attribute, $value, $parameters)
		{
    		  $valid_mime_type = array('application/vnd.ms-office', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      		  $mime = $value->getMimeType();
      	  
      	  return in_array($mime, $valid_mime_type);
        });
    	  return array(
    	  	'file' => 'req_excel'
    	  );
	}


	public function comments() {
    	return $this->hasMany('Comment', 'article_id');
 	}

 	public function delete() {
 		$this->comments()->delete();
 		return parent::delete();
 	}
}