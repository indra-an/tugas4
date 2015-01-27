<?php

class Comment extends \Eloquent {
	protected $guarded = array('id', 'article_id');
	protected $fillable = array('content','user');

	public static function valid(){
		return array(
			'content'	=> 'required'
			);
	}

}
