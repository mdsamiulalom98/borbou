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
        Schema::create('physical_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('10');
            $table->integer('height')->length('10');
            $table->integer('weight')->length('10');
            $table->integer('body_type')->length('10');
            $table->integer('complexion')->length('10');
            $table->integer('blood_group')->length('10');
            $table->integer('eye_color')->length('10');
            $table->integer('hair_type')->length('10');
            $table->integer('hair_color')->length('10');
            $table->integer('physical_problem')->length('10');
            $table->integer('any_disease')->length('10');
            $table->string('special_skills')->length('255');
            $table->string('title')->length('255');
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
        Schema::dropIfExists('physical_attributes');
    }
};
