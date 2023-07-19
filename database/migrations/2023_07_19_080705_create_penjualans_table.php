<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code');
            $table->string('pembeli');
            $table->string('telpon');
            $table->double('bruto');
            $table->double('discount')->default(0);
            $table->double('netto');
            $table->uuid('kendaraan_id');
            $table->foreign('kendaraan_id', 'kendaraan_id_penjualans_foreign')
                ->references('_id')
                ->on('kendaraans')
                ->onUpdate('restrict')
                ->onDelete('restrict');
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
        Schema::dropIfExists('penjualans');
    }
}
