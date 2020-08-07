<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_property', function (Blueprint $table) {
            $table->unsignedInteger('machine_id');
            $table->unsignedInteger('property_id');
            $table->string('value');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->primary(['machine_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_property', function (Blueprint $table) {
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['property_id']);
        });

        Schema::dropIfExists('machine_property');
    }
}
