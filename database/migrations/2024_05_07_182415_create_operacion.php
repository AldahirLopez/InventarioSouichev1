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
        Schema::create('operacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('rutadoc');
            $table->string('descripcion');
            $table->unsignedBigInteger('usuario_id'); // Agregar columna usuario_id
            $table->unsignedBigInteger('obra_id'); // Agregar columna obra_id
            $table->timestamps();
    
            // Definir la relación con la tabla obras
            $table->foreign('obra_id')->references('id')->on('obras');
    
            // Definir la relación con la tabla users (usuarios)
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operacion');
    }
};
