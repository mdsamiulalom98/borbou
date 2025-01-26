<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('10');
            $table->string('fullName')->length('255');
            $table->integer('marital_status')->length('10');
            $table->integer('religion_id')->length('10');
            $table->integer('nationality_id')->length('10');
            $table->integer('country_id')->length('10');
            $table->string('dob')->length('155');
            $table->string('gender')->length('50');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('basic_infos');
    }
};
