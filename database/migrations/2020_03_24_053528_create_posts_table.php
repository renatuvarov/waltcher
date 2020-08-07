<?php

use App\Entities\Blog\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->text('content');
            $table->string('slug')->unique();
            $table->json('images')->nullable();
            $table->enum('type', [Post::TYPE_EXHIBITION, Post::TYPE_POST]);
            $table->text('short_description');
            $table->string('meta_description')->nullable();
            $table->string('img');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
