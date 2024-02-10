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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->decimal('rate', 12, 2)->nullable();
            $table->unsignedBigInteger('travel_type_id')->nullable();
            $table->integer('stop_amount')->nullable();
            $table->string('is_active')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('travel_type_id')->references('id')->on('travel_types');
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
        Schema::dropIfExists('rates');
    }
};
