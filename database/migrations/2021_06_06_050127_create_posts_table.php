<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("slug");
            $table->string("resumen")->nullable();
            $table->longtext("contenido");
            $table->text("meta_description")->nullable();
            $table->string("meta_titulo")->nullable();
            $table->string("meta_image")->nullable();
            $table->string("twitter_site")->nullable();
            $table->string("twitter_create")->nullable();

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
