<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $uploads = "/images/";

    protected $fillable = ['file'];

    //define an accessor to get relative/axact photo path
    public function getFileAttribute($photo){

    	return $this->uploads . $photo;

    }//close public function getFileAttribute($photo){

}
