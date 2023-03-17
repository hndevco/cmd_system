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

class ExpGinecologicoController extends Controller
{
    public function ver_expediente_ginecologico($id_remision, $id_paciente){
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
            to_char(current_timestamp, 'HH12:MI AM') hora
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

        $tipos_sangre = DB::select("
            select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
        ");

        $indice_masa_corporal = DB::select("
            select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
        ");

        $sub_siguiente = collect(\DB::select("
            select count(*) existe from tbl_exp_ginecologia where id_paciente = :id_paciente and deleted_at is null
        ", ["id_paciente" => $id_paciente]))->first();

        $exp_ginecologia = collect(\DB::select("
        with temp as (
            select id from reg_ficha_pacientes where id = :id_paciente
            )
            SELECT g.gestas, g.partos, g.cesareas, g.abortos, g.hijos_vivos, g.hijos_muertos, g.fecha_parto, g.atendido, 
            g.fecha_ultima_mestruacion, g.fecha_provable_parto, g.citologia, g.descripcion_planificacion_familiar, 
            g.id_tipo_sangre, g.descripcion_vaginosis, g.descripcion_infeccion_tracto_urinario, g.descripcion_prurito, 
            g.descripcion_menarquia, g.edad_inicio_vida_sexual, g.numero_parejas_sexuales, g.tipo_enfermedades_trasmision_sexual, 
            g.vida_sexual_activa, g.tipo_antecendestes_personales_patologicos, g.afp, g.tipo_antecedentes_inmunoalergicos, g.habitos, 
            g.tipos_antecedentes_hospitalarios_quirurgicos, g.motivo_cosulta, g.motivo_cosulta_semanas_gestionales, 
            g.motivo_cosulta_examenes, g.nota_motivo_cosulta, g.historia_enfermedad_actual, g.fum_desconoce
            FROM public.tbl_exp_ginecologia g
            right join temp t on g.id_paciente = t.id
            and g.id in (select max(id) from tbl_exp_ginecologia where deleted_at is null and id_paciente = :id_paciente)
        ", ["id_paciente" => $id_paciente]))->first();

        return view('exp_ginecologico')->with("paciente" , $paciente)->with("medico", $medico)->with("tipos_sangre", $tipos_sangre)->with("indice_masa_corporal", $indice_masa_corporal)
        ->with("id_remision", $id_remision)
        ->with("exp_ginecologia", $exp_ginecologia)
        ->with("sub_siguiente", $sub_siguiente);
    }

    public function guardar_expediente_ginecologico(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $id_paciente = $request->id_paciente;
        $id_medico = null;
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
        $indice_masa_corporal = $request->indice_masa_corporal;
        //finaliza sigons vitales
        //inicia antecedentes gineco-obtetricos
        $gestas = $request->gestas;
        $partos = $request->partos;
        $cesareas = $request->cesareas;
        $abortos = $request->abortos;
        $hijos_vivos = $request->hijos_vivos;
        $hijos_muertos = $request->hijos_muertos;
        $fecha_ultimo_parto = $request->fecha_ultimo_parto;
        $atendido = $request->atendido;
        $fecha_ultima_menstruacion = $request->fecha_ultima_menstruacion;
        $fum_desconoce = $request->fum_desconoce;
        $fpp = $request->fpp;
        $citologia = $request->citologia;
        $planificacion_familiar = $request->planificacion_familiar;
        $tipo_sangre = $request->tipo_sangre;
        $vaginosis = $request->vaginosis;
        $infeccion_tracto_urinario = $request->infeccion_tracto_urinario;
        $prurito = $request->prurito;
        $menarquia = $request->menarquia;
        $inicio_vida_sexual = $request->inicio_vida_sexual;
        $numero_parejas_sexuales = $request->numero_parejas_sexuales;
        $enfermedad_transmision_sexual = $request->enfermedad_transmision_sexual;
        $vida_sexual_activa = $request->vida_sexual_activa;
        $antecedentes_personales_patologicos = $request->antecedentes_personales_patologicos;
        $afp = $request->afp;
        $antecedentes_inmunoalergicos = $request->antecedentes_inmunoalergicos;
        $habitos = $request->habitos;
        $antecedentes_hospitalarios_quirurgicos = $request->antecedentes_hospitalarios_quirurgicos;
        $mc_ginecologia = $request->mc_ginecologica;
        $mc_semanas_gestacionales = $request->mc_semanas_gestacionales;
        $mc_examenes = $request->mc_examenes;
        $mc_notas = $request->mc_notas;
        $historia_enfermedad_actual = $request->historia_enfermedad_actual;
        //finaliza antecedentes gineco-obtetricos
        //inicia examen fisico
        $otorrinolaringologia = $request->otorrinolaringologia;
        $cardio_pulmonar = $request->cardio_pulmonar;
        $abdomen = $request->abdomen;
        $ginecologico = $request->ginecologico;
        $especulo = $request->especulo;
        $trans_vaginal = $request->trans_vaginal;
        $ultrasonido = $request->ultrasonido;
        $diagnosticos = $request->diagnosticos;
        $plan = $request->plan;
        $proxima_cita = $request->proxima_cita;
        //finaliza examen fisico 
        $receta = $request->receta;

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
        if($accion == 1){
            //inicia insert signos vitales
            DB::select("
                insert into tbl_signos_vitales 
                (id_paciente, id_expediente, id_remision, temperatura, presion_arterial, peso, talla, saturacion, 
                frecuencia_cardiaca, frecuencia_respiratoria, id_masa_corporal, glucometria, created_at) values 
                (:id_paciente, :id_expediente, :id_remision, :temperatura, :presion_arterial, :peso, :talla, :saturacion, :frecuencia_cardiaca, 
                    :frecuencia_respiratoria, :indice_masa_corporal, :glucometria, now())
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
                "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
                "indice_masa_corporal" => $indice_masa_corporal, "glucometria" => $glucometria]);
            //finaliza insert signos vitales
            DB::select("
            INSERT INTO public.tbl_exp_ginecologia_mc_hea(
            id_paciente, id_expediente, id_remision, 
            motivo_cosulta, motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual, created_at)
            VALUES (:id_paciente, :id_expediente, :id_remision, :mc_ginecologia, :mc_semanas_gestacionales, :mc_examenes, :mc_notas, :historia_enfermedad_actual, now())
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision,
                "mc_ginecologia" => $mc_ginecologia, "mc_semanas_gestacionales" => $mc_semanas_gestacionales, "mc_examenes" => $mc_examenes, "mc_notas" => $mc_notas, "historia_enfermedad_actual" => $historia_enfermedad_actual]);
            //inicia insert antecedentes gineco-obtetricos
            //if($sub_siguiente == 0){
                DB::select("
                INSERT INTO public.tbl_exp_ginecologia(
                    id_paciente, id_expediente, id_remision, gestas, partos, cesareas, abortos, hijos_vivos, hijos_muertos, fecha_parto, atendido, fecha_ultima_mestruacion, fum_desconoce, fecha_provable_parto, 
                    citologia, descripcion_planificacion_familiar, id_tipo_sangre, descripcion_vaginosis, descripcion_infeccion_tracto_urinario, descripcion_prurito, descripcion_menarquia, 
                    edad_inicio_vida_sexual, numero_parejas_sexuales, tipo_enfermedades_trasmision_sexual, vida_sexual_activa, tipo_antecendestes_personales_patologicos, afp, tipo_antecedentes_inmunoalergicos, 
                    habitos, tipos_antecedentes_hospitalarios_quirurgicos, motivo_cosulta, motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual, created_at) values 
                    (:id_paciente, :id_expediente, :id_remision, :gestas, :partos, :cesareas, :abortos, :hijos_vivos, :hijos_muertos, :fecha_ultimo_parto, :atendido, :fecha_ultima_menstruacion, :fum_desconoce, :fpp, 
                    :citologia, :planificacion_familiar, :tipo_sangre, :vaginosis, :infeccion_tracto_urinario, :prurito, :menarquia, :inicio_vida_sexual, :numero_parejas_sexuales, 
                    :enfermedad_transmision_sexual, :vida_sexual_activa, :antecedentes_personales_patologicos, :afp, :antecedentes_inmunoalergicos, :habitos, :antecedentes_hospitalarios_quirurgicos, 
                    :mc_ginecologia, :mc_semanas_gestacionales, :mc_examenes, :mc_notas, :historia_enfermedad_actual, now())
                ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "gestas" => $gestas, "partos" => $partos, "cesareas" => $cesareas, "abortos" => $abortos, "hijos_vivos" => $hijos_vivos,
                    "hijos_muertos" => $hijos_muertos, "fecha_ultimo_parto" => $fecha_ultimo_parto, "atendido" => $atendido, "fecha_ultima_menstruacion" => $fecha_ultima_menstruacion, "fum_desconoce"=>$fum_desconoce, "fpp" => $fpp, 
                    "citologia" => $citologia, "planificacion_familiar" => $planificacion_familiar, "tipo_sangre" => $tipo_sangre, "vaginosis" => $vaginosis, "infeccion_tracto_urinario" => $infeccion_tracto_urinario,
                    "prurito" => $prurito, "menarquia" => $menarquia, "inicio_vida_sexual" => $inicio_vida_sexual, "numero_parejas_sexuales" => $numero_parejas_sexuales, 
                    "enfermedad_transmision_sexual" => $enfermedad_transmision_sexual, "vida_sexual_activa" => $vida_sexual_activa, "antecedentes_personales_patologicos" => $antecedentes_personales_patologicos,
                    "afp" => $afp, "antecedentes_inmunoalergicos" => $antecedentes_inmunoalergicos, "habitos" => $habitos, "antecedentes_hospitalarios_quirurgicos" => $antecedentes_hospitalarios_quirurgicos,
                    "mc_ginecologia" => $mc_ginecologia, "mc_semanas_gestacionales" => $mc_semanas_gestacionales, "mc_examenes" => $mc_examenes, "mc_notas" => $mc_notas, "historia_enfermedad_actual" => $historia_enfermedad_actual]);
                //finaliza insert antecedentes gineco-obtetricos
            //}
            //inicia insert examen fisico
            DB::select("
                insert into tbl_gin_examen_fisico
                (id_paciente, id_expediente, id_remision, otorrinolaringologia, cardiopulmonar, abdomen, ginecologico, especulo, trans_vaginal,
                ultrasonido, diagnosticos, plan, proxima_cita, created_at) values 
                (:id_paciente, :id_expediente, :id_remision, :otorrinolaringologia, :cardio_pulmonar, :abdomen, :ginecologico, :especulo, :trans_vaginal,
                :ultrasonido, :diagnosticos, :plan, :proxima_cita, now())
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "otorrinolaringologia" => $otorrinolaringologia, "cardio_pulmonar" => $cardio_pulmonar,
                "abdomen" => $abdomen, "ginecologico" => $ginecologico, "especulo" => $especulo, "trans_vaginal" => $trans_vaginal, "ultrasonido" => $ultrasonido,
                "diagnosticos" => $diagnosticos, "plan" => $plan, "proxima_cita" => $proxima_cita,]);
            //finaliza insert examen fisico
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
                id_masa_corporal = :indice_masa_corporal, temperatura = :temperatura, presion_arterial = :presion_arterial, peso = :peso, talla = :talla, 
                saturacion = :saturacion, frecuencia_cardiaca = :frecuencia_cardiaca, frecuencia_respiratoria = :frecuencia_respiratoria, 
                glucometria = :glucometria, updated_at = now()
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "indice_masa_corporal" => $indice_masa_corporal, "temperatura" => $temperatura, "presion_arterial" => $presion_arterial, "peso" => $peso,
                "talla" => $talla, "saturacion" => $saturacion, "frecuencia_cardiaca" => $frecuencia_cardiaca, "frecuencia_respiratoria" => $frecuencia_respiratoria,
                "glucometria" => $glucometria]);
            //finaliza signos vitales
            DB::select("
                UPDATE public.tbl_exp_ginecologia_mc_hea
                SET motivo_cosulta=:mc_ginecologia, motivo_cosulta_semanas_gestionales=:mc_semanas_gestacionales, motivo_cosulta_examenes=:mc_examenes, 
                nota_motivo_cosulta=:mc_notas, historia_enfermedad_actual=:historia_enfermedad_actual, updated_at = now()
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision,
                "mc_ginecologia" => $mc_ginecologia, "mc_semanas_gestacionales" => $mc_semanas_gestacionales,
                "mc_examenes" => $mc_examenes, "mc_notas" => $mc_notas, "historia_enfermedad_actual" => $historia_enfermedad_actual]);
            //inicia exp_ginecologia
            //if($estado_edicion_subsiguiente == 1){
                DB::select("
                    UPDATE public.tbl_exp_ginecologia
                    SET gestas=:gestas, partos=:partos, cesareas=:cesareas, abortos=:abortos, hijos_vivos=:hijos_vivos, hijos_muertos=:hijos_muertos, fecha_parto=:fecha_ultimo_parto, atendido=:atendido, 
                    fecha_ultima_mestruacion=:fecha_ultima_menstruacion, fecha_provable_parto=:fpp, citologia=:citologia, descripcion_planificacion_familiar=:planificacion_familiar, id_tipo_sangre=:tipo_sangre, 
                    descripcion_vaginosis=:vaginosis, descripcion_infeccion_tracto_urinario=:infeccion_tracto_urinario, descripcion_prurito=:prurito, descripcion_menarquia=:menarquia, 
                    edad_inicio_vida_sexual=:inicio_vida_sexual, numero_parejas_sexuales=:numero_parejas_sexuales, tipo_enfermedades_trasmision_sexual=:enfermedad_transmision_sexual, vida_sexual_activa=:vida_sexual_activa, 
                    tipo_antecendestes_personales_patologicos=:antecedentes_personales_patologicos, afp=:afp, tipo_antecedentes_inmunoalergicos=:antecedentes_inmunoalergicos, habitos=:habitos, 
                    tipos_antecedentes_hospitalarios_quirurgicos=:antecedentes_hospitalarios_quirurgicos, motivo_cosulta=:mc_ginecologia, motivo_cosulta_semanas_gestionales=:mc_semanas_gestacionales, motivo_cosulta_examenes=:mc_examenes, 
                    nota_motivo_cosulta=:mc_notas, historia_enfermedad_actual=:historia_enfermedad_actual, fum_desconoce=:fum_desconoce, updated_at = now()
                    where deleted_at is null and
                    id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "gestas" => $gestas, "partos" => $partos, "cesareas" => $cesareas, "abortos" => $abortos,
                    "hijos_vivos" => $hijos_vivos, "hijos_muertos" => $hijos_muertos, "fecha_ultimo_parto" => $fecha_ultimo_parto, "atendido" => $atendido, "fecha_ultima_menstruacion" => $fecha_ultima_menstruacion,
                    "fpp" => $fpp, "citologia" => $citologia, "planificacion_familiar" => $planificacion_familiar, "tipo_sangre" => $tipo_sangre, "vaginosis" => $vaginosis, "infeccion_tracto_urinario" => $infeccion_tracto_urinario,
                    "prurito" => $prurito, "menarquia" => $menarquia, "inicio_vida_sexual" => $inicio_vida_sexual, "numero_parejas_sexuales" => $numero_parejas_sexuales, "enfermedad_transmision_sexual" => $enfermedad_transmision_sexual,
                    "vida_sexual_activa" => $vida_sexual_activa, "antecedentes_personales_patologicos" => $antecedentes_personales_patologicos, "afp" => $afp, "antecedentes_inmunoalergicos" => $antecedentes_inmunoalergicos, 
                    "habitos" => $habitos, "antecedentes_hospitalarios_quirurgicos" => $antecedentes_hospitalarios_quirurgicos, "mc_ginecologia" => $mc_ginecologia, "mc_semanas_gestacionales" => $mc_semanas_gestacionales,
                    "mc_examenes" => $mc_examenes, "mc_notas" => $mc_notas, "historia_enfermedad_actual" => $historia_enfermedad_actual,
                    "fum_desconoce" => $fum_desconoce]);
                //finaliza exp_ginecologia
            //}
            //inicia examen fisico
            DB::select("
                UPDATE public.tbl_gin_examen_fisico
                SET otorrinolaringologia=:otorrinolaringologia, cardiopulmonar=:cardio_pulmonar, abdomen=:abdomen, ginecologico=:ginecologico, especulo=:especulo, trans_vaginal=:trans_vaginal, 
                ultrasonido=:ultrasonido, diagnosticos=:diagnosticos, plan=:plan, proxima_cita=:proxima_cita, updated_at = now()
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, "otorrinolaringologia" => $otorrinolaringologia, "cardio_pulmonar" => $cardio_pulmonar, 
                "abdomen" => $abdomen, "ginecologico" => $ginecologico, "especulo" => $especulo, "trans_vaginal" => $trans_vaginal, "ultrasonido" => $ultrasonido, "diagnosticos" => $diagnosticos, "plan" => $plan,
                "proxima_cita" => $proxima_cita]);
            //finaliza examen fisico
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
