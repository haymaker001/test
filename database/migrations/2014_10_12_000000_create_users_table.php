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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rnc')->nullable();
            $table->string('email')->unique();
            $table->string('user_type')->nullable();
            $table->integer('additional')->nullable();
            $table->integer('amount')->nullable();
            $table->string('calculation_type')->nullable();
            $table->string('api_token')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
