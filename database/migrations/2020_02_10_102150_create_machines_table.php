<?php

use App\Entities\Catalog\Machine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('img');
            $table->text('mail');
            $table->json('images')->nullable();
            $table->string('short_name', 100);
            $table->text('short_description');
            $table->string('meta_description')->nullable();
            $table->boolean('is_landing')->nullable();
            $table->string('pdf')->nullable();
            $table->enum('type', array_keys(Machine::getTypes()));
        });
    }

    public function down()
    {
        Schema::dropIfExists('machines');
    }
}
