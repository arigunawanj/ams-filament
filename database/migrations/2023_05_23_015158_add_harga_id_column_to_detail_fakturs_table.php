<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_fakturs', function (Blueprint $table) {
            $table->foreignId('harga_id')->after('faktur_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_fakturs', function (Blueprint $table) {
            $table->dropForeign(['harga_id']);
            $table->dropColumn('harga_id');
        });
    }
};
