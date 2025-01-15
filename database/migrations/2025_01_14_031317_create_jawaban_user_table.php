<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_user', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->unsignedBigInteger('id_kuis');
            $table->string('jawaban_user');
            $table->boolean('benar_salah')->nullable();
            $table->timestamps();

            $table->foreign('id_kuis')->references('id')->on('kuis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_user');
    }
};
