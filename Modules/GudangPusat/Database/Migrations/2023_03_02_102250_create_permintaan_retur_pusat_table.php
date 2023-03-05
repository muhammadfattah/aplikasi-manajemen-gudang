<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermintaanReturPusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_retur_pusat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_barang')->index();
            $table->uuid('id_cabang')->index();
            $table->string('jumlah');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan_retur_pusat');
    }
}
