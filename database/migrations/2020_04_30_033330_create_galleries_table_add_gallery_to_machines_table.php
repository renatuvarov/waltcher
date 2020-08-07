<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTableAddGalleryToMachinesTable extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->json('images');
            $table->unsignedInteger('machine_id')->nullable();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign(['machine_id']);
        });

        Schema::dropIfExists('galleries');
    }
}
