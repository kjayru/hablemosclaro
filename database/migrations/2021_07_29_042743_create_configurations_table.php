<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->string('descripcion');
            $table->string('keywords');
            $table->string('imagen_facebook');
            $table->string('imagen_twitter')->nullable();
            $table->string('canonical');
            $table->string('facebook_app_id')->nullable();
            $table->string('facebook_admin_id')->nullable();
            $table->string('twitter_id')->nullable();

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
        Schema::dropIfExists('configurations');
    }
}
