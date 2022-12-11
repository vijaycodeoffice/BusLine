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
        Schema::create('bus_station_maps', function (Blueprint $table) {
            $table->id();
            $table->Integer('bus_id');
            $table->Integer('station_id');
            $table->timestamp('time');
            $table->enum('is_active',['In-Active','Active'])->default('active');
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
        Schema::dropIfExists('bus_station_maps');
    }
};
