<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->decimal('price');
            $table->decimal('vat')->nullable();
            $table->decimal('deposit')->default('0.00');
            $table->boolean('is_packaging')->default('0');
            $table->boolean('wholesale')->default('0');
            $table->boolean('public_purchase')->default('0');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id') 
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable(); //manufactured at location
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
        Schema::dropIfExists('products');
    }
}
