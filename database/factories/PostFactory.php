<?php

namespace Database\Factories;

use App\Models\Post;
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
                'resumen' =>   $this->faker->sentence(10),
                'contenido' =>   $this->faker->sentence(50),
                'category_id' => Category::whereNull('parent_id')->get()->random()->id,
            ];


    }
}
