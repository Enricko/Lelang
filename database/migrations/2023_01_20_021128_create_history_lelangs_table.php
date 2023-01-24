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
        Schema::create('history_lelangs', function (Blueprint $table) {
            $table->id('id_history');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade');
            $table->unsignedBigInteger('id_lelang');
            $table->foreign('id_lelang')->references('id_lelang')->on('lelangs')->onDelete('cascade');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('penawaran_harga');
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
        Schema::dropIfExists('history_lelangs');
    }
};
