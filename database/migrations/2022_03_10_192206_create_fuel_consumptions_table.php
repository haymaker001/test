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
        Schema::create('fuel_consumptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('supply_center_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->integer('initial_odometer')->nullable();
            $table->integer('final_odometer')->nullable();
            $table->decimal('number_of_gallons', 13, 2)->nullable();
            $table->date('created_date')->nullable();
            $table->decimal('total_mileage', 13, 2)->nullable();
            $table->decimal('overall_yield', 13, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supply_center_id')->references('id')->on('supply_centers');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('fuel_consumptions');
    }
};
