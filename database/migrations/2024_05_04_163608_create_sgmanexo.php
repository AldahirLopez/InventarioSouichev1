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
        Schema::create('sgmanexo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('estado')->default(false); // Aquí se agrega la columna booleana 'activo'
            $table->unsignedBigInteger('anexo_id')->nullable(); // Agregar columna obra_id
            $table->timestamps();


            // Definir la relación con la tabla obras
            $table->foreign('anexo_id')->references('id')->on('anexo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sgmanexo');
    }
};