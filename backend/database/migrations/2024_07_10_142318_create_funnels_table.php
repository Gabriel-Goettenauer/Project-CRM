<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funnels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id'); // Adiciona a coluna user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define a chave estrangeira
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funnels');
    }
};
