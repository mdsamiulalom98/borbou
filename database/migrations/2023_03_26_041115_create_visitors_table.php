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
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName')->nullable();
            $table->string('phoneNumber')->unique();
            $table->text('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('verifyToken')->nullable();
            $table->string('passResetToken')->nullable();
            $table->string('image')->default('public/uploads/avatar/avatar.png');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('visitors');
    }
};
