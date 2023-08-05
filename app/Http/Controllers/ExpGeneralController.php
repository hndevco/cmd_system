<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Auth;

class ExpGeneralController extends Controller
{
    public function ver_expediente_general($id_remision, $id_paciente){
        $id_user = Auth()->id();

        $exp_dispopnible = DB::select("SELECT 1 from tbl_remisiones where id_estado_remision = 2 and id = :id_remision and deleted_at is null
        ", ["id_remision" => $id_remision]);

        if(empty($exp_dispopnible)){
            return view('error');
        }
        
        $paciente = collect(\DB::select("SELECT 
            id,
            concat(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) nombre,
            case 
                when 
                    date_part('year',age(CURRENT_DATE, fecha_nacimiento)) >1 
                then 
                    concat(date_part('year',age(CURRENT_DATE, fecha_nacimiento)),' años') 
                else
                    concat(date_part('year',age(CURRENT_DATE, fecha_nacimiento)),' año') 
            end edad,
            case 
                when 
                    sexo = 'M' 
                then 
                    'Masculino'
                else 
                    'Femenino'
                end sexo, 
            domicilio, telefono, identidad, 
            to_char(CURRENT_DATE,'dd-Mon-yyyy') fecha,
            to_char(current_timestamp, 'HH24:MI') hora
            from reg_ficha_pacientes where deleted_at is null
            and id = :id_paciente
        ", ["id_paciente" => $id_paciente]))->first();

            $medico = DB::select("
            select 
            TRIM(
                COALESCE(TRIM(primer_nombre)||' ','')||
                COALESCE(TRIM(primer_apellido||' '),'')
            ) nombre, telefono celular, c.nombre cargo
            from users u
            join per_empleado ep on u.id = ep.id_usuario
            join tbl_cargos c on ep.id_cargo = c.id
            where u.id = :id_user and ep.deleted_at is null
            ", ["id_user" => $id_user]);

        $sub_siguiente = collect(\DB::select("
            select count(*) existe from tbl_mg_medicina_general where id_paciente = :id_paciente and deleted_at is null
        ", ["id_paciente" => $id_paciente]))->first();

        $glasgow = collect(\DB::select("
        with temp as (
            select id from reg_ficha_pacientes where id = :id_paciente
            )
            SELECT g.glasgow, g.actividad_ocular, g.respuesta_verval, g.respuesta_motora 
            from public.tbl_mg_glasgow g
            right join temp t on g.id_paciente = t.id
            and g.id in (select max(id) from public.tbl_mg_glasgow where g.deleted_at is null and g.id_paciente = :id_paciente ) 
        ", ["id_paciente" => $id_paciente]))->first();

        $estado_conciencia = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT ec.alerta, ec.somnoliento, ec.estupor , ec.coma
                from public.tbl_mg_estado_conciencia ec
                right join temp t on ec.id_paciente = t.id
                and ec.deleted_at is null and ec.id_paciente = :id_paciente
            limit 1
        ", ["id_paciente" => $id_paciente]))->first();

        $consulta_general = collect(\DB::select("
        with temp as (
            select id from reg_ficha_pacientes where id = :id_paciente
            )
        SELECT  mg.antecedentes_patologicos_personales, mg.tratamiento_antecedentes_patologicos_personales, 
            mg.antecendetes_familiares_patologicos, mg.gestas, mg.partos, mg.cesareas, mg.abortos, mg.fecha_ultima_menstruacion, mg.cuales_alergias, 
            mg.tipo_habitos, mg.antecendetes_hospitalarios_quirurgicos
                FROM public.tbl_mg_medicina_general mg
            right join temp t on mg.id_paciente = t.id                
             and mg.id 
            in (select max(id) from public.tbl_mg_medicina_general where mg.deleted_at is null and mg.id_paciente = :id_paciente)  
        ", ["id_paciente" => $id_paciente]))->first();


        return view('exp_general')
        ->with("paciente" , $paciente)
        ->with("id_remision", $id_remision)
        ->with("sub_siguiente", $sub_siguiente)
        ->with("medico", $medico)
        ->with("glasgow", $glasgow)
        ->with("estado_conciencia", $estado_conciencia)
        ->with("consulta_general", $consulta_general)
        ;
    }

    public function guardar_expediente_general(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $id_paciente = $request->id_paciente;
        $id_medico = null;
        $id_remision = $request->id_remision;
        $accion = $request->accion;
        $estado_expediente = $request->estado_expediente;
        //inicio signos vitales
        $temperatura = $request->temperatura;
        $presion_arterial = $request->presion_arterial;
        $peso = $request->peso;
        $talla = $request->talla;
        $saturacion = $request->saturacion;
        $frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $frecuencia_respiratoria = $request->frecuencia_respiratoria;
        $glucometria = $request->glucometria;   
        $sub_siguiente = $request->sub_siguiente;
        $estado_edicion_subsiguiente = $request->estado_edicion_subsiguiente;
        //fin signos vitales
        //incio glasgow
        $glasgow = $request->glasgow;
        $actividad_ocular = $request -> actividad_ocular;
        $respuesta_verval = $request -> respuesta_verval;
        $respuesta_motora = $request -> respuesta_motora;
        //fin GLASGOW
        //inicio estado conciencia
        $alerta = $request -> alerta;
        $somnoliento = $request -> somnoliento;
        $estupor = $request -> estupor;
        $coma = $request -> coma;
       
        //fin estado conciencia
        //inicio medicina general
            //$antecedentes_patologicos_personales = $request -> antecedentes_patologicos_personales;
        $tratamiento_antecedentes_patologicos_personales = $request -> tratamiento_antecedentes_patologicos_personales;
        $antecendetes_familiares_patologicos = $request ->antecendetes_familiares_patologicos;
        $gestas = $request -> gestas;
        $partos = $request -> partos;
        $cesareas = $request -> cesareas;
        $abortos = $request -> abortos;
        $fecha_ultima_menstruacion = $request -> fecha_ultima_menstruacion;
        $cuales_alergias = $request -> cuales_alergias;
        $tipo_habitos = $request -> tipo_habitos;
        $antecendetes_hospitalarios_quirurgicos = $request -> antecendetes_hospitalarios_quirurgicos;
        $motivo_consulta = $request -> motivo_consulta;
        $historia_enfermedad_actual = $request -> historia_enfermedad_actual;
        $examen_fisico = $request -> examen_fisico;
        $diagnostico = $request -> diagnostico;
        $indicaciones_tratamiento = $request -> indicaciones_tratamiento;
        $proxima_cita = $request -> proxima_cita;
        //fin medicina general
        $receta = $request->receta;
        $tbl_mg_medicina_general = null;
        $id_mg_medicina_general = null;

        DB::beginTransaction();
        try{ 
            //inicia deducir medico
            $id_medico = collect(\DB::select("
            select ep.id
                        from public.users u
                        join public.per_empleado ep on u.id = ep.id_usuario
                        join public.tbl_cargos c on ep.id_cargo = c.id
                        where u.id = :id_user and ep.deleted_at is null
            ", ["id_user" => Auth()->id()]))->first();
            //finaliza deducir medico
             //Inicia deducir expediente
             $expediente = collect(\DB::select("SELECT te.id from tbl_remisiones r
             join tbl_areas_clinica ac on r.id_area = ac.id
             join tbl_tipos_expedientes te on ac.id = te.id_area_clinica
             where r.deleted_at is null and r.id = :id_remision
         ", ["id_remision" => $id_remision]))->first();
         $id_expediente = $expediente->id;
         //Finaliza deducir expediente
         
        $tbl_mg_medicina_general = collect(\DB::select("select * from public.tbl_mg_medicina_general
        where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
         ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
        
        $id_mg_medicina_general = isset($tbl_mg_medicina_general->id) ? $tbl_mg_medicina_general->id : null ;
        
        if($id_mg_medicina_general == null && $accion != 1){
            $accion == 1;
        }
        
         if($accion == 1){
        /* INCIO INSERT A LA TABLA DE SIGNOS VITALES */    
        DB::select("INSERT into tbl_signos_vitales 
            (id_paciente, id_expediente, temperatura, presion_arterial, peso, talla, saturacion, 
            frecuencia_cardiaca, frecuencia_respiratoria, id_masa_corporal, glucometria, created_at, id_remision) values 
            (:id_paciente, :id_expediente, :temperatura, :presion_arterial, :peso, :talla, :saturacion, :frecuencia_cardiaca, 
             :frecuencia_respiratoria, null, :glucometria, (now() at time zone 'CST'), :id_remision )",
            ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
            "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
            "glucometria" => $glucometria, "id_remision" => $id_remision]);
        /* FIN INSERT A LA TABLA DE SIGNOS VITALES */ 
        
        /*INICIO INSERT tbl_mg_consulta_general */
        DB::select("INSERT INTO public.tbl_mg_consulta_general(
            id_paciente, id_expediente, id_remision, motivo_consulta, historia_enfermedad_actual, examen_fisico, 
            diagnostico, indicaciones_tratamiento, proxima_cita, created_at)
            VALUES (:id_paciente, :id_expediente, :id_remision, :motivo_consulta, 
                :historia_enfermedad_actual, :examen_fisico, :diagnostico, :indicaciones_tratamiento, :proxima_cita, (now() at time zone 'CST') )",
                ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision,
                    "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual, "examen_fisico" => $examen_fisico, "diagnostico" => $diagnostico,
                    "indicaciones_tratamiento" => $indicaciones_tratamiento, "proxima_cita" => $proxima_cita
                ]);
        /*FIN INSERT tbl_mg_consulta_general */

        //inicio estado conciencia
        DB::select("INSERT INTO public.tbl_mg_estado_conciencia(
            id_paciente, id_expediente, alerta, somnoliento, estupor, coma, created_at, id_remision)
            VALUES (:id_paciente, :id_expediente, :alerta,  :somnoliento, :estupor, :coma, (now() at time zone 'CST'), :id_remision )",
            ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "alerta" => $alerta, "somnoliento" => $somnoliento, "estupor" => $estupor,"coma" => $coma, "id_remision" => $id_remision]
        );
        //fin estado conciencia
        //if($sub_siguiente == 0){
        //inicio insert tbl_mg_glasgow
            DB::select("INSERT INTO public.tbl_mg_glasgow(
                id_paciente, id_expediente, glasgow, actividad_ocular, respuesta_verval, respuesta_motora, 
               created_at, id_remision)
               VALUES (:id_paciente, :id_expediente, :glasgow, :actividad_ocular, :respuesta_verval, :respuesta_motora, (now() at time zone 'CST'), :id_remision )", 
               [ "id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "glasgow" => $glasgow,
               "actividad_ocular" => $actividad_ocular, "respuesta_verval" => $respuesta_verval, "respuesta_motora" => $respuesta_motora, "id_remision" => $id_remision ]);
        //fin insert tbl_mg_glasgow      

        //inicio medicina general
        DB::select(
            "INSERT INTO public.tbl_mg_medicina_general(
                id_paciente, id_expediente, antecedentes_patologicos_personales, 
                tratamiento_antecedentes_patologicos_personales, antecendetes_familiares_patologicos, 
                gestas, partos, cesareas, abortos, fecha_ultima_menstruacion, cuales_alergias, 
                tipo_habitos, antecendetes_hospitalarios_quirurgicos, motivo_consulta, 
                historia_enfermedad_actual, examen_fisico, diagnostico, indicaciones_tratamiento, proxima_cita, created_at, id_remision)
                VALUES (:id_paciente, :id_expediente, null, 
                :tratamiento_antecedentes_patologicos_personales, :antecendetes_familiares_patologicos, 
                :gestas, :partos, :cesareas, :abortos, :fecha_ultima_menstruacion, :cuales_alergias, 
                :tipo_habitos, :antecendetes_hospitalarios_quirurgicos, :motivo_consulta, 
                :historia_enfermedad_actual, :examen_fisico, :diagnostico, :indicaciones_tratamiento, :proxima_cita, (now() at time zone 'CST'), :id_remision)",
                ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "tratamiento_antecedentes_patologicos_personales" => $tratamiento_antecedentes_patologicos_personales,
                "antecendetes_familiares_patologicos" => $antecendetes_familiares_patologicos,
                "gestas" => $gestas, "partos" => $partos, "cesareas" => $cesareas, "abortos" => $abortos,
                "fecha_ultima_menstruacion" => $fecha_ultima_menstruacion, "cuales_alergias" => $cuales_alergias,
                "tipo_habitos" => $tipo_habitos,"antecendetes_hospitalarios_quirurgicos" => $antecendetes_hospitalarios_quirurgicos,
                "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual, "examen_fisico" => $examen_fisico, "diagnostico" => $diagnostico,
                "indicaciones_tratamiento" => $indicaciones_tratamiento, "proxima_cita" => $proxima_cita, "id_remision" => $id_remision
                ]
        );
        //fin medicina general
    //}
        DB::select("INSERT into tbl_receta_medica 
        (id_paciente, id_expediente, id_medico, fecha_elaborada, descripcion_receta, created_at, id_remision) values
        (:id_paciente, :id_expediente, :id_medico, (now() at time zone 'CST'), :descripcion_receta, (now() at time zone 'CST'), :id_remision)        
        ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_medico" => $id_medico, "descripcion_receta" => $receta, "id_remision" => $id_remision]);
      
        //inicia estado expediente
        DB::select("update tbl_remisiones set id_estado_remision = :estado_expediente where id = :id_remision
        ",["estado_expediente" => $estado_expediente, "id_remision" => $id_remision]);
        //finaliza estado expediente
      
        if($estado_expediente == 5){
            $msgSuccess = "Registro de expediente exitoso";
        }elseif($estado_expediente == 3){
            $msgSuccess = "Enviando expediente a Observación...";
        }
    }else if($accion == 2){
        //inicia signos vitales
        DB::select("UPDATE tbl_signos_vitales set
        temperatura = :temperatura, presion_arterial = :presion_arterial, peso = :peso, talla = :talla, 
        saturacion = :saturacion, frecuencia_cardiaca = :frecuencia_cardiaca, frecuencia_respiratoria = :frecuencia_respiratoria, 
        glucometria = :glucometria, updated_at = (now() at time zone 'CST')
        where deleted_at is null and
        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
        "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
        "glucometria" => $glucometria]);
    //finaliza signos vitales
    
    //inicia update tbl_mg_consulta_general
        DB::select("UPDATE public.tbl_mg_consulta_general
            SET  motivo_consulta=:motivo_consulta, historia_enfermedad_actual=:historia_enfermedad_actual,
            examen_fisico=:examen_fisico, diagnostico=:diagnostico, indicaciones_tratamiento=:indicaciones_tratamiento, proxima_cita=:proxima_cita,  updated_at= (now() at time zone 'CST')
            WHERE deleted_at is null and                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision",
                ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision,
                            "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual, "examen_fisico" => $examen_fisico, "diagnostico" => $diagnostico,
                            "indicaciones_tratamiento" => $indicaciones_tratamiento, "proxima_cita" => $proxima_cita
                ]);
    //fin update tbl_mg_consulta_general

    //inicia glasgow
        DB::select("UPDATE public.tbl_mg_glasgow
        SET glasgow=:glasgow, actividad_ocular=:actividad_ocular, respuesta_verval=:respuesta_verval, 
        respuesta_motora=:respuesta_motora, updated_at=(now() at time zone 'CST')
        WHERE deleted_at is null and
            id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
        ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "glasgow" => $glasgow,
          "actividad_ocular" => $actividad_ocular, "respuesta_verval" => $respuesta_verval, "respuesta_motora" => $respuesta_motora
        ]);
    //finaliza glasgow
    //inicio estado conciencia
        DB::select("UPDATE public.tbl_mg_estado_conciencia
        SET   alerta=:alerta, somnoliento=:somnoliento,
        estupor=:estupor, coma=:coma, updated_at=(now() at time zone 'CST'), id_remision=:id_remision
        WHERE id_paciente=:id_paciente and id_expediente=:id_expediente and id_remision=:id_remision
        ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "alerta" => $alerta,
          "somnoliento" => $somnoliento, "estupor" => $estupor, "coma" => $coma
        ]);
    //fin estado conciencia
    //inicio medicina general
        DB::select("UPDATE public.tbl_mg_medicina_general
        SET   tratamiento_antecedentes_patologicos_personales=:tratamiento_antecedentes_patologicos_personales, 
        antecendetes_familiares_patologicos=:antecendetes_familiares_patologicos, gestas=:gestas, partos=:partos, cesareas=:cesareas, abortos=:abortos,
        fecha_ultima_menstruacion=:fecha_ultima_menstruacion, cuales_alergias=:cuales_alergias, 
        tipo_habitos=:tipo_habitos, antecendetes_hospitalarios_quirurgicos=:antecendetes_hospitalarios_quirurgicos, motivo_consulta=:motivo_consulta,
        historia_enfermedad_actual=:historia_enfermedad_actual, examen_fisico=:examen_fisico, diagnostico=:diagnostico,
        indicaciones_tratamiento=:indicaciones_tratamiento, proxima_cita=:proxima_cita, updated_at=(now() at time zone 'CST'), id_remision=:id_remision
        WHERE id_paciente=:id_paciente and id_expediente=:id_expediente and id_remision=:id_remision
        ",[
            "id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "tratamiento_antecedentes_patologicos_personales" => $tratamiento_antecedentes_patologicos_personales,
            "antecendetes_familiares_patologicos" => $antecendetes_familiares_patologicos,
            "gestas" => $gestas, "partos" => $partos, "cesareas" => $cesareas, "abortos" => $abortos,
            "fecha_ultima_menstruacion" => $fecha_ultima_menstruacion, "cuales_alergias" => $cuales_alergias,
            "tipo_habitos" => $tipo_habitos,"antecendetes_hospitalarios_quirurgicos" => $antecendetes_hospitalarios_quirurgicos,
            "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual, "examen_fisico" => $examen_fisico, "diagnostico" => $diagnostico,
            "indicaciones_tratamiento" => $indicaciones_tratamiento, "proxima_cita" => $proxima_cita
        ]);

        DB::select("
        UPDATE public.tbl_receta_medica SET
        descripcion_receta= :descripcion_receta, updated_at = (now() at time zone 'CST')
        where deleted_at is null and
        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
        "descripcion_receta" => $receta]);
    //fin medicina general
    $msgSuccess = "Registro editado exitosamente";
    }
        DB::commit();
        }catch (Exception $e){
             DB::rollback();
            $msgError=$e->getMessage();
        }


        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError]);

    }
}
