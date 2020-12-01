<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id') 
                ->references('id')
                ->on('stores')
                ->onDelete('cascade');
            $table->unsignedBigInteger('stockable_id');
            $table->string('stockable_type');                      
            $table->boolean('backorder_available')->default('0');
            $table->integer('desired_stock')->nullable();
            $table->time('lead_time');
            $table->json('delivery_days');
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
        Schema::dropIfExists('stockists');
    }
}
