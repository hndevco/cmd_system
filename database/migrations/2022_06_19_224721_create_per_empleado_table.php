<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('per_empleado', function (Blueprint $table) {
            $table->id();
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('identidad', 13)->nullable();
            $table->string('telefono', 8);
            $table->string('domicilio', 250);
            
            $table->foreignId('id_usuario')->nullable()->constrained('users');
            $table->foreignId('id_cargo')->nullable()->constrained('tbl_cargo');

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
        Schema::dropIfExists('per_empleado');
    }
}
