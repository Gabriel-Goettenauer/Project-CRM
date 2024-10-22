<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('cpf')->unique();
            $table->string('address');
            $table->date('date_of_birth');
            $table->decimal('value', 10, 2);
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->string('ddd_location')->nullable(); // Adiciona o campo ddd_location
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
