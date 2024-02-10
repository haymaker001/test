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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->dateTime('pickup')->nullable();
            $table->dateTime('dropoff')->nullable();
            $table->text('note')->nullable();
            $table->string('travellers')->nullable();
            $table->string('helper')->nullable();
            $table->string('container')->nullable();
            $table->string('dolly')->nullable();
            $table->string('locations')->nullable();
            $table->integer('destinations')->nullable();
            $table->decimal('rate', 13, 2)->nullable();
            $table->decimal('additionals', 13, 2)->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->unsignedBigInteger('travel_type_id')->nullable();
            $table->decimal('diet', 13, 2)->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('driver_id')->references('id')->on('users');
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
        Schema::dropIfExists('bookings');
    }
};
