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
		return array(
			'file'		=> 'mimes:jpeg,bmp,png'
			);
	}

	public function comments() {
    	return $this->hasMany('Comment', 'article_id');
 	}
}