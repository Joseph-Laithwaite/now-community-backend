<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->text('name');
            $table->text('description');
            $table->foreign('product_id')   //Product ID of the product creating waste
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedBigInteger('reuse_product_id')->nullable();
            $table->foreign('reuse_product_id')   //Product ID of the product created from this waste
                ->references('id')
                ->on('products')
                ->onDelete('set null');
            $table->unsignedBigInteger('recovery_facility_id')->nullable();
            $table->foreign('recovery_facility_id')   //independent ID of the waste management company used
                ->references('id')
                ->on('independents')
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
        Schema::dropIfExists('wastes');
    }
}
