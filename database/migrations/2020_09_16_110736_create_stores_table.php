<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('independent_id');
            $table->foreign('independent_id') 
                ->references('id')
                ->on('independents')
                ->onDelete('cascade');
            $table->string('type'); //cafe, restuarant, gift shop, arts shop etc.
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id') 
                ->references('id')
                ->on('locations')
                ->onDelete('set null');
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
        Schema::dropIfExists('stores');
    }
}
