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
        Schema::connection('second_mysql')->create('dictamen_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('Numerodictamen');
            $table->string('rutadoc');
            $table->unsignedBigInteger('dictamen_id'); // Agregar columna usuario_id
            $table->unsignedBigInteger('usuario_id'); // Agregar columna usuario_id
            $table->timestamps();

            // Definir la relación con la tabla dictamenes
            $table->foreign('dictamen_id')->references('id')->on('dictamen');

            // Definir la relación con la tabla users (usuarios) en la primera base de datos
            $table->foreign('usuario_id')->references('id')->on('invsou.users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('second_mysql')->dropIfExists('dictamen_archivos');
    }
};
