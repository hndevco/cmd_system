<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper; 
use DB;
use Session;

class ReportesController extends Controller
{
    
    public function ver_reporte_hola_mundo(){

        $input = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';
        $inputCompiled = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world.jasper';
        $output = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_'.date("Ymd")."_".date("his");

        if (!file_exists( $inputCompiled)) {
            $jasper = new PHPJasper;
            $jasper->compile($input)->execute();
        }

        $options = [
            'format' => ['pdf']
        ];

        $jasper = new PHPJasper;
    
        $jasper->process(
            $inputCompiled,
            $output,
            $options
        )->execute();
    
        //$pathToFile = base_path() .
        //'/vendor/geekcom/phpjasper/examples/hello_world.pdf';

        return response()->file($output.'.pdf');

        //return response()->download( $output.'.pdf' );  

    }

    public function ver_reporte_hola_mundo_parametros() {
        $input = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.jrxml';
        $inputCompiled = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.jasper';
        $output = base_path() .
        '/vendor/geekcom/phpjasper/examples';
        $options = [
            'format' => ['pdf'],
            'params' => [
                'myInt' => 7,
                'myDate' => date('y-m-d'),
                'myImage' => base_path() .
                '/vendor/geekcom/phpjasper/examples/jasperreports_logo.png',
                'myString' => 'Hola Mundo!'
            ]
        ];
    
        $jasper = new PHPJasper;
    
        $jasper->process(
            $inputCompiled,
            $output,
            $options
        )->execute();
    
        $pathToFile = base_path() .
        '/vendor/geekcom/phpjasper/examples/hello_world_params.pdf';
        return response()->file($pathToFile);
    }

