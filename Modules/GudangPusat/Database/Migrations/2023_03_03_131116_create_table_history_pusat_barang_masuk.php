<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoryPusatBarangMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_barang_masuk_pusat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_barang');
            $table->uuid('id_supplier');
            $table->uuid('jumlah');
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
        Schema::dropIfExists('history_barang_masuk_pusat');
    }
}
