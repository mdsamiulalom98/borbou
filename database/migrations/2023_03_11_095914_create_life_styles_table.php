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
        Schema::create('life_styles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('10');
            $table->integer('family_value')->length('10');
            $table->integer('religious_value')->length('10');
            $table->integer('food_habit')->length('10');
            $table->integer('drinking_habit')->length('10');
            $table->integer('smoking_habit')->length('10');
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
        Schema::dropIfExists('life_styles');
    }
};
