<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            return [
                'titulo' => $this->faker->sentence(3),
                'slug' => Str::slug( $this->faker->sentence(3),"-"),
                'banner' => $this->faker->imageUrl(1200,400) ,
                'imagenbox' => $this->faker->imageUrl(400,300),
                'resumen' =>   $this->faker->sentence(10),
                'contenido' =>   $this->faker->sentence(50),
                'category_id' => Category::whereNotNull('parent_id')->get()->random()->id,
                'post_type_id' => PostType::get()->random()->id,
            ];


    }
}
