<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')   //Product ID of the product using the component
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('component_id');
            $table->foreign('component_id') //Product ID of component being used as part of another product
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->dateTime('supplied_from');
            $table->dateTime('supplied_until')->nullable();
            $table->boolean('supplier_verified')->default('0');
            $table->boolean('independently_verified')->default('0');
            $table->text('transport_type')->nullable();
            $table->text('transport_distance')->nullable();
            $table->text('transport_time')->nullable();
            $table->text('esimated_transport_emissions')->nullable();
            $table->boolean('transport_emmisions_offset')->default('0');
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
        Schema::dropIfExists('components');
    }
}
