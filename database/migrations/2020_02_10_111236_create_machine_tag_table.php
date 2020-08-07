<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_tag', function (Blueprint $table) {
            $table->unsignedInteger('machine_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['machine_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_tag', function (Blueprint $table) {
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['tag_id']);
        });

        Schema::dropIfExists('machine_tag');
    }
}
