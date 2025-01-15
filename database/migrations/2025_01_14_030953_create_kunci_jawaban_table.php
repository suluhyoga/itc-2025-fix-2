<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunci_jawaban', function (Blueprint $table) {
            $table->id('id_kunci');
            $table->unsignedBigInteger('id_kuis');
            $table->string('jawaban_kunci');
            $table->timestamps();

            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunci_jawaban');
    }
};
