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
        Schema::create('family_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('10');
            $table->string('father_name')->length('255');
            $table->integer('father_profession')->length('10');
            $table->string('mother_name')->length('255');
            $table->integer('mother_profession')->length('10');
            $table->integer('brother_count')->length('10');
            $table->integer('brother_married')->length('10');
            $table->integer('sister_count')->length('10');
            $table->integer('sister_married')->length('10');
            $table->integer('division_id')->length('10');
            $table->integer('district_id')->length('10');
            $table->integer('upazila_id')->length('10');
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
        Schema::dropIfExists('family_locations');
    }
};
