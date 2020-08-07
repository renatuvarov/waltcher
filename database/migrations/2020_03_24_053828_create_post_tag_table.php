<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    public function up()
    {
        Schema::create('blog_tag_post', function (Blueprint $table) {
            $table->primary(['post_id', 'tag_id']);
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('blog_tag_post', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['tag_id']);
        });

        Schema::dropIfExists('blog_tag_post');
    }
}
