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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dep')->unique();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_dep');
            $table->integer('jumlah_masuk');
            $table->integer('jumlah_keluar');
            $table->string('foto_dep')->nullable();
            $table->string('ket_dep')->nullable();
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
        Schema::dropIfExists('setorans');
    }
};
