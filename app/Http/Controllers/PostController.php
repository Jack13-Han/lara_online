<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::when(isset(request()->search),function ($query){
           $search=request()->search;
           $query->where('title',"LIKE","%$search%")->orWhere('description',"LIKE","%$search%");
       })->latest('id')->paginate(5) ;



       return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {


        $request->validate([
           "title"=> "required|unique:posts,title|min:3",
            "category" =>"required|integer|exists:categories,id",
            "description"=> "required|min:20",
            "photo"=>"required|",
            "photo.*"=> "required|max:3000|mimes:jpg,png",//တစ်ဖိုင်ချင်းစီ ဝင်စစ် တာ
            "tags"=>"required",
            "tags.*"=>"integer|exists: tags,id",
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description =$request->description;
        $post->excerpt = Str::words($request->description,20);
        $post->category_id =$request->category;
        $post->user_id =Auth::id();
        $post->is_publish = true;
        $post->save();

        //save tag to  pivot table
        $post->tags()->attach($request->tags);

        //make create folder
        if (!Storage::exists('public/thumbnail')){
            Storage::makeDirectory('public/thumbnail');
        }

        if ($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo){

                //store file in storage
                $newName = uniqid()."_photo.".$photo->extension();
                $photo->storeAs('public/photo/',$newName) ;//storage

                //making thumbnail
                $img= Image::make($photo);
                //reduce size
                $img->fit('200','200');
                $img->save('storage/thumbnail/'.$newName);//public

                //save in database
                $photo = new Photo();
                $photo->name =$newName;
                $photo->post_id= $post->id;
                $photo->user_id = Auth::id();
                $photo->save();


            }
        }


        return redirect()->route('post.index')->with('status','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([
            "title"=> "required|unique:posts,title,$post->id|min:3",
            "category" =>"required|integer|exists:categories,id",
            "description"=> "required|min:20",
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description =$request->description;
        $post->excerpt = Str::words($request->description,20);
        $post->category_id =$request->category;
        $post->update();


        // delete all record from pivot
        $post->tags()->detach();


        //save tag to  pivot table
        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('status','Post Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        foreach ($post->photos as $photo){
            //file delete
            Storage::delete('public/photo'.$photo->name);
            Storage::delete('public/thumbnail'.$photo->name);

            //database delete
//            $photo->delete();
        }
        //delete all record from hasMany
        $post->photos()->delete();

        // delete all record from pivot
        $post->tags()->detach();

        $post->delete();
        return redirect()->route('post.index')->with('status','Post Deleted');
    }
}
