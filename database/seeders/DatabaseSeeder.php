<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        User::create([
//            'name' => "Han Wai Htun",
//            'email' => "hanwaihtun@gmail.com",
//            'email_verified_at' => now(),
//            'password' => Hash::make('123123123'), // password
//            'remember_token' => Str::random(10),
//        ]);

         \App\Models\User::factory(12)->create();
//         Category::factory(15)->create();
//        Post::factory(250)->create();
//        Tag::factory(15)->create();


//        Post::all()->each(function ($post){
//            $tagIds =  Tag::inRandomOrder()->limit(rand(1,3))->get()->pluck('id');
//            $post->tags()->attach($tagIds);
//        });

    }
}
