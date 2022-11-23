<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegFichaPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_ficha_pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('identidad', 13)->nullable();
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50)->nullable();
            $table->dateTime('fecha_nacimiento', 50);
            $table->string('sexo', 1);
            $table->string('telefono', 8);
            $table->string('domicilio', 250);
            $table->string('nombre_padre', 100)->nullable();
            $table->string('nombre_madre', 100)->nullable();
            $table->string('nombre_tutor', 100)->nullable();
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_ficha_pacientes');
    }
}
