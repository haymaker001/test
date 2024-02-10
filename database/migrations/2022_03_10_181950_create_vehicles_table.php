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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('type_id')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->integer('year')->nullable();
            $table->unsignedBigInteger('vehicle_group_id')->nullable();
            $table->date('lic_exp_date')->nullable();
            $table->date('exp_exp_date')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('horse_power')->nullable();
            $table->string('color')->nullable();
            $table->string('vin')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('mileage')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('is_reportable')->nullable();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
            $table->foreign('vehicle_group_id')->references('id')->on('vehicle_groups');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('vehicles');
    }
};
