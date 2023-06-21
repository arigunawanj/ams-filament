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
        Schema::create('detail_fakturs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faktur_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('barang_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('harga');
            $table->integer('stok_keluar');
            $table->integer('subtotal');
            $table->integer('total');
            $table->integer('diskon');
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
        Schema::dropIfExists('detail_fakturs');
    }
};