    public function ver_reporte_word() {
        
        $file = public_path('/documentos/reportes/ReporteNombre.docx');
		
        try {
            
            $template = new \PhpOffice\PhpWord\TemplateProcessor( $file ); 
            $template->setValue( 'name', 'Cristan');
            $template->setValue( 'lastname', 'Laurek');
            $template->setValue( 'age', '38');
            
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);
            
            $headers = [
                "Content-Type: application/octet-stream",
            ];
            
            return response()->download($tempFile, 'documento.docx', $headers)->deleteFileAfterSend(true);
            
       } catch (Exception $ex) {
            
        }
        
    }
    
    public function ejecutar_reportes( $id_paciente, $id_remision, $id_expediente ){
        
        
        if($id_expediente == 2){
            //Inicia Expediente pediátrico
            
        }else if($id_expediente == 3){
            //Inicia Medicina General
            
        }else if($id_expediente == 1){
            //Inicia Expediente ginecológico
            
        }
        
    }
    
    public function ver_reporte_pediatrico($id_paciente, $id_remision, $id_expediente) {
        
        $file = public_path('/documentos/reportes/Reporte_pediatrico.docx');
        $nombre_paciente = null;
        
        try {
            
        
        
        $estado_edicion_subsiguiente = collect(\DB::select("
                SELECT
                case 
                when (now() - p.created_at) <= '24 hour' and r.id = p.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_pediatrico p on r.id = p.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();
            

            $paciente = collect(\DB::select("
            select 
            rfp.id,
             concat(rfp.primer_nombre,' ',rfp.segundo_nombre,' ',rfp.primer_apellido,' ',rfp.segundo_apellido) nombre,
             case 
                 when 
                     date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)) >1 
                 then 
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' años') 
                 else
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' año') 
             end edad,
             case 
                 when 
                     rfp.sexo = 'M' 
                 then 
                     'Masculino'
                 else 
                     'Femenino'
                 end sexo, 
             rfp.domicilio, rfp.telefono, rfp.identidad, 
             to_char(r.created_at,'TMDay')||', '||to_char( r.created_at ,'dd')||' de '||to_char(r.created_at,'TMMonth')||' de '||to_char(r.created_at,'yyyy') fecha,
             to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
             from reg_ficha_pacientes rfp 
             join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
             where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();
            
            $tipos_sangre = DB::select("
                select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
            ");

            $indice_masa_corporal = DB::select("
                select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
            ");

            $tipos_partos = DB::select("
                select id, nombre from tbl_tipos_partos where deleted_at is null order by nombre
            ");

            $sub_siguiente = collect(\DB::select("
                select count(*) existe from tbl_exp_pediatrico where id_paciente = :id_paciente and deleted_at is null
            ", ["id_paciente" => $id_paciente]))->first();

            $signos_vitales = collect(\DB::select("
                select temperatura, presion_arterial, peso, talla, saturacion, frecuencia_cardiaca, frecuencia_respiratoria, glucometria 
                from tbl_signos_vitales
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $consulta_exp_pediatrico_hea_mc= collect(\DB::select("
                select motivo_consulta from public.tbl_exp_pediatrico_hea_mc
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
            //inicia sub siguiente
            $consulta_exp_pediatrico = collect(\DB::select("
                select motivo_consulta, historia_enfermedad_actual, antecedentes_personales_patologicos, 
                tratamiento_antecedentes_personales_patologicos, antecedentes_familiares_patologicos, antecedentes_hospitalarios_quirurgicos, 
                inmunizacion, tipo_alergia
                from tbl_exp_pediatrico
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $antecendentes_prenatales = collect(\DB::select("
                select ap.id_paciente, ap.id_expediente, ap.id_remision, ap.nombre_madre, ap.edad, ap.id_tipo_sangre, ts.nombre tipo_sangre, ap.enfermedades_durante_embarazo, 
                ap.gestas, ap.partos, ap.cesarias, ap.control_prenatal_ultimo_embarazo
                from tbl_ped_antecendentes_prenatales ap
                join tbl_tipos_sangre ts on ap.id_tipo_sangre = ts.id
                where ap.deleted_at is null
                and ap.id_paciente = :id_paciente and ap.id_expediente = :id_expediente and ap.id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $natalicio = collect(\DB::select("
                select pn.id_paciente, pn.id_expediente, pn.id_remision, pn.lugar_nacimiento, pn.apgar, 
                pn.peso, pn.talla, pn.perimetro_cefalico, pn.id_tipo_parto, tp.nombre tipo_parto, pn.complicaciones_parto
                from public.tbl_ped_natalicio pn 
                join tbl_tipos_partos tp on tp.id = pn.id_tipo_parto
                where pn.deleted_at is null and
                pn.id_paciente = :id_paciente and pn.id_expediente = :id_expediente and pn.id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $desarrollo_psicomotor = collect(\DB::select("
                select id_paciente, id_expediente, id_remision, sonrio, sostuvo_cabeza, se_sento, se_paro, comino_solo,
                habla, control_esfinteres, escolaridad_actual
                from public.tbl_ped_desarrollo_psicomotor
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $lactancia = collect(\DB::select("
                select id_paciente, id_expediente, id_remision, lactancia_materna, lactancia_artificial,
                ablactacion, alimentacion_actual
                from public.tbl_ped_lactancia
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
            //finaliza sub siguiente
            // $lactancia_alimentacion_actual = collect(\DB::select("
            //     select alimentacion_actual from public.tbl_ped_lactancia_alimentacion_actual
            //     where deleted_at is null and
            //     id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            // ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $exa_fisico_diagnostico_indicaciones = collect(\DB::select("
                select id_paciente, id_expediente, id_remision, examen_fisico, diagnostico, indicaciones
                from public.tbl_ped_exa_fisico_diagnostico_indicaciones
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $receta = collect(\DB::select("
                select rm.id_paciente, rm.id_expediente, rm.id_remision,
                TRIM(
                COALESCE(TRIM(pe.primer_nombre)||' ','')||
                    COALESCE(TRIM(pe.primer_apellido||' '),'')
                ) nombre, telefono celular,
                rm.descripcion_receta, c.nombre cargo
                from users u
                join per_empleado pe on u.id = pe.id_usuario
                join tbl_receta_medica rm on rm.id_medico = pe.id
                join tbl_cargos c on pe.id_cargo = c.id
                where  pe.deleted_at is null and 
                rm.id_paciente = :id_paciente and rm.id_expediente = :id_expediente and rm.id_remision = :id_remision
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
        
           $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            
            
                
                $nombre_paciente = $paciente->nombre;
                
                $template->setValue( 'nombre_paciente', $paciente->nombre);
                $template->setValue( 'age', $paciente->edad);
                $template->setValue( 'sexo', $paciente->sexo);
                $template->setValue( 'direccion', $paciente->domicilio);
                $template->setValue( 'telefono_paciente', $paciente->telefono);
                $template->setValue( 'identidad', $paciente->identidad);
                $template->setValue( 'fecha_atencion', $paciente->fecha);
                $template->setValue( 'hora_atencion', $paciente->hora);
                $template->setValue( 'medico', $paciente->medico);
                $template->setValue( 'temperatura', $signos_vitales->temperatura);
                $template->setValue( 'presion_arterial', $signos_vitales->presion_arterial);
                $template->setValue( 'peso', $signos_vitales->peso);
                $template->setValue( 'talla', $signos_vitales->talla);
                $template->setValue( 'sat', $signos_vitales->saturacion);
                $template->setValue( 'fc', $signos_vitales->frecuencia_cardiaca);
                $template->setValue( 'fr', $signos_vitales->frecuencia_respiratoria);
                $template->setValue( 'gmt', $signos_vitales->glucometria);                 
                $template->setValue( 'motivo_consulta', $consulta_exp_pediatrico->motivo_consulta);
                $template->setValue( 'historia_enfermedad_actual', $consulta_exp_pediatrico->historia_enfermedad_actual);
                $template->setValue( 'app', ($consulta_exp_pediatrico->antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->antecedentes_personales_patologicos == '') ? 'No' : 'Si'  );
                $template->setValue( 'app_descripcion', $consulta_exp_pediatrico->antecedentes_personales_patologicos);                
                $template->setValue( 'tx', ($consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == '') ? 'No' : 'Si' );
                $template->setValue( 'tx_descripcion', $consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos);
                $template->setValue( 'afp', ($consulta_exp_pediatrico->antecedentes_familiares_patologicos == null || $consulta_exp_pediatrico->antecedentes_familiares_patologicos == '') ? 'No' : 'Si');
                $template->setValue( 'afp_descripcion', $consulta_exp_pediatrico->antecedentes_familiares_patologicos);
                $template->setValue( 'ahtq', ($consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == null || $consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == '') ? 'No' : 'Si');               
                $template->setValue( 'ahtq_descripcion', $consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos);               
                $template->setValue( 'inmunizacion', $consulta_exp_pediatrico->inmunizacion);               
                $template->setValue( 'alergias', ($consulta_exp_pediatrico->tipo_alergia == null || $consulta_exp_pediatrico->tipo_alergia == '') ? 'No' : 'Si' );               
                $template->setValue( 'alergias_descripcion', $consulta_exp_pediatrico->tipo_alergia);               
                $template->setValue( 'nombre', $antecendentes_prenatales->nombre_madre);               
                $template->setValue( 'edad_ap', $antecendentes_prenatales->edad);               
                $template->setValue( 'tipo_sangre', $antecendentes_prenatales->tipo_sangre);               
                $template->setValue( 'ede', ($antecendentes_prenatales->enfermedades_durante_embarazo == null || $consulta_exp_pediatrico->tipo_alergia == '') ? 'No' : 'Si');               
                $template->setValue( 'ede_descripcion', $consulta_exp_pediatrico->tipo_alergia );               
                $template->setValue( 'gp', $antecendentes_prenatales->gestas);               
                $template->setValue( 'np', $antecendentes_prenatales->partos);               
                $template->setValue( 'nc', $antecendentes_prenatales->cesarias);               
                $template->setValue( 'cpn', $antecendentes_prenatales->control_prenatal_ultimo_embarazo);               
                $template->setValue( 'nace', $natalicio->lugar_nacimiento);               
                $template->setValue( 'apgar', $natalicio->apgar);               
                
                $template->setValue( 'peso', $natalicio->peso);               
                $template->setValue( 'talla_natal', $natalicio->talla);               
                $template->setValue( 'pc', $natalicio->perimetro_cefalico);               
                $template->setValue( 'tipo_parto', $natalicio->tipo_parto);               
                $template->setValue( 'complicaciones_parto', ($natalicio->complicaciones_parto == null || $natalicio->complicaciones_parto == '') ? 'No' : 'Si' );               
                $template->setValue( 'complicaciones_parto_descripcion', $natalicio->complicaciones_parto);               
                $template->setValue( 'sonrio', ($desarrollo_psicomotor->sonrio) ? '▣' : '□' );               
                $template->setValue( 'sostuvo_cabeza', ($desarrollo_psicomotor->sostuvo_cabeza) ? '▣' : '□');               
                $template->setValue( 'sento', ($desarrollo_psicomotor->se_sento) ? '▣' : '□');               
                $template->setValue( 'paro', ($desarrollo_psicomotor->se_paro)? '▣' : '□' );               
                $template->setValue( 'camino_solo', ($desarrollo_psicomotor->comino_solo)? '▣' : '□' );               
                $template->setValue( 'habla', ($desarrollo_psicomotor->habla )? '▣' : '□' );               
                $template->setValue( 'control_esfinter', ($desarrollo_psicomotor->control_esfinteres ) ? '▣' : '□');               
                $template->setValue( 'escolaridad', ($desarrollo_psicomotor->escolaridad_actual == null || $desarrollo_psicomotor->escolaridad_actual == '') ? 'No' : 'Si' );               
                $template->setValue( 'cual_escolaridad', $desarrollo_psicomotor->escolaridad_actual);               
                $template->setValue( 'lactancia', ($lactancia->ablactacion == null || $lactancia->ablactacion == '') ? 'No' : 'Si' );               
                $template->setValue( 'materna', ($lactancia->lactancia_materna == true && $lactancia->lactancia_artificial == false) ? '◉' : '○');               
                $template->setValue( 'artificial', ($lactancia->lactancia_materna == false && $lactancia->lactancia_artificial == true) ? '◉' : '○');               
                $template->setValue( 'mixta', ($lactancia->lactancia_materna == true && $lactancia->lactancia_artificial == true) ? '◉' : '○');               
                $template->setValue( 'dpc', $lactancia->ablactacion);               
                $template->setValue( 'daa', $lactancia->alimentacion_actual);               
                $template->setValue( 'examen_fisico', $exa_fisico_diagnostico_indicaciones->examen_fisico );               
                $template->setValue( 'diagnostico', $exa_fisico_diagnostico_indicaciones->diagnostico);               
                $template->setValue( 'indicaciones', $exa_fisico_diagnostico_indicaciones->indicaciones);               
            
            
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);
            
            $headers = [
                "Content-Type: application/octet-stream",
            ];
            
            return response()->download($tempFile, 'Reporte Pediatría '.$nombre_paciente.' '. date("Y-m-d").' .docx', $headers)->deleteFileAfterSend(true);
            
        } catch (Exception $ex) {
            
        }
        
    }
    
    public function ver_reporte_ginecologico($id_paciente, $id_remision, $id_expediente) {
        
        $file = public_path('/documentos/reportes/Reporte_ginecologico.docx');
        $nombre_paciente = null;
        
        try {
            $estado_edicion_subsiguiente = collect(\DB::select("
                SELECT
                case 
                when (now() - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_ginecologia g on r.id = g.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            
            $paciente = collect(\DB::select("
            select 
            rfp.id,
             concat(rfp.primer_nombre,' ',rfp.segundo_nombre,' ',rfp.primer_apellido,' ',rfp.segundo_apellido) nombre,
             case 
                 when 
                     date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)) >1 
                 then 
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' años') 
                 else
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' año') 
             end edad,
             case 
                 when 
                     rfp.sexo = 'M' 
                 then 
                     'Masculino'
                 else 
                     'Femenino'
                 end sexo, 
             rfp.domicilio, rfp.telefono, rfp.identidad, 
             to_char(r.created_at,'TMDay')||', '||to_char( r.created_at ,'dd')||' de '||to_char(r.created_at,'TMMonth')||' de '||to_char(r.created_at,'yyyy') fecha,
             to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
             from reg_ficha_pacientes rfp 
             join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
             where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            $tipos_sangre = DB::select("
                select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
            ");

            $indice_masa_corporal = DB::select("
                select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
            ");

            $sub_siguiente = collect(\DB::select("
                select count(*) existe from tbl_exp_ginecologia where id_paciente = :id_paciente and deleted_at is null
            ", ["id_paciente" => $id_paciente]))->first();

            $signos_vitales = collect(\DB::select("
                select sv.id_masa_corporal, im.descripcion_masa_corporal masa_corporal, sv.temperatura, sv.presion_arterial, sv.peso, sv.talla, sv.saturacion, sv.frecuencia_cardiaca, sv.frecuencia_respiratoria, sv.glucometria 
                from tbl_signos_vitales sv 
                join tbl_indice_masa_corporal im ON im.id = sv.id_masa_corporal
                where sv.id_paciente = :id_paciente and sv.id_expediente = :id_expediente and sv.id_remision = :id_remision and sv.deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $ginecologia_mc_hea = collect(\DB::select("
                SELECT motivo_cosulta, motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual
                FROM public.tbl_exp_ginecologia_mc_hea
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $ginecologia = collect(\DB::select("
                SELECT gestas, partos, cesareas, abortos, hijos_vivos, hijos_muertos, fecha_parto, atendido, fecha_ultima_mestruacion,  fum_desconoce,
case when ( fecha_ultima_mestruacion is null ) and (fum_desconoce is null ) then 'No Aplica'
when ( fecha_ultima_mestruacion is not null ) and (fum_desconoce is null ) then 'Si'
when ( fecha_ultima_mestruacion is null ) and (fum_desconoce is not null ) then 'Desconoce'
else '' end fum,
fecha_provable_parto, citologia, descripcion_planificacion_familiar, id_tipo_sangre , ts.nombre tipo_sangre, descripcion_vaginosis, 
descripcion_infeccion_tracto_urinario, descripcion_prurito, descripcion_menarquia, edad_inicio_vida_sexual, 
numero_parejas_sexuales, tipo_enfermedades_trasmision_sexual, vida_sexual_activa, tipo_antecendestes_personales_patologicos,
afp, tipo_antecedentes_inmunoalergicos, habitos, tipos_antecedentes_hospitalarios_quirurgicos, motivo_cosulta,
motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual
FROM public.tbl_exp_ginecologia eg
join public.tbl_tipos_sangre ts ON ts.id = eg.id_tipo_sangre
where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and eg.deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $examen_fisico = collect(\DB::select("
                SELECT otorrinolaringologia, cardiopulmonar, abdomen, ginecologico, especulo, trans_vaginal,
                ultrasonido, diagnosticos, plan, proxima_cita
                FROM public.tbl_gin_examen_fisico
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $receta = collect(\DB::select("
                select rm.id_paciente, rm.id_expediente, rm.id_remision,
                TRIM(
                COALESCE(TRIM(pe.primer_nombre)||' ','')||
                    COALESCE(TRIM(pe.primer_apellido||' '),'')
                ) nombre, telefono celular,
                rm.descripcion_receta, c.nombre cargo
                from users u
                join per_empleado pe on u.id = pe.id_usuario
                join tbl_receta_medica rm on rm.id_medico = pe.id
                join tbl_cargos c on pe.id_cargo = c.id
                where  pe.deleted_at is null and 
                rm.id_paciente = :id_paciente and rm.id_expediente = :id_expediente and rm.id_remision = :id_remision
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
            
            $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            
            
                
                $nombre_paciente = $paciente->nombre;
                
                $template->setValue( 'nombre_paciente', $paciente->nombre);
                $template->setValue( 'age', $paciente->edad);
                $template->setValue( 'sexo', $paciente->sexo);
                $template->setValue( 'direccion', $paciente->domicilio);
                $template->setValue( 'telefono_paciente', $paciente->telefono);
                $template->setValue( 'identidad', $paciente->identidad);
                $template->setValue( 'fecha_atencion', $paciente->fecha);
                $template->setValue( 'hora_atencion', $paciente->hora);
                $template->setValue( 'medico', $paciente->medico);
                $template->setValue( 'temperatura', $signos_vitales->temperatura);
                $template->setValue( 'presion_arterial', $signos_vitales->presion_arterial);
                $template->setValue( 'peso', $signos_vitales->peso);
                $template->setValue( 'talla', $signos_vitales->talla);
                $template->setValue( 'sat', $signos_vitales->saturacion);
                $template->setValue( 'fc', $signos_vitales->frecuencia_cardiaca);
                $template->setValue( 'fr', $signos_vitales->frecuencia_respiratoria);
                $template->setValue( 'gmt', $signos_vitales->glucometria);       
                $template->setValue( 'imc', $signos_vitales->masa_corporal);
                $template->setValue( 'gestas', $ginecologia->gestas);
                $template->setValue( 'partos', $ginecologia->partos);
                $template->setValue( 'cesarea', $ginecologia->cesareas);                
                $template->setValue( 'abortos', $ginecologia->abortos);
                $template->setValue( 'hv', $ginecologia->hijos_vivos);
                $template->setValue( 'hijos_muertos', $ginecologia->hijos_muertos);
                $template->setValue( 'fup', $ginecologia->fecha_parto);
                $template->setValue( 'atendido', $ginecologia->atendido);               
                $template->setValue( 'fum', $ginecologia->fum);               
                $template->setValue( 'fum_fecha', $ginecologia->fecha_ultima_mestruacion);               
                $template->setValue( 'fpp', ($ginecologia->fecha_provable_parto == null || $ginecologia->fecha_provable_parto == '') ? 'No Aplica' : 'Si' );               
                $template->setValue( 'fpp_fecha', $ginecologia->fecha_provable_parto);               
                $template->setValue( 'citologia', $ginecologia->citologia);               
                $template->setValue( 'pf', ($ginecologia->descripcion_planificacion_familiar == null || $ginecologia->descripcion_planificacion_familiar == '' ) ? 'No' : 'Si'  );               
                $template->setValue( 'pf_kg', $ginecologia->descripcion_planificacion_familiar);               
                $template->setValue( 'tipo_sangre', $ginecologia->tipo_sangre);               
                $template->setValue( 'vaginosis', ($ginecologia->descripcion_vaginosis == null || $ginecologia->descripcion_vaginosis == '') ? 'No' : 'Si' );               
                $template->setValue( 'vaginosis_kg', $ginecologia->descripcion_vaginosis);               
                $template->setValue( 'itu', ($ginecologia->descripcion_infeccion_tracto_urinario == null || $ginecologia->descripcion_infeccion_tracto_urinario == '')? 'No Aplica' : 'Si' );               
                $template->setValue( 'itu_kg', $ginecologia->descripcion_infeccion_tracto_urinario);               
                $template->setValue( 'prurito', ($ginecologia->descripcion_prurito == null || $ginecologia->descripcion_prurito == '') ? 'No' : 'Si'  );               
                $template->setValue( 'prurito_kg', $ginecologia->descripcion_prurito);               
                $template->setValue( 'menarquia', ($ginecologia->descripcion_menarquia == null || $ginecologia->descripcion_menarquia == '') ? 'No' : 'Si' );               
                $template->setValue( 'menarquia_kg', $ginecologia->descripcion_menarquia);               
                $template->setValue( 'ivs', ($ginecologia->edad_inicio_vida_sexual == null || $ginecologia->edad_inicio_vida_sexual == '')? 'No' : 'Si' );               
                $template->setValue( 'ivs_anios', $ginecologia->edad_inicio_vida_sexual);               
                $template->setValue( 'nps', $ginecologia->numero_parejas_sexuales);               
                $template->setValue( 'etsl', ($ginecologia->tipo_enfermedades_trasmision_sexual == null || $ginecologia->tipo_enfermedades_trasmision_sexual == ''));               
                $template->setValue( 'ets_diagnostico', $ginecologia->tipo_enfermedades_trasmision_sexual);               
                $template->setValue( 'vsa', $ginecologia->vida_sexual_activa);               
                $template->setValue( 'app', ($ginecologia->tipo_antecendestes_personales_patologicos == null || $ginecologia->tipo_antecendestes_personales_patologicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'app_anios', $ginecologia->tipo_antecendestes_personales_patologicos);               
                $template->setValue( 'afp', ($ginecologia->afp == null || $ginecologia->afp == '') ? 'No' : 'Si' );               
                $template->setValue( 'afp_anios', $ginecologia->afp);               
                $template->setValue( 'aia', ($ginecologia->tipo_antecedentes_inmunoalergicos == null || $ginecologia->tipo_antecedentes_inmunoalergicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'aia_anios', $ginecologia->tipo_antecedentes_inmunoalergicos);               
                $template->setValue( 'habitos', ($ginecologia->habitos == null || $ginecologia->habitos == '') ? 'No' : 'Si' );               
                $template->setValue( 'habitos_anios', $ginecologia->habitos);               
                $template->setValue( 'ahtq', ($ginecologia->tipos_antecedentes_hospitalarios_quirurgicos == null || $ginecologia->tipos_antecedentes_hospitalarios_quirurgicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'ahtq_anios', $ginecologia->tipos_antecedentes_hospitalarios_quirurgicos);               
                $template->setValue( 'mcl', ($ginecologia_mc_hea->motivo_cosulta == null || $ginecologia_mc_hea->motivo_cosulta == '') ? 'Ginecología' : 'Obstétrica' );               
                $template->setValue( 'mc_observacionl', $ginecologia->motivo_cosulta);               
                $template->setValue( 'hea', $ginecologia_mc_hea->historia_enfermedad_actual);               
                $template->setValue( 'orl', $examen_fisico->otorrinolaringologia);               
                $template->setValue( 'cp', $examen_fisico->cardiopulmonar);               
                $template->setValue( 'abdomen', $examen_fisico->abdomen);               
                $template->setValue( 'go', $examen_fisico->ginecologico);               
                $template->setValue( 'especulo', $examen_fisico->especulo);               
                $template->setValue( 'tv', $examen_fisico->trans_vaginal);               
                $template->setValue( 'usg', $examen_fisico->ultrasonido);               
                $template->setValue( 'ix', $examen_fisico->diagnosticos);               
                $template->setValue( 'plan', $examen_fisico->plan);               
                $template->setValue( 'proxima_cita', $examen_fisico->proxima_cita);               
            
            
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);
            
            $headers = [
                "Content-Type: application/octet-stream",
            ];
            
            return response()->download($tempFile, 'Reporte Ginecología '.$nombre_paciente.' '. date("Y-m-d").' .docx', $headers)->deleteFileAfterSend(true);
            
        } catch (Exception $ex) {
            
        }
        
    }
    
    public function ver_reporte_medicina_general($id_paciente, $id_remision, $id_expediente) {
        
        $file = public_path('/documentos/reportes/Reporte_medicina_general.docx');
        $nombre_paciente = null;
        
        try {
            
            $estado_edicion_subsiguiente = collect(\DB::select("
            SELECT
            case 
            when (now() - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
            else 0 
            end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
            from public.tbl_remisiones r
            join tbl_estados_remisiones er on r.id_estado_remision = er.id
            left join tbl_mg_medicina_general g on r.id = g.id_remision
            where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();            

            $paciente = collect(\DB::select("
            select 
            rfp.id,
             concat(rfp.primer_nombre,' ',rfp.segundo_nombre,' ',rfp.primer_apellido,' ',rfp.segundo_apellido) nombre,
             case 
                 when 
                     date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)) >1 
                 then 
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' años') 
                 else
                     concat(date_part('year',age(CURRENT_DATE, rfp.fecha_nacimiento)),' año') 
             end edad,
             case 
                 when 
                     rfp.sexo = 'M' 
                 then 
                     'Masculino'
                 else 
                     'Femenino'
                 end sexo, 
             rfp.domicilio, rfp.telefono, rfp.identidad, 
             to_char(r.created_at,'TMDay')||', '||to_char( r.created_at ,'dd')||' de '||to_char(r.created_at,'TMMonth')||' de '||to_char(r.created_at,'yyyy') fecha,
             to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
             from reg_ficha_pacientes rfp 
             join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
             where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            $signos_vitales = collect(\DB::select(
            "SELECT temperatura, presion_arterial, peso, talla, saturacion, frecuencia_cardiaca, frecuencia_respiratoria, glucometria 
            from tbl_signos_vitales
            where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $glasgow = collect(\DB::select(
            "SELECT g.glasgow, g.actividad_ocular, g.respuesta_verval, g.respuesta_motora from public.tbl_mg_glasgow g
            where g.id_paciente = :id_paciente and g.deleted_at is null
            ",["id_paciente" => $id_paciente]))->first();

            $estado_conciencia = collect(\DB::select(
                "SELECT ec.alerta, ec.coma, ec.estupor, ec.somnoliento from public.tbl_mg_estado_conciencia ec
                where ec.id_paciente = :id_paciente and ec.id_expediente = :id_expediente and ec.id_remision = :id_remision and ec.deleted_at is null                
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $consulta_exp_general = collect(\DB::select(
                "SELECT antecedentes_patologicos_personales, tratamiento_antecedentes_patologicos_personales, 
                antecendetes_familiares_patologicos, gestas, partos, cesareas, abortos, fecha_ultima_menstruacion, cuales_alergias, tipo_habitos, 
                antecendetes_hospitalarios_quirurgicos, motivo_consulta, historia_enfermedad_actual, examen_fisico, diagnostico, indicaciones_tratamiento,
                proxima_cita
                    FROM public.tbl_mg_medicina_general
                    where id_paciente = :id_paciente and deleted_at is null
                ",["id_paciente" => $id_paciente]))->first();
                
            $receta = collect(\DB::select("
            select rm.id_paciente, rm.id_expediente, rm.id_remision,
            TRIM(
            COALESCE(TRIM(pe.primer_nombre)||' ','')||
                COALESCE(TRIM(pe.primer_apellido||' '),'')
            ) nombre, telefono celular,
            rm.descripcion_receta, c.nombre cargo
            from users u
            join per_empleado pe on u.id = pe.id_usuario
            join tbl_receta_medica rm on rm.id_medico = pe.id
            join tbl_cargos c on pe.id_cargo = c.id
            where  pe.deleted_at is null and 
            rm.id_paciente = :id_paciente and rm.id_expediente = :id_expediente and rm.id_remision = :id_remision
        ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
            
            
            $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            
            
                
                $nombre_paciente = $paciente->nombre;
                
                $template->setValue( 'nombre_paciente', $paciente->nombre);
                $template->setValue( 'age', $paciente->edad);
                $template->setValue( 'sexo', $paciente->sexo);
                $template->setValue( 'direccion', $paciente->domicilio);
                $template->setValue( 'telefono_paciente', $paciente->telefono);
                $template->setValue( 'identidad', $paciente->identidad);
                $template->setValue( 'fecha_atencion', $paciente->fecha);
                $template->setValue( 'hora_atencion', $paciente->hora);
                $template->setValue( 'medico', $paciente->medico);
                $template->setValue( 'temperatura', $signos_vitales->temperatura);
                $template->setValue( 'presion_arterial', $signos_vitales->presion_arterial);
                $template->setValue( 'peso', $signos_vitales->peso);
                $template->setValue( 'talla', $signos_vitales->talla);
                $template->setValue( 'sat', $signos_vitales->saturacion);
                $template->setValue( 'fc', $signos_vitales->frecuencia_cardiaca);
                $template->setValue( 'fr', $signos_vitales->frecuencia_respiratoria);
                $template->setValue( 'gmt', $signos_vitales->glucometria);       
                $template->setValue( 'glasgow', $glasgow->glasgow);
                $template->setValue( 'ao', $glasgow->actividad_ocular);
                $template->setValue( 'rv', $glasgow->respuesta_verval);
                $template->setValue( 'rm', $glasgow->respuesta_motora);                
                $template->setValue( 'alerta', $estado_conciencia->alerta);
                $template->setValue( 'somniliente', $estado_conciencia->somnoliento);
                $template->setValue( 'estupo', $estado_conciencia->estupor);
                $template->setValue( 'coma', $estado_conciencia->coma);
                $template->setValue( 'app', $consulta_exp_general->antecedentes_patologicos_personales);               
                $template->setValue( 'afp', $consulta_exp_general->antecendetes_familiares_patologicos);               
                $template->setValue( 'gestas', $consulta_exp_general->gestas);               
                $template->setValue( 'parto', $consulta_exp_general->partos);               
                $template->setValue( 'cesarea', $consulta_exp_general->cesareas);               
                $template->setValue( 'aborto', $consulta_exp_general->abortos);               
                $template->setValue( 'fum', $consulta_exp_general->fecha_ultima_menstruacion);               
                $template->setValue( 'aia', $consulta_exp_general->cuales_alergias);               
                $template->setValue( 'habitos', $consulta_exp_general->tipo_habitos);               
                $template->setValue( 'ahq', $consulta_exp_general->antecendetes_hospitalarios_quirurgicos);               
                $template->setValue( 'motivo_consulta', $consulta_exp_general->motivo_consulta);               
                $template->setValue( 'historia_enfermedad_actual', $consulta_exp_general->historia_enfermedad_actual);               
                $template->setValue( 'examen_fisico', $consulta_exp_general->examen_fisico);               
                $template->setValue( 'idx', $consulta_exp_general->diagnostico);               
                $template->setValue( 'indicaciones_tratamiento', $consulta_exp_general->indicaciones_tratamiento);               
                $template->setValue( 'proxima_cita', $consulta_exp_general->proxima_cita);               
            
            
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);
            
            $headers = [
                "Content-Type: application/octet-stream",
            ];
            
            return response()->download($tempFile, 'Reporte Medicina General '.$nombre_paciente.' '. date("Y-m-d").' .docx', $headers)->deleteFileAfterSend(true);
           
            
        } catch (Exception $ex) {
            
        }
        
        
    }
}
