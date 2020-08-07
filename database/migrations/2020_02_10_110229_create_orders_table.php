<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('machine_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_company');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->boolean('viewed')->default(false);
            $table->timestamps();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['machine_id']);
        });

        Schema::dropIfExists('orders');
    }
}
