<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        $request->validate([
            "post_id"=> "required|integer",
            "photos"=>"required|",
            "photos.*"=> "required|max:3000|mimes:jpg,png",//တစ်ဖိုင်ချင်းစီ ဝင်စစ် တာ
        ]);


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
                $photo->post_id= $request->post_id;
                $photo->user_id = Auth::id();
                $photo->save();


            }
        }

        return redirect()->back()->with('status','Post Photo  Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhotoRequest  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //file delete
        Storage::delete('public/photo'.$photo->name);
        Storage::delete('public/thumbnail'.$photo->name);

        //database delete
        $photo->delete();

        return redirect()->back()->with('status','Post Photo Deleted');;
    }
}
