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
            
        
        
        $estado_edicion_subsiguiente = DB::select("
                SELECT
                case 
                when ((now() at time zone 'CST') - p.created_at) <= '24 hour' and r.id = p.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_pediatrico p on r.id = p.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);
            

            $paciente = DB::select("
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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);
            
            $tipos_sangre = DB::select("
                select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
            ");

            $indice_masa_corporal = DB::select("
                select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
            ");

            $tipos_partos = DB::select("
                select id, nombre from tbl_tipos_partos where deleted_at is null order by nombre
            ");

            $sub_siguiente = DB::select("
                select count(*) existe from tbl_exp_pediatrico where id_paciente = :id_paciente and deleted_at is null
            ", ["id_paciente" => $id_paciente]);

            $signos_vitales = DB::select("
                select temperatura, presion_arterial, peso, talla, saturacion, frecuencia_cardiaca, frecuencia_respiratoria, glucometria 
                from tbl_signos_vitales
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $consulta_exp_pediatrico_hea_mc= DB::select("
                select motivo_consulta from public.tbl_exp_pediatrico_hea_mc
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);
            //inicia sub siguiente
            $consulta_exp_pediatrico = DB::select("
                select motivo_consulta, historia_enfermedad_actual, antecedentes_personales_patologicos, 
                tratamiento_antecedentes_personales_patologicos, antecedentes_familiares_patologicos, antecedentes_hospitalarios_quirurgicos, 
                inmunizacion, tipo_alergia
                from tbl_exp_pediatrico
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $antecendentes_prenatales = DB::select("
                select ap.id_paciente, ap.id_expediente, ap.id_remision, ap.nombre_madre, ap.edad, ap.id_tipo_sangre, ts.nombre tipo_sangre, ap.enfermedades_durante_embarazo, 
                ap.gestas, ap.partos, ap.cesarias, ap.control_prenatal_ultimo_embarazo
                from tbl_ped_antecendentes_prenatales ap
                join tbl_tipos_sangre ts on ap.id_tipo_sangre = ts.id
                where ap.deleted_at is null
                and ap.id_paciente = :id_paciente and ap.id_expediente = :id_expediente and ap.id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $natalicio = DB::select("
                select pn.id_paciente, pn.id_expediente, pn.id_remision, pn.lugar_nacimiento, pn.apgar, 
                pn.peso, pn.talla, pn.perimetro_cefalico, pn.id_tipo_parto, tp.nombre tipo_parto, pn.complicaciones_parto
                from public.tbl_ped_natalicio pn 
                join tbl_tipos_partos tp on tp.id = pn.id_tipo_parto
                where pn.deleted_at is null and
                pn.id_paciente = :id_paciente and pn.id_expediente = :id_expediente and pn.id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $desarrollo_psicomotor = DB::select("
                select id_paciente, id_expediente, id_remision, sonrio, sostuvo_cabeza, se_sento, se_paro, comino_solo,
                habla, control_esfinteres, escolaridad_actual
                from public.tbl_ped_desarrollo_psicomotor
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $lactancia = DB::select("
                select id_paciente, id_expediente, id_remision, lactancia_materna, lactancia_artificial,
                ablactacion, alimentacion_actual
                from public.tbl_ped_lactancia
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);
            //finaliza sub siguiente
            // $lactancia_alimentacion_actual = DB::select("
            //     select alimentacion_actual from public.tbl_ped_lactancia_alimentacion_actual
            //     where deleted_at is null and
            //     id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            // ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $exa_fisico_diagnostico_indicaciones = DB::select("
                select id_paciente, id_expediente, id_remision, examen_fisico, diagnostico, indicaciones
                from public.tbl_ped_exa_fisico_diagnostico_indicaciones
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $receta = DB::select("
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
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);
        
           $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            

                foreach ( $paciente as $row){
                    $nombre_paciente = $row->nombre;
                    $template->setValue( 'nombre_paciente', $row->nombre);
                    $template->setValue( 'age', $row->edad);
                    $template->setValue( 'sexo', $row->sexo);
                    $template->setValue( 'direccion', $row->domicilio);
                    $template->setValue( 'telefono_paciente', $row->telefono);
                    $template->setValue( 'identidad', $row->identidad);
                    $template->setValue( 'fecha_atencion', $row->fecha);
                    $template->setValue( 'hora_atencion', $row->hora);
                    $template->setValue( 'medico', $row->medico);
                    
                }
                
                foreach ($signos_vitales as $row) {
                    $template->setValue( 'temperatura', $row->temperatura);
                    $template->setValue( 'presion_arterial', $row->presion_arterial);
                    $template->setValue( 'peso', $row->peso);
                    $template->setValue( 'talla', $row->talla);
                    $template->setValue( 'sat', $row->saturacion);
                    $template->setValue( 'fc', $row->frecuencia_cardiaca);
                    $template->setValue( 'fr', $row->frecuencia_respiratoria);
                    $template->setValue( 'gmt', $row->glucometria);                 
                    
                }
                
                
                foreach ($consulta_exp_pediatrico as $row) {
                                     
                    $template->setValue( 'motivo_consulta', $row->motivo_consulta);
                    $template->setValue( 'historia_enfermedad_actual', $row->historia_enfermedad_actual);
                    $template->setValue( 'app', ($row->antecedentes_personales_patologicos == null || $row->antecedentes_personales_patologicos == '') ? 'No' : 'Si'  );
                    $template->setValue( 'app_descripcion', $row->antecedentes_personales_patologicos);                
                    $template->setValue( 'tx', ($row->tratamiento_antecedentes_personales_patologicos == null || $row->tratamiento_antecedentes_personales_patologicos == '') ? 'No' : 'Si' );
                    $template->setValue( 'tx_descripcion', $row->tratamiento_antecedentes_personales_patologicos);
                    $template->setValue( 'afp', ($row->antecedentes_familiares_patologicos == null || $row->antecedentes_familiares_patologicos == '') ? 'No' : 'Si');
                    $template->setValue( 'afp_descripcion', $row->antecedentes_familiares_patologicos);
                    $template->setValue( 'ahtq', ($row->antecedentes_hospitalarios_quirurgicos == null || $row->antecedentes_hospitalarios_quirurgicos == '') ? 'No' : 'Si');               
                    $template->setValue( 'ahtq_descripcion', $row->antecedentes_hospitalarios_quirurgicos);               
                    $template->setValue( 'inmunizacion', $row->inmunizacion);               
                    $template->setValue( 'alergias', ($row->tipo_alergia == null || $row->tipo_alergia == '') ? 'No' : 'Si' );               
                    $template->setValue( 'alergias_descripcion', $row->tipo_alergia); 
                    
                }
                
                foreach ($antecendentes_prenatales as $row) {
                    
                    $template->setValue( 'nombre', $row->nombre_madre);               
                    $template->setValue( 'edad_ap', $row->edad);               
                    $template->setValue( 'tipo_sangre', $row->tipo_sangre); 
                    $template->setValue( 'ede', ($row->enfermedades_durante_embarazo == null || $row->tipo_alergia == '') ? 'No' : 'Si');
                }
                
                foreach ($consulta_exp_pediatrico as $row) {
                    
                    $template->setValue( 'ede_descripcion', $row->tipo_alergia );
                }
                
                foreach ($antecendentes_prenatales as $row) {
                    
                    $template->setValue( 'gp', $row->gestas);               
                    $template->setValue( 'np', $row->partos);               
                    $template->setValue( 'nc', $row->cesarias);               
                    $template->setValue( 'cpn', $row->control_prenatal_ultimo_embarazo);               
                    
                }
                
                foreach ($natalicio as $rown) {
                
                    $template->setValue( 'nace', $rown->lugar_nacimiento);               
                    $template->setValue( 'apgar', $rown->apgar);
                    $template->setValue( 'peso', ($rown->peso == null || $rown->peso == '') ? '' : $rown->peso  );               
                    $template->setValue( 'talla_natal', $rown->talla);               
                    $template->setValue( 'pc', $rown->perimetro_cefalico);               
                    $template->setValue( 'tipo_parto', $rown->tipo_parto);               
                    $template->setValue( 'complicaciones_parto', ($rown->complicaciones_parto == null || $rown->complicaciones_parto == '') ? 'No' : 'Si' );               
                    $template->setValue( 'complicaciones_parto_descripcion', $rown->complicaciones_parto); 
                
                }
                
                
                foreach ($desarrollo_psicomotor as $row) {
                    
                    $template->setValue( 'sonrio', ($row->sonrio) ? '▣' : '□' );               
                    $template->setValue( 'sostuvo_cabeza', ($row->sostuvo_cabeza) ? '▣' : '□');               
                    $template->setValue( 'sento', ($row->se_sento) ? '▣' : '□');               
                    $template->setValue( 'paro', ($row->se_paro)? '▣' : '□' );               
                    $template->setValue( 'camino_solo', ($row->comino_solo)? '▣' : '□' );               
                    $template->setValue( 'habla', ($row->habla )? '▣' : '□' );               
                    $template->setValue( 'control_esfinter', ($row->control_esfinteres ) ? '▣' : '□');               
                    $template->setValue( 'escolaridad', ($row->escolaridad_actual == null || $row->escolaridad_actual == '') ? 'No' : 'Si' );               
                    $template->setValue( 'cual_escolaridad', $row->escolaridad_actual);               
                    
                }
                
                foreach ($lactancia as $row) {
                    
                    $template->setValue( 'lactancia', ($row->ablactacion == null || $row->ablactacion == '') ? 'No' : 'Si' );               
                    $template->setValue( 'materna', ($row->lactancia_materna == true && $row->lactancia_artificial == false) ? '◉' : '○');               
                    $template->setValue( 'artificial', ($row->lactancia_materna == false && $row->lactancia_artificial == true) ? '◉' : '○');               
                    $template->setValue( 'mixta', ($row->lactancia_materna == true && $row->lactancia_artificial == true) ? '◉' : '○');               
                    $template->setValue( 'dpc', $row->ablactacion);               
                    $template->setValue( 'daa', $row->alimentacion_actual);               
                    
                }
                
                foreach ($exa_fisico_diagnostico_indicaciones as $row) {
                    
                    $template->setValue( 'examen_fisico', $row->examen_fisico );               
                    $template->setValue( 'diagnostico', $row->diagnostico);               
                    $template->setValue( 'indicaciones', $row->indicaciones);              
                    
                }
            
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
            $estado_edicion_subsiguiente = DB::select("
                SELECT
                case 
                when ((now() at time zone 'CST') - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_ginecologia g on r.id = g.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);

            
            $paciente = DB::select("
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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);

            $tipos_sangre = DB::select("
                select id, nombre from tbl_tipos_sangre where deleted_at is null order by nombre
            ");

            $indice_masa_corporal = DB::select("
                select id, descripcion_masa_corporal from tbl_indice_masa_corporal where deleted_at is null
            ");

            $sub_siguiente = DB::select("
                select count(*) existe from tbl_exp_ginecologia where id_paciente = :id_paciente and deleted_at is null
            ", ["id_paciente" => $id_paciente]);

            $signos_vitales = DB::select("
                select sv.temperatura, sv.presion_arterial, sv.peso, sv.talla, sv.saturacion, sv.frecuencia_cardiaca, sv.frecuencia_respiratoria, sv.glucometria, im.descripcion_masa_corporal as masa_corporal
                from tbl_signos_vitales sv 
                left join tbl_indice_masa_corporal im ON im.id = sv.id_masa_corporal
                where sv.id_paciente = :id_paciente and sv.id_expediente = :id_expediente and sv.id_remision = :id_remision and sv.deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $ginecologia_mc_hea = DB::select("
                SELECT motivo_cosulta, motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual
                FROM public.tbl_exp_ginecologia_mc_hea
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $ginecologia = DB::select("
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
left join public.tbl_tipos_sangre ts ON ts.id = eg.id_tipo_sangre
where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and eg.deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $examen_fisico = DB::select("
                SELECT otorrinolaringologia, cardiopulmonar, abdomen, ginecologico, especulo, trans_vaginal,
                ultrasonido, diagnosticos, plan, proxima_cita
                FROM public.tbl_gin_examen_fisico
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $receta = DB::select("
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
            ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);
            
            $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            
            
            foreach ($paciente as $rowp) {
                $nombre_paciente = $rowp->nombre;
                $template->setValue( 'nombre_paciente', $rowp->nombre);
                $template->setValue( 'age', $rowp->edad);
                $template->setValue( 'sexo', $rowp->sexo);
                $template->setValue( 'direccion', $rowp->domicilio);
                $template->setValue( 'telefono_paciente', $rowp->telefono);
                $template->setValue( 'identidad', $rowp->identidad);
                $template->setValue( 'fecha_atencion', $rowp->fecha);
                $template->setValue( 'hora_atencion', $rowp->hora);
                $template->setValue( 'medico', $rowp->medico);
            }
                
            foreach ($signos_vitales as $rowsv) {
                $template->setValue( 'temperatura', $rowsv->temperatura);
                $template->setValue( 'presion_arterial', $rowsv->presion_arterial);
                $template->setValue( 'peso', $rowsv->peso);
                $template->setValue( 'talla', $rowsv->talla);
                $template->setValue( 'sat', $rowsv->saturacion);
                $template->setValue( 'fc', $rowsv->frecuencia_cardiaca);
                $template->setValue( 'fr', $rowsv->frecuencia_respiratoria);
                $template->setValue( 'gmt', $rowsv->glucometria);       
                $template->setValue( 'imc', $rowsv->masa_corporal);
            }
            
            foreach ($ginecologia as $rowg) {
                $template->setValue( 'gestas', $rowg->gestas);
                $template->setValue( 'partos', $rowg->partos);
                $template->setValue( 'cesarea', $rowg->cesareas);                
                $template->setValue( 'abortos', $rowg->abortos);
                $template->setValue( 'hv', $rowg->hijos_vivos);
                $template->setValue( 'hijos_muertos', $rowg->hijos_muertos);
                $template->setValue( 'fup', $rowg->fecha_parto);
                $template->setValue( 'atendido', $rowg->atendido);               
                $template->setValue( 'fum', $rowg->fum);               
                $template->setValue( 'fum_fecha', $rowg->fecha_ultima_mestruacion);               
                $template->setValue( 'fpp', ($rowg->fecha_provable_parto == null || $rowg->fecha_provable_parto == '') ? 'No Aplica' : 'Si' );               
                $template->setValue( 'fpp_fecha', $rowg->fecha_provable_parto);               
                $template->setValue( 'citologia', $rowg->citologia);               
                $template->setValue( 'pf', ($rowg->descripcion_planificacion_familiar == null || $rowg->descripcion_planificacion_familiar == '' ) ? 'No' : 'Si'  );               
                $template->setValue( 'pf_kg', $rowg->descripcion_planificacion_familiar);               
                $template->setValue( 'tipo_sangre', $rowg->tipo_sangre);               
                $template->setValue( 'vaginosis', ($rowg->descripcion_vaginosis == null || $rowg->descripcion_vaginosis == '') ? 'No' : 'Si' );               
                $template->setValue( 'vaginosis_kg', $rowg->descripcion_vaginosis);               
                $template->setValue( 'itu', ($rowg->descripcion_infeccion_tracto_urinario == null || $rowg->descripcion_infeccion_tracto_urinario == '')? 'No Aplica' : 'Si' );               
                $template->setValue( 'itu_kg', $rowg->descripcion_infeccion_tracto_urinario);               
                $template->setValue( 'prurito', ($rowg->descripcion_prurito == null || $rowg->descripcion_prurito == '') ? 'No' : 'Si'  );               
                $template->setValue( 'prurito_kg', $rowg->descripcion_prurito);               
                $template->setValue( 'menarquia', ($rowg->descripcion_menarquia == null || $rowg->descripcion_menarquia == '') ? 'No' : 'Si' );               
                $template->setValue( 'menarquia_kg', $rowg->descripcion_menarquia);               
                $template->setValue( 'ivs', ($rowg->edad_inicio_vida_sexual == null || $rowg->edad_inicio_vida_sexual == '')? 'No' : 'Si' );               
                $template->setValue( 'ivs_anios', $rowg->edad_inicio_vida_sexual);               
                $template->setValue( 'nps', $rowg->numero_parejas_sexuales);               
                $template->setValue( 'etsl', ($rowg->tipo_enfermedades_trasmision_sexual == null || $rowg->tipo_enfermedades_trasmision_sexual == ''));               
                $template->setValue( 'ets_diagnostico', $rowg->tipo_enfermedades_trasmision_sexual);               
                $template->setValue( 'vsa', $rowg->vida_sexual_activa);               
                $template->setValue( 'app', ($rowg->tipo_antecendestes_personales_patologicos == null || $rowg->tipo_antecendestes_personales_patologicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'app_anios', $rowg->tipo_antecendestes_personales_patologicos);               
                $template->setValue( 'afp', ($rowg->afp == null || $rowg->afp == '') ? 'No' : 'Si' );               
                $template->setValue( 'afp_anios', $rowg->afp);               
                $template->setValue( 'aia', ($rowg->tipo_antecedentes_inmunoalergicos == null || $rowg->tipo_antecedentes_inmunoalergicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'aia_anios', $rowg->tipo_antecedentes_inmunoalergicos);               
                $template->setValue( 'habitos', ($rowg->habitos == null || $rowg->habitos == '') ? 'No' : 'Si' );               
                $template->setValue( 'habitos_anios', $rowg->habitos);               
                $template->setValue( 'ahtq', ($rowg->tipos_antecedentes_hospitalarios_quirurgicos == null || $rowg->tipos_antecedentes_hospitalarios_quirurgicos == '') ? 'No' : 'Si' );               
                $template->setValue( 'ahtq_anios', $rowg->tipos_antecedentes_hospitalarios_quirurgicos);
            }
            
            foreach ($ginecologia_mc_hea as $rowgm) {
                $template->setValue( 'mcl', ($rowgm->motivo_cosulta == null || $rowgm->motivo_cosulta == '') ? 'Ginecología' : 'Obstétrica' ); 
            }
            
            foreach ($ginecologia as $rowgn) {
                $template->setValue( 'mc_observacionl', $rowgn->motivo_cosulta); 
            }
            
            foreach ($ginecologia_mc_hea as $rowgmh) {
                $template->setValue( 'hea', $rowgmh->historia_enfermedad_actual);
            }
            
            foreach ($examen_fisico as $rowe) {
                $template->setValue( 'orl', $rowe->otorrinolaringologia);               
                $template->setValue( 'cp', $rowe->cardiopulmonar);               
                $template->setValue( 'abdomen', $rowe->abdomen);               
                $template->setValue( 'go', $rowe->ginecologico);               
                $template->setValue( 'especulo', $rowe->especulo);               
                $template->setValue( 'tv', $rowe->trans_vaginal);               
                $template->setValue( 'usg', $rowe->ultrasonido);               
                $template->setValue( 'ix', $rowe->diagnosticos);               
                $template->setValue( 'plan', $rowe->plan);               
                $template->setValue( 'proxima_cita', $rowe->proxima_cita);
            }
            
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
            
            $estado_edicion_subsiguiente = DB::select("
            SELECT
            case 
            when ((now() at time zone 'CST') - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
            else 0 
            end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
            from public.tbl_remisiones r
            join tbl_estados_remisiones er on r.id_estado_remision = er.id
            left join tbl_mg_medicina_general g on r.id = g.id_remision
            where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);            

            $paciente = DB::select("
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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||COALESCE(TRIM(pe.primer_apellido)||' ','')||
            COALESCE(TRIM(pe.segundo_apellido||' '),'') ) medico
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join per_empleado pe on pe.id = r.id_medico
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
                and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]);

            $signos_vitales = DB::select(
            "SELECT temperatura, presion_arterial, peso, talla, saturacion, frecuencia_cardiaca, frecuencia_respiratoria, glucometria 
            from tbl_signos_vitales
            where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $glasgow = DB::select(
            "SELECT g.glasgow, g.actividad_ocular, g.respuesta_verval, g.respuesta_motora from public.tbl_mg_glasgow g
            where g.id_paciente = :id_paciente and g.deleted_at is null
            ",["id_paciente" => $id_paciente]);

            $estado_conciencia = DB::select(
                "SELECT ec.alerta, ec.coma, ec.estupor, ec.somnoliento from public.tbl_mg_estado_conciencia ec
                where ec.id_paciente = :id_paciente and ec.id_expediente = :id_expediente and ec.id_remision = :id_remision and ec.deleted_at is null                
                ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);

            $consulta_exp_general = DB::select(
                "SELECT antecedentes_patologicos_personales, tratamiento_antecedentes_patologicos_personales, 
                antecendetes_familiares_patologicos, gestas, partos, cesareas, abortos, fecha_ultima_menstruacion, cuales_alergias, tipo_habitos, 
                antecendetes_hospitalarios_quirurgicos, motivo_consulta, historia_enfermedad_actual, examen_fisico, diagnostico, indicaciones_tratamiento,
                proxima_cita
                    FROM public.tbl_mg_medicina_general
                    where id_paciente = :id_paciente and deleted_at is null
                ",["id_paciente" => $id_paciente]);
                
            $receta = DB::select("
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
        ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]);
            
            
            $template = new \PhpOffice\PhpWord\TemplateProcessor( $file );
            
            
                foreach ($paciente as $row) {

                    $nombre_paciente = $row->nombre;
                    $template->setValue( 'nombre_paciente', $row->nombre);
                    $template->setValue( 'age', $row->edad);
                    $template->setValue( 'sexo', $row->sexo);
                    $template->setValue( 'direccion', $row->domicilio);
                    $template->setValue( 'telefono_paciente', $row->telefono);
                    $template->setValue( 'identidad', $row->identidad);
                    $template->setValue( 'fecha_atencion', $row->fecha);
                    $template->setValue( 'hora_atencion', $row->hora);
                    $template->setValue( 'medico', $row->medico);
                }
                
                
                
                foreach ($signos_vitales as $row) {
                    
                    $template->setValue( 'temperatura', $row->temperatura);
                    $template->setValue( 'presion_arterial', $row->presion_arterial);
                    $template->setValue( 'peso', $row->peso);
                    $template->setValue( 'talla', $row->talla);
                    $template->setValue( 'sat', $row->saturacion);
                    $template->setValue( 'fc', $row->frecuencia_cardiaca);
                    $template->setValue( 'fr', $row->frecuencia_respiratoria);
                    $template->setValue( 'gmt', $row->glucometria); 
                }
                
                
                foreach ($glasgow as $row) {
                    
                    $template->setValue( 'glasgow', $row->glasgow);
                    $template->setValue( 'ao', $row->actividad_ocular);
                    $template->setValue( 'rv', $row->respuesta_verval);
                    $template->setValue( 'rm', $row->respuesta_motora);
                }

                
                foreach ($estado_conciencia as $row) {
                    
                    $template->setValue( 'alerta', $row->alerta);
                    $template->setValue( 'somniliente', $row->somnoliento);
                    $template->setValue( 'estupo', $row->estupor);
                    $template->setValue( 'coma', $row->coma);
                }
                
                
                foreach ($consulta_exp_general as $row) {                                    
                
                    $template->setValue( 'app', $row->antecedentes_patologicos_personales);               
                    $template->setValue( 'afp', $row->antecendetes_familiares_patologicos);               
                    $template->setValue( 'gestas', $row->gestas);               
                    $template->setValue( 'parto', $row->partos);               
                    $template->setValue( 'cesarea', $row->cesareas);               
                    $template->setValue( 'aborto', $row->abortos);               
                    $template->setValue( 'fum', $row->fecha_ultima_menstruacion);               
                    $template->setValue( 'aia', $row->cuales_alergias);               
                    $template->setValue( 'habitos', $row->tipo_habitos);               
                    $template->setValue( 'ahq', $row->antecendetes_hospitalarios_quirurgicos);               
                    $template->setValue( 'motivo_consulta', $row->motivo_consulta);               
                    $template->setValue( 'historia_enfermedad_actual', $row->historia_enfermedad_actual);               
                    $template->setValue( 'examen_fisico', $row->examen_fisico);               
                    $template->setValue( 'idx', $row->diagnostico);               
                    $template->setValue( 'indicaciones_tratamiento', $row->indicaciones_tratamiento);               
                    $template->setValue( 'proxima_cita', $row->proxima_cita);


                }
            
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
