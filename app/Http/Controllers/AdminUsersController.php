<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //all() brings a collection that we do not want. We want an array.
        //pluck replaced lists()
       // $roles = Role::pluck("name","id")->all();

        //alternative
        $roles = Role::get()->pluck("name", "id")->toArray();

       // $roles[" "] = "Choose role";

        //return $roles;

        return view("admin.users.create", compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //persist data in the database
        //User::create($request->all());

        $input = $request->all();

        //check if a file has been uploaded
        //photo_id is the name of the file input and get its values
        if ($file = $request->file('photo_id')) {
            
            //let each photo have a unique name by appending time to it.
            $name = time() . $file->getClientOriginalName();

            //move the file/photo to an images folder in the public directory
            //this will create the folder if it does not exist.
            $file->move("images", $name);

            //store file/photo name in the photo table
            $photo = Photo::create(["file" => $name]);

            //get the photo id
            $input['photo_id'] = $photo->id;

        }

        //encrypt password

        $input['password'] = bcrypt($request->password);

        //save all the data provided
        User::create($input);

        //url used in redirect
        
        return redirect("admin/users");

       // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
