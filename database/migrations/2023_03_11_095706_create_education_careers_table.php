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
        Schema::create('education_careers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('10');
            $table->integer('marital_status')->length('10');
            $table->integer('religion_id')->length('10');
            $table->integer('nationality_id')->length('10');
            $table->integer('country_id')->length('10');
            $table->integer('working_id')->length('10');
            $table->integer('profession_id')->length('10');
            $table->text('profession_details');
            $table->integer('monthly_privacy')->length('10');
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
        Schema::dropIfExists('education_careers');
    }
};
