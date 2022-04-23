<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $with =['user','category','photos','tags'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function  category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    //accessor

//    public function getTitleAttribute($value){
//        return Str::words($value,3);
//    }

    public  function  getShortTitleAttribute(){
        return Str::words($this->title,3);
    }

    public  function  getShowTimeAttribute(){
        return "<p class='mb-0 small'>
                    <i class='fas fa-calendar text-primary'></i>
                    ".$this->created_at->format('d-M-Y')."
                </p>

                <p class='mb-0 small'>
                    <i class='fas fa-clock text-primary'></i>
                    ".$this->created_at->format('h:i a')."
                </p>";
    }

    //mutator

    public function setSlugAttribute($value){
        $this->attributes['slug']= Str::slug($value);
    }


    //event

//    protected static function booted()
//    {
//        static::created(function (){
//            //send email
//            //send notification
//            logger("hello hello");
//        });
//    }

    //Query Scope -> local scope
    public function scopeSearch($query){
        if (isset(request()->search)){
            $search=request()->search;
            return $query->where('title',"LIKE","%$search%")->orWhere('description',"LIKE","%$search%");
        }
    }

}
