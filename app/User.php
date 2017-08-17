<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //mass assignment
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //one to many relationship
    public function role(){
       return $this->belongsTo("App\Role");
    }

    //one to one relationship
    public function photo(){
        return $this->belongsTo("App\Photo");
    }

    //check if user is an admin
    public function isAdmin(){

        if ($this->role->name == "administrator" && $this->is_active == 1) {
            return true;
        }

        return false;
    }//close public function isAdmin(){

}
