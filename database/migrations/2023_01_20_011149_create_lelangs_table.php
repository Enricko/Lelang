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
        Schema::create('lelangs', function (Blueprint $table) {
            $table->id('id_lelang');
            $table->timestamp('tgl_dibuka');
            $table->timestamp('tgl_ditutup');
            $table->bigInteger('harga_akhir')->nullable();
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade');
            $table->unsignedBigInteger('id_petugas');
            $table->enum('status',['dibuka','ditutup']);
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
        Schema::dropIfExists('lelangs');
    }
};
