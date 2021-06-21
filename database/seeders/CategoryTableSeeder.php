<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'nombre' => 'Innovación',
            'slug' => 'innovacion',
        ]);

        Category::create([
            'nombre' => 'Entretenimiento',
            'slug' => 'entretenimiento',
        ]);

        Category::create([
            'nombre' => 'Negocios',
            'slug' => 'negocios',
        ]);

        Category::create([
            'nombre' => 'Seguridad',
            'slug' => 'seguridad',
        ]);

        Category::create([
            'nombre' => 'ABC Telecomunicaciones',
            'slug' => 'abc-telecomunicaciones',
        ]);

        Category::create([
            'nombre' => 'Compromiso',
            'slug' => 'compromiso',
        ]);

        Category::create([
            'nombre' => 'Telecom trends',
            'slug' => 'telecom-trends',
            'parent_id'=> 1
        ]);
        Category::create([
            'nombre' => 'Novedades claro',
            'slug' => 'novedades-claro',
            'parent_id'=> 1
        ]);
        Category::create([
            'nombre' => 'Gaming',
            'slug' => 'gaming',
            'parent_id'=> 2
        ]);
        Category::create([
            'nombre' => 'Smartphone',
            'slug' => 'smartphone',
            'parent_id'=> 2
        ]);
        Category::create([
            'nombre' => 'Apps',
            'slug' => 'apps',
            'parent_id'=> 2
        ]);

        Category::create([
            'nombre' => 'Gadgets',
            'slug' => 'gadgets',
            'parent_id'=> 2
        ]);
        Category::create([
            'nombre' => 'Streaming',
            'slug' => 'streaming',
            'parent_id'=> 2
        ]);

        Category::create([
            'nombre' => 'Empresas',
            'slug' => 'empresas',
            'parent_id'=> 3
        ]);

        Category::create([
            'nombre' => 'Emprendimientos',
            'slug' => 'emprendimientos',
            'parent_id'=> 3
        ]);

        Category::create([
            'nombre' => 'Sostenibilidad',
            'slug' => 'sostenibilidad',
            'parent_id'=> 6
        ]);

        Category::create([
            'nombre' => 'Gente claro',
            'slug' => 'gente-claro',
            'parent_id'=> 6
        ]);


    }
}
