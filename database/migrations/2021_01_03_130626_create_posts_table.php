<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

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
            $table->string('title');
            $table->foreignId('user_id')->constrained()->nullOnDelete();
            $table->text('body');
            $table->string('preview');
            $table->integer('rating')->default(0);
            $table->integer('year_rate')->default(0);
            $table->string('synopsis')->default('');
            $table->integer('views')->default(0);
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
        (new Filesystem)->cleanDirectory('storage/app/public/post_images');
        Schema::dropIfExists('posts');
    }
}
