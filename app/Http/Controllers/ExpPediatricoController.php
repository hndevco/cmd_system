<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Exception;

class ExpPediatricoController extends Controller
{
    public function ver_expediente_pediatrico($id_remision, $id_paciente){
        $id_user = Auth()->id();

        $exp_dispopnible = DB::select("SELECT 1 from tbl_remisiones where id_estado_remision = 2 and id = :id_remision and deleted_at is null
        ", ["id_remision" => $id_remision]);

        if(empty($exp_dispopnible)){
            return view('error');
        }

        $paciente = collect(\DB::select("
            select 
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
            to_char(current_date,'TMDay')||', '||to_char( current_date ,'dd')||' de '||to_char(current_date,'TMMonth')||' de '||to_char(current_date,'yyyy') fecha,
            to_char(current_timestamp, 'HH12:MI AM') hora,
            extract(YEAR FROM age(now()::DATE ,fecha_nacimiento::DATE))*12 + extract(MONTH FROM age (to_char(now(), 'YYYY/MM/DD')::DATE, fecha_nacimiento::DATE)) meses
            from reg_ficha_pacientes where deleted_at is null
            and id = :id_paciente
        ", ["id_paciente" => $id_paciente]))->first();

        $medico = collect(\DB::select("
            select 
            TRIM(
                COALESCE(TRIM(primer_nombre)||' ','')||
                COALESCE(TRIM(primer_apellido||' '),'')
            ) nombre, telefono celular, c.nombre cargo
            from users u
            join per_empleado ep on u.id = ep.id_usuario
            join tbl_cargos c on ep.id_cargo = c.id
            where u.id = :id_user and ep.deleted_at is null
        ", ["id_user" => $id_user]))->first();

        $tipos_sangre = DB::select("
            select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
        ");

        $tipos_partos = DB::select("
            select id, nombre from tbl_tipos_partos where deleted_at is null order by nombre
        ");

        $indice_masa_corporal = DB::select("
            select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
        ");

        $sub_siguiente = collect(\DB::select("
            select count(*) existe from tbl_exp_pediatrico where id_paciente = :id_paciente and deleted_at is null
        ", ["id_paciente" => $id_paciente]))->first();
        
        // $sub_siguiente = collect(\DB::select("select 0 existe"))->first();

        $consulta = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT ep.id_remision, ep.antecedentes_personales_patologicos, ep.tratamiento_antecedentes_personales_patologicos, 
                ep.antecedentes_familiares_patologicos, ep.antecedentes_hospitalarios_quirurgicos, ep.inmunizacion, ep.tipo_alergia
                FROM public.tbl_exp_pediatrico ep
                right join temp t on ep.id_paciente = t.id
                and ep.id in (select max(id) from tbl_exp_pediatrico where deleted_at is null and id_paciente = :id_paciente)
        ", ["id_paciente" => $id_paciente]))->first();

        $antecendentes_prenatales = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT ap.nombre_madre, ap.edad, ap.id_tipo_sangre, ap.enfermedades_durante_embarazo, ap.gestas, ap.partos, 
                ap.cesarias, ap.control_prenatal_ultimo_embarazo
                FROM public.tbl_ped_antecendentes_prenatales ap
                right join temp t on ap.id_paciente = t.id
                and ap.id in (select max(id) from tbl_ped_antecendentes_prenatales where deleted_at is null and id_paciente = :id_paciente)
        ", ["id_paciente" => $id_paciente]))->first();

        $natalicio = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT n.lugar_nacimiento, n.apgar, n.peso, n.talla, n.perimetro_cefalico, n.id_tipo_parto, n.complicaciones_parto
                FROM public.tbl_ped_natalicio n
                right join temp t on n.id_paciente = t.id
                and n.id in (select max(id) from tbl_ped_antecendentes_prenatales where deleted_at is null and id_paciente = :id_paciente)
        ", ["id_paciente" => $id_paciente]))->first();

        $desarrollo_psicomotor = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT coalesce(dp.sonrio::int, 2) sonrio, coalesce(dp.sostuvo_cabeza::int, 2) sostuvo_cabeza, 
                coalesce(dp.se_sento::int, 2) se_sento, coalesce(dp.se_paro::int, 2) se_paro,
                coalesce(dp.comino_solo::int, 2) comino_solo, coalesce(dp.habla::int, 2) habla, 
                coalesce(dp.control_esfinteres::int, 2) control_esfinteres, dp.escolaridad_actual
                FROM public.tbl_ped_desarrollo_psicomotor dp
                right join temp t on dp.id_paciente = t.id
                and dp.id in (select max(id) from tbl_ped_desarrollo_psicomotor where deleted_at is null and id_paciente = :id_paciente)
        ", ["id_paciente" => $id_paciente]))->first();

        $lactancia = collect(\DB::select("
            with temp as (
                select id from reg_ficha_pacientes where id = :id_paciente
                )
                SELECT coalesce(l.lactancia_materna::int, 2) lactancia_materna, coalesce(l.lactancia_artificial::int, 2) lactancia_artificial, l.ablactacion
                FROM public.tbl_ped_lactancia l
                right join temp t on l.id_paciente = t.id
                and l.deleted_at is null and l.id_paciente = :id_paciente
            limit 1
        ", ["id_paciente" => $id_paciente]))->first();

        return view('exp_pediatrico')
        ->with("paciente" , $paciente)
        ->with("medico", $medico)
        ->with("tipos_sangre", $tipos_sangre)
        ->with("indice_masa_corporal", $indice_masa_corporal)
        ->with("tipos_partos", $tipos_partos)
        ->with("id_remision", $id_remision)->with("consulta", $consulta)
        ->with("antecendentes_prenatales", $antecendentes_prenatales)
        ->with("natalicio", $natalicio)
        ->with("desarrollo_psicomotor", $desarrollo_psicomotor)
        ->with("lactancia", $lactancia)
        ->with("sub_siguiente", $sub_siguiente);
    }

    public function guardar_expediente_pediatrico(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $id_paciente = $request->id_paciente;
        $id_medico = Auth()->id();
        $id_remision = $request->id_remision;
        $accion = $request->accion;
        $estado_expediente = $request->estado_expediente;
        $sub_siguiente = $request->sub_siguiente;
        $estado_edicion_subsiguiente = $request->estado_edicion_subsiguiente;
        //inicia sigons vitales
        $temperatura = $request->temperatura;
        $presion_arterial = $request->presion_arterial;
        $peso = $request->peso;
        $talla = $request->talla;
        $saturacion = $request->saturacion;
        $frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $frecuencia_respiratoria = $request->frecuencia_respiratoria;
        $glucometria = $request->glucometria;
        //finaliza sigons vitales
        //inicia consulta
        $historia_enfermedad_actual = $request->historia_enfermedad_actual;
        $motivo_consulta = $request->motivo_consulta;
        $antecedentes_personales_patologicos = $request->antecedentes_personales_patologicos;
        $tratamientos = $request->tratamientos;
        $afp = $request->afp;
        $antecedentes_hospitalarios_quirurgicos = $request->antecedentes_hospitalarios_quirurgicos;
        $inmunizacion = $request->inmunizacion;
        $alergias = $request->alergias;
        //finaliza consulta
        //inicia antecedentes prenatales
        $nombre_madre = $request->nombre_madre;
        $edad_madre = $request->edad_madre;
        $tipo_sangre = $request->tipo_sangre;
        $enfer_durante_embarazo = $request->enfer_durante_embarazo;
        $numero_gestas_previas = $request->numero_gestas_previas;
        $numero_partos = $request->numero_partos;
        $numero_cesareas = $request->numero_cesareas;
        $numero_control_prenatal_utlimo_parto = $request->numero_control_prenatal_utlimo_parto;
        //finaliza antecedentes prenatales
        //inicia natalicio
        $nace_en = $request->nace_en;
        $apgar = $request->apgar;
        $peso_natalicio = $request->peso_natalicio;
        $talla_natalicio = $request->talla_natalicio;
        $perimetro_cefalico = $request->perimetro_cefalico;
        $tipo_parto = $request->tipo_parto;
        $complicaciones_parto = $request->complicaciones_parto;
        //finaliza natalicio
        //inicia desarrollo psicomotor
        $checkboxSonrio = $request->checkboxSonrio;
        $checkboxSostuvoCabeza = $request->checkboxSostuvoCabeza;
        $checkboxSeSento = $request->checkboxSeSento;
        $checkboxSeParo = $request->checkboxSeParo;
        $checkboxCaminoSolo = $request->checkboxCaminoSolo;
        $checkboxHabla = $request->checkboxHabla;
        $checkboxControlEsfinteres = $request->checkboxControlEsfinteres;
        $escolaridad_actual = $request->escolaridad_actual;
        //finaliza desarrollo psicomotor
        //inicia lactancia
        $checkboxMixta = $request->checkboxMixta;
        if($checkboxMixta == "true"){
            $checkboxMaterna = true;
            $checkboxArtificial = true;
        }else{
            $checkboxMaterna = $request->checkboxMaterna;
            $checkboxArtificial = $request->checkboxArtificial;  
        }
        $ablactacion = $request->ablactacion;
        $alimentacion_actual = $request->alimentacion_actual;
        //finaliza lactancia
        //inicia examen fisico
        $examen_fisico = $request->examen_fisico;
        //finaliza examen fisico
        //inicia examen diagnostico
        $diagnostico = $request->diagnostico;
        //finaliza examen diagnostico
        //inicia examen indicaciones
        $indicaciones = $request->indicaciones;
        //finaliza examen indicaciones
        $receta = $request->receta;

        DB::beginTransaction();
        try{ 
            //Inicia deducir expediente
            $expediente = collect(\DB::select("SELECT te.id from tbl_remisiones r
                join tbl_areas_clinica ac on r.id_area = ac.id
                join tbl_tipos_expedientes te on ac.id = te.id_area_clinica
                where r.deleted_at is null and r.id = :id_remision
            ", ["id_remision" => $id_remision]))->first();
            $id_expediente = $expediente->id;
            //Finaliza deducir expediente
            if($accion == 1){
                //inicia insert signos vitales
                DB::select("
                    insert into tbl_signos_vitales 
                    (id_paciente, id_expediente, id_remision, temperatura, presion_arterial, peso, talla, saturacion, 
                    frecuencia_cardiaca, frecuencia_respiratoria, glucometria, created_at) values 
                    (:id_paciente, :id_expediente, :id_remision, :temperatura, :presion_arterial, :peso, :talla, :saturacion, :frecuencia_cardiaca, 
                        :frecuencia_respiratoria, :glucometria, now())
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
                    "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
                    "glucometria" => $glucometria]);
                //finaliza insert signos vitales
                DB::select("
                    INSERT INTO public.tbl_exp_pediatrico_hea_mc(
                    id_paciente, id_expediente, id_remision, motivo_consulta, historia_enfermedad_actual, created_at)
                    VALUES (:id_paciente, :id_expediente, :id_remision, :motivo_consulta, :historia_enfermedad_actual, now())
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual]);
                //if($sub_siguiente == 0){
                    //inicia consulta
                        DB::select("
                        insert into tbl_exp_pediatrico
                        (id_paciente, id_expediente, id_remision, motivo_consulta, historia_enfermedad_actual, antecedentes_personales_patologicos,
                        tratamiento_antecedentes_personales_patologicos, antecedentes_familiares_patologicos, antecedentes_hospitalarios_quirurgicos,
                        inmunizacion, tipo_alergia, created_at) values
                        (:id_paciente, :id_expediente, :id_remision, :motivo_consulta, :historia_enfermedad_actual, :antecedentes_personales_patologicos, :tratamientos, :afp, :antecedentes_hospitalarios_quirurgicos, :inmunizacion, :alergias, now())
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual,
                        "antecedentes_personales_patologicos" => $antecedentes_personales_patologicos, "tratamientos" => $tratamientos, "afp" => $afp, "antecedentes_hospitalarios_quirurgicos" => $antecedentes_hospitalarios_quirurgicos, "inmunizacion" => $inmunizacion, "alergias" => $alergias]);
                    //finaliza consulta
                    //inicia antecedentes prenatales
                    DB::select("
                        insert into tbl_ped_antecendentes_prenatales 
                        (id_paciente, id_expediente, id_remision, nombre_madre, edad, id_tipo_sangre,
                        enfermedades_durante_embarazo, gestas, partos, 
                        cesarias, control_prenatal_ultimo_embarazo, created_at) values
                        (:id_paciente, :id_expediente, :id_remision, :nombre_madre, :edad, :id_tipo_sangre, 
                        :enfermedades_durante_embarazo, :gestas, :partos, :cesarias, :control_prenatal_ultimo_embarazo, now())
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "nombre_madre" => $nombre_madre, "edad" => $edad_madre, "id_tipo_sangre" => $tipo_sangre,
                    "enfermedades_durante_embarazo" => $enfer_durante_embarazo, "gestas" => $numero_gestas_previas, "partos" => $numero_partos, 
                    "cesarias" => $numero_cesareas, "control_prenatal_ultimo_embarazo" => $numero_control_prenatal_utlimo_parto]);
                    //finaliza antecedentes prenatales
                    //inicia natalicio
                    DB::select("
                        insert into tbl_ped_natalicio 
                        (id_paciente, id_expediente, id_remision, lugar_nacimiento, apgar, peso, talla, perimetro_cefalico, id_tipo_parto, complicaciones_parto, created_at) values
                        (:id_paciente, :id_expediente, :id_remision, :lugar_nacimiento, :apgar, :peso_natalicio, :talla_natalicio, :perimetro_cefalico, :tipo_parto, :complicaciones_parto, now())
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "lugar_nacimiento" => $nace_en, "apgar" => $apgar, "peso_natalicio" => $peso_natalicio,
                    "talla_natalicio" => $talla_natalicio, "perimetro_cefalico" => $perimetro_cefalico, "tipo_parto" => $tipo_parto, 
                    "complicaciones_parto" => $complicaciones_parto]);
                    //finaliza natalicio
                    //inicia desarrollo psicomotor
                    DB::select("
                        INSERT INTO public.tbl_ped_desarrollo_psicomotor(
                        id_paciente, id_expediente, id_remision, sonrio, sostuvo_cabeza, se_sento, se_paro, comino_solo, habla, control_esfinteres, escolaridad_actual, created_at )
                        VALUES (:id_paciente, :id_expediente, :id_remision, :checkboxSonrio, :checkboxSostuvoCabeza, :checkboxSeSento, :checkboxSeParo, :checkboxCaminoSolo, :checkboxHabla, 
                        :checkboxControlEsfinteres, :escolaridad_actual, now());
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "checkboxSonrio" => $checkboxSonrio, "checkboxSostuvoCabeza" => $checkboxSostuvoCabeza, 
                    "checkboxSeSento" => $checkboxSeSento, "checkboxSeParo" => $checkboxSeParo, "checkboxCaminoSolo" => $checkboxCaminoSolo, "checkboxHabla" => $checkboxHabla, 
                    "checkboxControlEsfinteres" => $checkboxControlEsfinteres, "escolaridad_actual" => $escolaridad_actual]);
                    //finaliza desarrollo psicomotor
                    //inicia lactancia
                    DB::select("
                        INSERT INTO public.tbl_ped_lactancia(
                        id_paciente, id_expediente, id_remision, lactancia_materna, lactancia_artificial, ablactacion, alimentacion_actual, created_at)
                        VALUES (:id_paciente, :id_expediente, :id_remision, :checkboxMaterna, :checkboxArtificial, :ablactacion, :alimentacion_actual, now());
                    ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "checkboxMaterna" => $checkboxMaterna, "checkboxArtificial" => $checkboxArtificial,
                        "ablactacion" => $ablactacion, "alimentacion_actual" => $alimentacion_actual]);
                    //finaliza lactancia
                //}
                DB::select("
                    INSERT INTO public.tbl_ped_lactancia_alimentacion_actual(
                    id_paciente, id_expediente, id_remision, alimentacion_actual, created_at)
                    VALUES (:id_paciente, :id_expediente, :id_remision, :alimentacion_actual, now());
                ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "alimentacion_actual" => $alimentacion_actual]);
                //inicia examen fisico, diagnostico, indicaciones
                DB::select("
                    INSERT INTO public.tbl_ped_exa_fisico_diagnostico_indicaciones(
                    id_paciente, id_expediente, id_remision, examen_fisico, diagnostico, indicaciones, created_at)
                    VALUES (:id_paciente, :id_expediente, :id_remision, :examen_fisico, :diagnostico, :indicaciones, now()); 
                ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "examen_fisico" => $examen_fisico,
                    "diagnostico" => $diagnostico, "diagnostico" => $diagnostico, "indicaciones" => $indicaciones]);
                //finaliza examen fisico, diagnostico, indicaciones
                DB::select("
                    insert into tbl_receta_medica 
                    (id_paciente, id_expediente, id_remision, id_medico, fecha_elaborada, descripcion_receta, created_at) values
                    (:id_paciente, :id_expediente, :id_remision, :id_medico, now(), :descripcion_receta, now())        
                ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "id_medico" => $id_medico, "descripcion_receta" => $receta]);
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
                DB::select("
                    update tbl_signos_vitales set
                    temperatura = :temperatura, presion_arterial = :presion_arterial, peso = :peso, talla = :talla, 
                    saturacion = :saturacion, frecuencia_cardiaca = :frecuencia_cardiaca, frecuencia_respiratoria = :frecuencia_respiratoria, 
                    glucometria = :glucometria, updated_at = now()
                    where deleted_at is null and
                    id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
                    "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
                    "glucometria" => $glucometria]);
                //finaliza signos vitales
                DB::select("
                    UPDATE public.tbl_exp_pediatrico_hea_mc
                    SET motivo_consulta=:motivo_consulta, historia_enfermedad_actual=:historia_enfermedad_actual, updated_at = now()
                    where deleted_at is null and
                    id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual]);
                //if($estado_edicion_subsiguiente == 1){
                    //inicia consulta
                        DB::select("
                        UPDATE public.tbl_exp_pediatrico SET 
                        motivo_consulta= :motivo_consulta, historia_enfermedad_actual= :historia_enfermedad_actual, antecedentes_personales_patologicos= :antecedentes_personales_patologicos, 
                        tratamiento_antecedentes_personales_patologicos= :tratamiento_antecedentes_personales_patologicos, antecedentes_familiares_patologicos= :antecedentes_familiares_patologicos, 
                        antecedentes_hospitalarios_quirurgicos= :antecedentes_hospitalarios_quirurgicos, inmunizacion= :inmunizacion, tipo_alergia= :tipo_alergia, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "motivo_consulta" => $motivo_consulta, "historia_enfermedad_actual" => $historia_enfermedad_actual, 
                        "antecedentes_personales_patologicos" => $antecedentes_personales_patologicos, "tratamiento_antecedentes_personales_patologicos" => $tratamientos,
                        "antecedentes_familiares_patologicos" => $afp, "antecedentes_hospitalarios_quirurgicos" => $antecedentes_hospitalarios_quirurgicos, 
                        "inmunizacion" => $inmunizacion, "tipo_alergia" => $alergias]);
                    //finaliza consulta
                    //inicia antecedentes prenatales
                        DB::select("
                        UPDATE public.tbl_ped_antecendentes_prenatales SET 
                        nombre_madre= :nombre_madre, edad= :edad, id_tipo_sangre= :id_tipo_sangre, enfermedades_durante_embarazo= :enfermedades_durante_embarazo,
                        gestas= :gestas, partos= :partos, cesarias= :cesarias, control_prenatal_ultimo_embarazo= :control_prenatal_ultimo_embarazo, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                        "nombre_madre" => $nombre_madre, "edad" => $edad_madre, "id_tipo_sangre" => $tipo_sangre,
                        "enfermedades_durante_embarazo" => $enfer_durante_embarazo, "gestas" => $numero_gestas_previas, 
                        "partos" => $numero_partos, "cesarias" => $numero_cesareas , "control_prenatal_ultimo_embarazo" => $numero_control_prenatal_utlimo_parto]);
                    //finaliza antecedentes prenatales
                    //inicia natalicio
                        DB::select("
                        UPDATE public.tbl_ped_natalicio SET
                        lugar_nacimiento= :lugar_nacimiento, apgar= :apgar, peso= :peso, talla= :talla, perimetro_cefalico= :perimetro_cefalico, 
                        id_tipo_parto= :id_tipo_parto, complicaciones_parto= :complicaciones_parto, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                        "lugar_nacimiento" => $nace_en, "apgar" => $apgar, "peso" => $peso_natalicio,
                        "talla" => $talla_natalicio, "perimetro_cefalico" => $perimetro_cefalico, 
                        "id_tipo_parto" => $tipo_parto, "complicaciones_parto" => $complicaciones_parto]);
                    //finaliza natalicio
                    //inicia desarrollo psicomotor
                        DB::select("
                        UPDATE public.tbl_ped_desarrollo_psicomotor SET
                        sonrio= :sonrio, sostuvo_cabeza= :sostuvo_cabeza, se_sento= :se_sento, se_paro= :se_paro, comino_solo= :comino_solo, habla= :habla, 
                        control_esfinteres= :control_esfinteres, escolaridad_actual= :escolaridad_actual, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                        "sonrio" => $checkboxSonrio, "sostuvo_cabeza" => $checkboxSostuvoCabeza, "se_sento" => $checkboxSeSento,
                        "se_paro" => $checkboxSeParo, "comino_solo" => $checkboxCaminoSolo, 
                        "habla" => $checkboxHabla, "control_esfinteres" => $checkboxControlEsfinteres, "escolaridad_actual" => $escolaridad_actual]);
                    //finaliza desarrollo psicomotor
                    //inicia desarrollo lactancia
                        DB::select("
                        UPDATE public.tbl_ped_lactancia SET
                        lactancia_materna= :lactancia_materna, lactancia_artificial= :lactancia_artificial, 
                        ablactacion= :ablactacion, alimentacion_actual= :alimentacion_actual, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                        "lactancia_materna" => $checkboxMaterna, "lactancia_artificial" => $checkboxArtificial,
                        "ablactacion" => $ablactacion, "alimentacion_actual" => $alimentacion_actual]);
                    //finaliza desarrollo lactancia
                    //inicia desarrollo lactancia
                        DB::select("
                        UPDATE public.tbl_ped_exa_fisico_diagnostico_indicaciones SET
                        examen_fisico=:examen_fisico, diagnostico=:diagnostico, indicaciones=:indicaciones, updated_at = now()
                        where deleted_at is null and
                        id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                    ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                        "examen_fisico" => $examen_fisico, "diagnostico" => $diagnostico, "indicaciones" => $indicaciones]);
                    //finaliza desarrollo lactancia
                //}
                DB::select("
                    UPDATE public.tbl_ped_lactancia_alimentacion_actual
                    SET alimentacion_actual=:alimentacion_actual, updated_at = now()
                    where deleted_at is null and
                    id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "alimentacion_actual" => $alimentacion_actual]);
                //inicia receta
                DB::select("
                    UPDATE public.tbl_receta_medica SET
                    descripcion_receta= :descripcion_receta, updated_at = now()
                    where deleted_at is null and
                    id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                    "descripcion_receta" => $receta]);
                //finaliza receta

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
