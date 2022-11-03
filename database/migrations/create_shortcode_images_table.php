<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shortcode_images', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->text('title')->nullable();
            $table->text('alternative_text')->nullable();
            $table->text('caption')->nullable();
            $table->json('new_field')->nullable();
            $table->text('credits')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
