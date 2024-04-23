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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->onUpdate('no action');
            $table->foreignId('pelanggan_id')->nullable()->constrained()->cascadeOnDelete()->onUpdate('no action');
            $table->string('nomor_transaksi')->unique();
            $table->dateTime('tanggal');
            $table->unsignedBigInteger('subtotal');
            $table->unsignedBigInteger('pajak');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('tunai');
            $table->unsignedInteger('diskon')->default(0);
            $table->unsignedBigInteger('kembalian');
            $table->enum('status',['selesai','batal'])->default('selesai');
            $table->timestamps();
        });
    }

/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
