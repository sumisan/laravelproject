<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use App\Category;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all posts

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //get the categories and populate the select category box
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //return $request->all();

        $user = Auth::user();

        $input = $request->all();

       // $input['user_id'] = $user->id;

        //check if a photo has been selected
        if ($file = $request->file('photo_id')) {
            
            //get image name
            $name = time() . $file->getClientOriginalName();

            //save image in images folder
            $file->move('images', $name);

            //save image
            $photo = Photo::create(['file'=>$name]);

            //get photo id
            $input['photo_id'] = $photo->id;
        }

               
     //   $post = Post::create($input);

        //save post
        $user->posts()->create($input);

        return redirect('admin/posts');
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
        //get post for this user
        $post = Post::findOrFail($id);

        //get categories
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        //get post for this user
       // $post = Post::findOrFail($id);

        $input = $request->all();


        //check if photo has been uploaded
        if ($file = $request->file('photo_id')) {            

            //get image name
            $name = time() . $file->getClientOriginalName();

            //save image in images folder
            $file->move('images', $name);

            //save image in photo table
            $photo = Photo::create(['file'=>$name]);

            //get photo id
            $input['photo_id'] = $photo->id;
        }

        //update the changes
       // $post->update($input);


        //get post for this user with id passed.
        Auth::user()->posts()->whereId($id)->first()->update($input);

        return redirect('admin/posts');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get logged in user
        $post = Post::findOrFail($id);

        //delete photo in images folder and photo table
        unlink(public_path() . $post->photo->file );

        //delete post
        Auth::user()->posts()->whereId($id)->first()->delete();

        //show flash messege
        Session::flash('deleted_post', 'Post deleted successfully');

        return redirect('admin/posts');

    }
}
