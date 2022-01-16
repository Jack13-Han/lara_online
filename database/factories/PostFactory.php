<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->text(200);
        $slug = Str::slug($title);
        $description = $this->faker->realText();
        $excerpt = Str::words($description,20,"....");

        return [
            "title"=>$title,
            'slug'=>$slug,
            'description'=>$description,
            'excerpt' => $excerpt,
            'user_id' =>User::all()->random()->id,
            'category_id'=>Category::all()->random()->id,
            'is_publish'=> 1 ,

        ];
    }
}
