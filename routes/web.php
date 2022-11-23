<?php
//use App\Http\Controllers\PrimeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\ExpGeneralController;
use App\Http\Controllers\ExpGinecologicoController;
use App\Http\Controllers\ExpPediatricoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\PediatriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);
Route::group(['middleware' => ['auth']], function() {
Route::match(['get', 'post'], 'ajax-file-upload', [PrimeController::class, 'ajaxFile']);

//inicia empleado y permisos de usuario by cgarcia
Route::get("/empleado", [EmpleadoController::class, "ver_per_empleado"]);
Route::get("/empleado/{id_usuario}/perfil-usuario", [EmpleadoController::class, "ver_per_empleado_perfil_usuario"]);
Route::post("/empleado/guardar", [EmpleadoController::class, "guardar_per_empleado"]);
Route::get("/configuraciones/registrar", [EmpleadoController::class, "ver_users"]);
Route::post("/configuraciones/registrar/guardar", [EmpleadoController::class, "guardar_users"]);
Route::post("/configuraciones/permisos/guardar", [EmpleadoController::class, "guardar_seg_usuario_permisos"]);
Route::post("/configuraciones/usuario/reinicio-clave/guardar", [EmpleadoController::class, "guardar_seg_usuario_clave_reinicio"]);
Route::get("/configuraciones/usuario/cambio-calve", [EmpleadoController::class, "ver_users_cambio_clave"]);
Route::post("/configuraciones/usuario/cambio-calve/guardar", [EmpleadoController::class, "guardar_users_cambio_clave"]);
//fin empleado y permisos de usuario

Route::get("/reporte/hola-mundo",[ReportesController::class, "ver_reporte_hola_mundo"]);

//Inicia Matute expediente ginecologico, pediatrico
Route::get("/exp_ginecologico/id_remision/{id_remision}/paciente/{id_paciente}", [ExpGinecologicoController::class, "ver_expediente_ginecologico"]);
Route::post("/exp/ginecologico/paciente/guardar", [ExpGinecologicoController::class, "guardar_expediente_ginecologico"]);
Route::get("/exp_pediatrico/id_remision/{id_remision}/paciente/{id_paciente}", [ExpPediatricoController::class, "ver_expediente_pediatrico"]);
Route::post("/exp/pediatrico/paciente/guardar", [ExpPediatricoController::class, "guardar_expediente_pediatrico"]);
//Finaliza Matute expediente ginecologico, pediatrico


//Inicia orlin expediente general
Route::get("/exp/general/id_remision/{id_remision}/paciente/{id_paciente}", [ExpGeneralController::class, "ver_expediente_general"]);
Route::post("/exp/general/paciente/guardar", [ExpGeneralController::class, "guardar_expediente_general"]);
//Finaliza orlin expediente general

//Inicia Remisiones
Route::get("/remisiones/{id_paciente}/paciente", [PacienteController::class, "ver_tbl_remisiones"]);
Route::post("/remisiones/paciente/guardar", [PacienteController::class, "guardar_tbl_remisiones"]);
Route::get("/medico/sala-espera/remisiones", [EmpleadoController::class, "ver_medico_tbl_remisiones"]);
Route::post("/sala-espera/remisiones/paciente/estado", [PacienteController::class, "guardar_remisiones_estado"]);
//Fin Remisiones

});

//Inicia Ardon Modulo paciente
Route::get("/recepcion", [PacienteController::class, "vista_recepcion"])->name("vista_recepcion");
Route::get("/recepcion/listar/pacientes", [PacienteController::class, "obtener_lista_pacientes"])->name("obtener_lista_pacientes");
Route::post("/recepcion/guardar/paciente", [PacienteController::class, "guardar_paciente"])->name("guardar_paciente");
Route::get("/registro/modificar/paciente/{id_paciente}", [PacienteController::class, "vista_modificar_paciente"])->name("vista_modificar_paciente");
Route::POST("/registro/update/informacion/paciente", [PacienteController::class, "update_informacion_paciente"])->name("update_informacion_paciente");
//finaliza Ardon Modulo paciente

//Inicia modulo historial clinico by Ardon
Route::get("/historial-clinico/paciente/{id_paciente}", [PacienteController::class, "historial_consultas_paciente"])->name("historial_clinico");
Route::get("/historial-clinico/paciente/{id_paciente}/historialclincio", [PacienteController::class, "historial_clinico"]);

Route::get("/historial-clinico-fisico/paciente/{id_paciente}/historialclinicofisico", [PacienteController::class, "historial_clinico_fisico"]);
Route::post("expediente-fisico/subir-expediente", [PacienteController::class, "subir_historial_clinico_fisico"]);
Route::get("/expediente-fisico/eliminar-examen/id_examen/{id_examen}", [PacienteController::class, "eliminar_expediente_fisico"]);

Route::get("/historial-clinico/paciente/{id_paciente}/remision/{id_remision}/expediente/{id_expediente}", [PacienteController::class, "ver_expdiente"]);
Route::get("/examenes-laboratorio/paciente/{id_paciente}/remision/{id_remision}/expediente/{id_expediente}", [PacienteController::class, "ver_examenes"]);
Route::get("/examenes-laboratorio-historial/paciente/{id_paciente}/remision/{id_remision}/expediente/{id_expediente}", [PacienteController::class, "historial_examenes_laboratorio"]);
Route::post("/examenes-laboratorio/subir-examen", [PacienteController::class, "subir_examenes"]);
Route::get("/examenes-laboratorio/eliminar-examen/id_examen/{id_examen}", [PacienteController::class, "eliminar_examenes"]);
Route::get("/historial-clinico-pacientes", [PacienteController::class, "vista_historial_clincio_pacientes"]);
//Finaliza historial clinico

// Inicia farmacia
Route::get("/farmacia/recetas", [FarmaciaController::class, "ver_recetas"]);
Route::get("/farmacia/lista_recetas", [FarmaciaController::class, "lista_recetas"]);
Route::get("/farmacia/lista_recetas_atendidas", [FarmaciaController::class, "lista_recetas_atendidas"]);
Route::post("/farmacia/ver_receta", [FarmaciaController::class, "ver_receta_unica"]);
Route::post("/farmacia/paciente_atendido_receta", [FarmaciaController::class, "paciente_atendido_receta"]);
// Finaliza farmacia

//Inicia modulo grafico curva by ardon
Route::get("/pediatria/data/percetiles/infantes/masculinos/estatura-edad", [PediatriaController::class, "get_data_percentiles_infantes_masculinos_estatura_edad"])->name("get_data_percentiles_infantes_masculinos_estatura_edad");
//Finaliza modulo grafico curva by ardon

//Inicia archivos Matute
Route::get("/archivos-pacientes", [PacienteController::class, "vista_archivos_listado_pacientes"]);
Route::get("/archivos/paciente/{id_paciente}", [PacienteController::class, "historial_archivos"]);
Route::get("/archivos/paciente/{id_paciente}/remision/{id_remision}/expediente/{id_expediente}", [PacienteController::class, "ver_otros_archios"]);
Route::post("/archivos/subir-archivo", [PacienteController::class, "subir_otros_archivos"]);
Route::get("/archivos-listado/paciente/{id_paciente}/remision/{id_remision}/expediente/{id_expediente}", [PacienteController::class, "historial_otros_archivos"]);
Route::get("/archivos-descargar/{archivo}", [PacienteController::class, "descargar_archivo"]);
Route::get("/archivos-eliminar/archivo/{id_archivo}", [PacienteController::class, "eliminar_otros_archivos"]);
//finaliza archivos Matute
