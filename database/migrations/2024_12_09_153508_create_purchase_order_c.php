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
        Schema::create('PurchaseOrderC', function (Blueprint $table) {
            $table->id();
            $table->integer('pONumber')->unique();
            $table->integer('supplierCode');
            $table->date('pODate')->nullable();
            $table->text('pOObservation')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0: Pendente, 1: Aprovado');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('PurchaseOrderC');
    }
};
