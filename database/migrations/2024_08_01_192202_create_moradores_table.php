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
        Schema::create('moradores', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->date('data_nascimento')->nullable();
            $table->string('rg',20)->nullable();
            $table->string('cpf',11)->unique();
            $table->string('telefone',15)->nullable();
            $table->string('celular',15)->nullable();
            $table->string('email',100)->nullable();
            $table->foreignId('unidade_id')->constrained('unidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moradores');
    }
};
