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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->Integer('route_id');
            $table->enum('type',['Seating','Sleeper'])->default('Seating');
            $table->enum('category',['Non-AC','AC'])->default('Non-AC');
            $table->string('capacity');
            $table->timestamp('start_time');
            $table->string('end_time');
            $table->enum('status',['Available','Booked'])->default('Available');
            $table->enum('is_active',['In-Active','Active'])->default('Active');
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
        Schema::dropIfExists('buses');
    }
};
