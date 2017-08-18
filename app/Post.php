<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
	protected $fillable = [
		'title',
		'body',
		'user_id',
		'photo_id',
		'category_id'
	];

	//one to many rship one user has many posts
	public function user(){

		return $this->belongsTo('App\User');
	}

	//one to many rship one photo can be used in many posts
	public function photo(){

		return $this->belongsTo('App\Photo');
	}

	//one to many rship. one category can have many posts
	public function category(){

		return $this->belongsTo('App\Category');
	}


}
