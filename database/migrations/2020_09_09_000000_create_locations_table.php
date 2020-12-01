<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->string('location_phone')->nullable();
            $table->string('type')->default('store');     //warehouse, factory, store etc.
            $table->text('description')->nullable();
            $table->text('energy_supply')->nullable();
            $table->boolean('energy_offset')->nullable();
            $table->text('energy_offset_description')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
