<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('investment_amount')->nullable();
            $table->string('equity_amount')->nullable();
            $table->unsignedBigInteger('independent_id');
            $table->foreign('independent_id')
                ->references('id')
                ->on('independents')
                ->onDelete('cascade');
            $table->unsignedBigInteger('investor_id')->nullable();
            $table->foreign('investor_id')
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
        Schema::dropIfExists('investors');
    }
}
