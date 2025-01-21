<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Exception;
use File;
use Illuminate\Support\Facades\Response;

class PacienteController extends Controller
{
    public $ESTADO_ESPERA_REMISIONES = 1;
    public $ESTADO_PROCESO_REMISIONES = 2;
    public $ESTADO_OBSERVACION_REMISIONES = 3;
    public $ESTADO_RETIRO_REMISIONES = 4;
    public $ESTADO_FINALIZO_REMISIONES = 5;
    public $AREA_GINECOLOGIA = 1;
    public $AREA_PEDIATRIA = 2;
    public $AREA_MEDICINA_GENERAL = 3;
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_recepcion()
    {
        if (session('rcp_vista_recepcion') != '1') {
            return view('error')->with('code_error', '403');
        }

        return view('recepcion.vista_recepcion');
    }

    public function vista_historial_clincio_pacientes()
    {
        if (session('med_leer_historial_clinico') != '1') {
            return view('error')->with('code_error', '403');
        }

        return view('historial_clinico.historial_clinico_pacientes');
    }

    public function vista_archivos_listado_pacientes()
    {
        if (session('arc_leer_archivos') != '1') {
            return view('error')->with('code_error', '403');
        }

        return view('archivos.archivos_listado_pacientes');
    }

    public function obtener_lista_pacientes()
    {
        /*if (session('rcp_vista_recepcion') != '1') {
            return view('error')->with('code_error', '403');
        }*/

        $get_paciente = DB::SELECT("
        select
        rfp.id,
        COALESCE(rfp.identidad, 'N/D') identidad,  
        --rfp.identidad,
            TRIM(
                COALESCE(TRIM(rfp.primer_nombre)||' ','')||
                COALESCE(TRIM(rfp.segundo_nombre)||' ','')||
                COALESCE(TRIM(rfp.primer_apellido)||' ','')||
                COALESCE(TRIM(rfp.segundo_apellido||' '),'')

            ) nombre_completo,
            rfp.fecha_nacimiento,
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
                    rfp.sexo = 'F' then 'Femenino' 
                when 
                    rfp.sexo = 'M' then 'Masculino'
                else
                    'No definido'
            end sexo,
            COALESCE(rfp.telefono, 'N/D') telefono,
            
            concat(rfp.domicilio, ', ', m.nombre, ', ', d.nombre ) domicilio,
            COALESCE(rfp.nombre_padre, 'N/D') nombre_padre,
            COALESCE(rfp.nombre_madre,'N/D') nombre_madre,
            COALESCE(rfp.nombre_tutor,'N/D') nombre_tutor,
            rfp.created_at,
            rfp.updated_at
            --age ( current_date, rfp.created_at ) creado
        from reg_ficha_pacientes rfp
        left join tbl_departamentos d on rfp.id_departamento = d.id
        left join tbl_municipios m on rfp.id_municipio = m.id
        where rfp.deleted_at is null
        ");
        $departamentos = DB::SELECT("
            select id, 
                nombre as departamento
            from tbl_departamentos
            where deleted_at is null
            order by id asc
                
        ");
        $deparmatento_municipios = DB::select("
                select
                    dm.id_departamento,
                    dm.id_municipio,
                    m.nombre municipio
                    from tbl_departamentos_municipios dm
                join tbl_municipios m on dm.id_municipio = m.id
        ");
        return response()->json(['data' => $get_paciente, 'departamentos'=>$departamentos, 'deparmatento_municipios' => $deparmatento_municipios]);
    }
    public function guardar_paciente(Request $request)
    {
        
        $msgError = null;
        $msgSuccess = null;
        $primer_nombre = $request->primer_nombre;
        $segundo_nombre = $request->segundo_nombre;
        $primer_apellido = $request->primer_apellido;
        $segundo_apellido = $request->segundo_apellido;
        $identidad = $request->identidad;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $telefono = $request->telefono;
        $genero = $request->genero;
        $domicilio = $request->domicilio;
        $nombre_padre = $request->nombre_padre;
        $nombre_madre = $request->nombre_madre;
        $nombre_tutor = $request->nombre_tutor;
        $id_departamento = $request->id_departamento;
        $id_municipio = $request->id_municipio;

        DB::beginTransaction();
        try {
            if (session('rcp_guardar_paciente') != '1') {
                throw new Exception("Permiso denegado, solicitar permiso al departamento de Administración");
            }
            $sql = DB::select(
                "
            INSERT INTO public.reg_ficha_pacientes(
                identidad, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, sexo, telefono, domicilio, nombre_padre, nombre_madre, nombre_tutor, created_at, updated_at, id_departamento, id_municipio)
                VALUES ( :identidad, upper(:primer_nombre), upper(:segundo_nombre), upper(:primer_apellido), upper(:segundo_apellido), :fecha_nacimiento, :sexo, :telefono, upper(:domicilio), upper(:nombre_padre), upper(:nombre_madre), upper(:nombre_tutor), (now() at time zone 'CST'), (now() at time zone 'CST'), :id_departamento, :id_municipio)",
                [
                    'identidad' => $identidad,
                    'primer_nombre' => $primer_nombre,
                    'segundo_nombre' => $segundo_nombre,
                    'primer_apellido' => $primer_apellido,
                    'segundo_apellido' => $segundo_apellido,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'sexo' => $genero,
                    'telefono' => $telefono,
                    'domicilio' => $domicilio,
                    'nombre_padre' => $nombre_padre,
                    'nombre_madre' => $nombre_madre,
                    'nombre_tutor' => $nombre_tutor,
                    'id_departamento' => $id_departamento,
                    'id_municipio' => $id_municipio,
                ]
            );

            $msgSuccess = 'Paciente creado correctamente';
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $msgError = $e->getMessage();
        }
        return response()->json([
            'msgSuccess' => $msgSuccess,
            'msgError' => $msgError,
        ]);
    }
    public function vista_modificar_paciente(Request $request)
    {
        if (session('modificar_paciente') != '1') {
            return view('error')->with('code_error', '403');
        }

        $id_paciente = $request->id_paciente;

        $info_paciente = DB::select("
        select 	id,
                primer_nombre,
                segundo_nombre,
                primer_apellido,
                segundo_apellido,
                identidad,
                fecha_nacimiento,
                case
                        when
                            sexo = 'F' then 'Femenino' 
                        when 
                            sexo = 'M' then 'Masculino'
                        else
                            'No definido'
                end sexo,
                telefono,
                domicilio,
                nombre_padre,
                nombre_madre,
		        nombre_tutor
	        from reg_ficha_pacientes
        where deleted_at is null
            and id = :id_paciente
        ", ["id_paciente"=>$id_paciente]);

        return view('pacientes.editar_paciente')->with("info_paciente",$info_paciente);
    }
    public function update_informacion_paciente(Request $request){
        $msgError = null;
        $msgSuccess = null;
        $id_paciente = $request->id_paciente;
        $primer_nombre = $request->primer_nombre;
        $segundo_nombre = $request->segundo_nombre;
        $primer_apellido = $request->primer_apellido;
        $segundo_apellido = $request->segundo_apellido;
        $identidad = $request->identidad;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $telefono = $request->telefono;
        $genero = $request->genero;
        $domicilio = $request->domicilio;
        $nombre_padre = $request->nombre_padre;
        $nombre_madre = $request->nombre_madre;
        $nombre_tutor = $request->nombre_tutor;

        DB::beginTransaction();
        try {
            if (session('modificar_paciente') != '1') {
                throw new Exeption("Permiso denegado, solicitar permiso al departamento de Administración");
            }
            $sql = DB::select(
                "
            UPDATE public.reg_ficha_pacientes SET
                identidad=:identidad, 
                primer_nombre=upper(:primer_nombre), 
                segundo_nombre=upper(:segundo_nombre), 
                primer_apellido=upper(:primer_apellido), 
                segundo_apellido=upper(:segundo_apellido), 
                fecha_nacimiento=:fecha_nacimiento, 
                sexo=:sexo, 
                telefono=:telefono, 
                domicilio=upper(:domicilio), 
                nombre_padre=upper(:nombre_padre), 
                nombre_madre=upper(:nombre_madre), 
                nombre_tutor=upper(:nombre_tutor), 
                UPDATED_AT=(now() at time zone 'CST')
            WHERE id=:id_paciente;",
                [   
                    'id_paciente'=>$id_paciente,
                    'identidad' => $identidad,
                    'primer_nombre' => $primer_nombre,
                    'segundo_nombre' => $segundo_nombre,
                    'primer_apellido' => $primer_apellido,
                    'segundo_apellido' => $segundo_apellido,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'sexo' => $genero,
                    'telefono' => $telefono,
                    'domicilio' => $domicilio,
                    'nombre_padre' => $nombre_padre,
                    'nombre_madre' => $nombre_madre,
                    'nombre_tutor' => $nombre_tutor,
                ]
            );

            $msgSuccess = 'Datos de paciente actualizados correctamente';
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $msgError = $e->getMessage();
        }
        return response()->json([
            'msgSuccess' => $msgSuccess,
            'msgError' => $msgError,
        ]);
    }
    public function historial_consultas_paciente(Request $request, $id_paciente){
        if (session('med_leer_historial_clinico') != '1') {
            return view('error')->with('code_error', '403');
        }

        $lab_leer_examen = session('lab_leer_examen');
        $paciente = collect(\DB::select("
            select 
            fp.id,
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
            domicilio, telefono, 
            concat(substr(identidad,1,4),'-',substr(identidad,5,4),'-',substr(identidad,9,5)) identidad,
            ds.nombre_espanol||', '||to_char( current_date ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(current_date,'yyyy') fecha,
            to_char(current_timestamp, 'HH12:MI AM') hora
            from reg_ficha_pacientes fp
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( current_date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(current_date,'D')
            where fp.deleted_at is null
            and fp.id = :id_paciente
        ", ["id_paciente" => $id_paciente]))->first();

        return view("historial_clinico.master_historial_clinico")
                ->with("paciente", $paciente)->with("lab_leer_examen", $lab_leer_examen);
    }

    public function historial_archivos(Request $request, $id_paciente){
        if (session('arc_leer_archivos') != '1') {
            return view('error')->with('code_error', '403');
        }

        $lab_leer_examen = session('lab_leer_examen');
        $arc_leer_archivos_historial_clinico_digital = session('arc_leer_archivos_historial_clinico_digital');
        $arc_leer_archivos_historial_clinico_fisico = session('arc_leer_archivos_historial_clinico_fisico');
        $arc_escribir_archivos_historial_clinico_digital = session('arc_escribir_archivos_historial_clinico_digital');
        $arc_ver_archivos_historial_clinico_fisico = session('arc_ver_archivos_historial_clinico_fisico');
        $arc_subir_archivos_historial_clinico_fisico = session('arc_subir_archivos_historial_clinico_fisico');
        $arc_escribir_archivos_historial_clinico_fisico = session('arc_escribir_archivos_historial_clinico_fisico');
        $arc_leer_otros_archivos = session('arc_leer_otros_archivos');
        $arc_escribir_otros_archivos = session('arc_escribir_otros_archivos');
        $paciente = collect(\DB::select("
            select 
            fp.id,
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
            domicilio, telefono, 
            concat(substr(identidad,1,4),'-',substr(identidad,5,4),'-',substr(identidad,9,5)) identidad,  
            ds.nombre_espanol||', '||to_char( current_date ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(current_date,'yyyy') fecha,
            to_char(current_timestamp, 'HH12:MI AM') hora
            from reg_ficha_pacientes fp
            where fp.deleted_at is null
            and fp.id = :id_paciente
        ", ["id_paciente" => $id_paciente]))->first();

        return view("archivos.archivos_historial")
                ->with("paciente", $paciente)->with("lab_leer_examen", $lab_leer_examen)
                ->with("arc_leer_archivos_historial_clinico_digital", $arc_leer_archivos_historial_clinico_digital)
                ->with("arc_leer_archivos_historial_clinico_fisico", $arc_leer_archivos_historial_clinico_fisico)
                ->with("arc_escribir_archivos_historial_clinico_digital", $arc_escribir_archivos_historial_clinico_digital)
                ->with("arc_escribir_archivos_historial_clinico_fisico", $arc_escribir_archivos_historial_clinico_fisico)
                ->with("arc_ver_archivos_historial_clinico_fisico", $arc_ver_archivos_historial_clinico_fisico)
                ->with("arc_subir_archivos_historial_clinico_fisico", $arc_subir_archivos_historial_clinico_fisico)
                ->with("arc_leer_otros_archivos", $arc_leer_otros_archivos)
                ->with("arc_escribir_otros_archivos", $arc_escribir_otros_archivos)
                ;
    }

    public function historial_clinico($id_paciente){
        $historial_clincico = DB::select("
        select r.id, r.id_paciente, r.id_area, 
        to_char(r.created_at,'TMDay')||', '||to_char( r.created_at ,'dd')||' de '||to_char(r.created_at,'TMMonth')||' de '||to_char(r.created_at,'yyyy') fecha, 
        ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
        ac.nombre area, concat(p.primer_nombre,' ', p.primer_apellido) medico from tbl_remisiones r
        join tbl_areas_clinica ac on r.id_area = ac.id
        join per_empleado p on r.id_medico = p.id
        join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
        join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
        where r.id_paciente = :id_paciente /*and r.id_estado_remision = 5 and r.id_estado_remision not in (1,2)*/ 
        and r.deleted_at is null
        order by r.created_at desc
        ", ["id_paciente" => $id_paciente]);

        return response()->json(['data' => $historial_clincico]);
    }

    public function historial_clinico_fisico($id_paciente){
        $historial_clinico_fisicos = DB::select("SELECT hcf.id, rfp.id as id_paciente, hcf.expediente_fisico, hcf.url_expediente_fisico, hcf.created_at fecha_creacion from public.reg_ficha_pacientes rfp
        left join tbl_historial_clinico_fisico hcf on rfp.id = hcf.id_paciente
        where rfp.id = :id_paciente and hcf.deleted_at is null and rfp.deleted_at is null
        and hcf.id is not null
        ", ["id_paciente" => $id_paciente]);

        return response()->json(['data' => $historial_clinico_fisicos]);
    }

    public function ver_expdiente($id_paciente, $id_remision, $id_expediente){

        $estado_edicion = collect(\DB::select("
            SELECT
            case 
            when ((now() at time zone 'CST') - r.created_at) <= '24 hour' then 1 
            when r.id_estado_remision = 3 then 1 
            else 0 
            end estado_edicion, r.id_estado_remision, er.nombre estado
            from public.tbl_remisiones r
            join tbl_estados_remisiones er on r.id_estado_remision = er.id
            where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

        //Inicia Expediente pediátrico
        if($id_expediente == 2){

            $estado_edicion_subsiguiente = collect(\DB::select("
                SELECT
                case 
                when ((now() at time zone 'CST') - p.created_at) <= '24 hour' and r.id = p.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_pediatrico p on r.id = p.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            $id_user = Auth()->id();

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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            extract(YEAR FROM age(now()::DATE ,fecha_nacimiento::DATE))*12 + extract(MONTH FROM age (to_char((now() at time zone 'CST'), 'YYYY/MM/DD')::DATE, fecha_nacimiento::DATE)) meses
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
            and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

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
                select id_paciente, id_expediente, id_remision, nombre_madre, edad, id_tipo_sangre, enfermedades_durante_embarazo, 
                gestas, partos, cesarias, control_prenatal_ultimo_embarazo
                from tbl_ped_antecendentes_prenatales
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $natalicio = collect(\DB::select("
                select id_paciente, id_expediente, id_remision, lugar_nacimiento, apgar, 
                peso, talla, perimetro_cefalico, id_tipo_parto, complicaciones_parto
                from public.tbl_ped_natalicio 
                where deleted_at is null and
                id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision
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
            
            $hisotirial_percentil = collect(\DB::SELECT("
                    SELECT id_remision, edad, peso, altura
                        from pediatria.pd_percentiles_infantes
                    WHERE id_remision = :id_remision
            ", ["id_remision"=>$id_remision]))->first();

            return view("exp_pediatrico_historial")->with("id_remision", $id_remision)
                ->with("paciente" , $paciente)->with("receta", $receta)->with("tipos_sangre", $tipos_sangre)
                ->with("indice_masa_corporal", $indice_masa_corporal)->with("tipos_partos", $tipos_partos)
                ->with("signos_vitales", $signos_vitales)->with("estado_edicion", $estado_edicion)->with("estado_edicion_subsiguiente", $estado_edicion_subsiguiente)
                ->with("consulta_exp_pediatrico", $consulta_exp_pediatrico)->with("antecendentes_prenatales", $antecendentes_prenatales)
                ->with("natalicio", $natalicio)->with("desarrollo_psicomotor", $desarrollo_psicomotor)
                ->with("lactancia", $lactancia)->with("exa_fisico_diagnostico_indicaciones", $exa_fisico_diagnostico_indicaciones)
                ->with("consulta_exp_pediatrico_hea_mc", $consulta_exp_pediatrico_hea_mc)/*->with("lactancia_alimentacion_actual", $lactancia_alimentacion_actual)*/
                ->with("sub_siguiente", $sub_siguiente)
                ->with("medico", $medico)
                ->with("historial_percentil", $hisotirial_percentil)
                ->with("id_expediente" , $id_expediente)
                ->with("id_remision" , $id_remision)
                    ;
        }
        //Finaliza Expediente pediátrico

        if($id_expediente == 3){
            $id_user = Auth()->id();

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

            $estado_edicion_subsiguiente = collect(\DB::select("
            SELECT
            case 
            when ((now() at time zone 'CST') - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
            else 0 
            end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
            from public.tbl_remisiones r
            join tbl_estados_remisiones er on r.id_estado_remision = er.id
            left join tbl_mg_medicina_general g on r.id = g.id_remision
            where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            $id_user = Auth()->id();

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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
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
                where g.id_paciente = :id_paciente and g.deleted_at is null and g.id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

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
                    where id_paciente = :id_paciente and deleted_at is null  and id_remision = :id_remision
                ",["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();
                
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

            return view("exp_general_historial")
                ->with("paciente", $paciente)
                ->with("estado_edicion", $estado_edicion)
                ->with("signos_vitales", $signos_vitales)
                ->with("glasgow", $glasgow)
                ->with("estado_conciencia", $estado_conciencia)
                ->with("consulta_exp_general", $consulta_exp_general)
                ->with("receta", $receta)
                ->with("estado_edicion_subsiguiente", $estado_edicion_subsiguiente)
                ->with("medico", $medico)
                ->with("id_expediente" , $id_expediente)
                ->with("id_remision" , $id_remision)
                    ;
        }

        //Inicia Expediente ginecológico
        if($id_expediente == 1){
            $estado_edicion_subsiguiente = collect(\DB::select("
                SELECT
                case 
                when ((now() at time zone 'CST') - g.created_at) <= '24 hour' and r.id = g.id_remision  then 1 
                else 0 
                end estado_edicion_subsiguiente, r.id_estado_remision, er.nombre estado
                from public.tbl_remisiones r
                join tbl_estados_remisiones er on r.id_estado_remision = er.id
                left join tbl_exp_ginecologia g on r.id = g.id_remision
                where r.id_paciente = :id_paciente and r.id = :id_remision and r.deleted_at is null
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

            $id_user = Auth()->id();

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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
            and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

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

            $signos_vitales = collect(\DB::select("
                select id_masa_corporal, temperatura, presion_arterial, peso, talla, saturacion, frecuencia_cardiaca, frecuencia_respiratoria, glucometria 
                from tbl_signos_vitales
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();
                      
            $ginecologia_mc_hea = collect(\DB::select("
                SELECT motivo_cosulta, motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual
                FROM public.tbl_exp_ginecologia_mc_hea
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
            ",["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision]))->first();

            $ginecologia = collect(\DB::select("
                SELECT gestas, partos, cesareas, abortos, hijos_vivos, hijos_muertos, fecha_parto, atendido, fecha_ultima_mestruacion,  fum_desconoce,
                fecha_provable_parto, citologia, descripcion_planificacion_familiar, id_tipo_sangre, descripcion_vaginosis, 
                descripcion_infeccion_tracto_urinario, descripcion_prurito, descripcion_menarquia, edad_inicio_vida_sexual, 
                numero_parejas_sexuales, tipo_enfermedades_trasmision_sexual, vida_sexual_activa, tipo_antecendestes_personales_patologicos,
                afp, tipo_antecedentes_inmunoalergicos, habitos, tipos_antecedentes_hospitalarios_quirurgicos, motivo_cosulta,
                motivo_cosulta_semanas_gestionales, motivo_cosulta_examenes, nota_motivo_cosulta, historia_enfermedad_actual
                FROM public.tbl_exp_ginecologia
                where id_paciente = :id_paciente and id_expediente = :id_expediente and id_remision = :id_remision and deleted_at is null
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

                return view('exp_ginecologico_historial')->with("paciente" , $paciente)->with("medico", $medico)
                ->with("tipos_sangre", $tipos_sangre)->with("indice_masa_corporal", $indice_masa_corporal)
                ->with("estado_edicion", $estado_edicion)->with("signos_vitales", $signos_vitales)->with("estado_edicion_subsiguiente", $estado_edicion_subsiguiente)
                ->with("ginecologia", $ginecologia)->with("examen_fisico", $examen_fisico)->with("receta", $receta)
                ->with("sub_siguiente", $sub_siguiente)->with("ginecologia_mc_hea", $ginecologia_mc_hea)
                ->with("id_expediente" , $id_expediente)
                ->with("id_remision" , $id_remision)
                        ;
        }
        //Finaliza Expediente ginecológico

        
    }

    public function ver_examenes($id_paciente, $id_remision, $id_expediente){
        $lab_escribir_examen = session('lab_escribir_examen');
        $lab_ver_examen = session('lab_ver_examen');
        $lab_subir_examen = session('lab_subir_examen');
        
        if(session('lab_leer_examen')!='1'){
            return view('error');
        }
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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            ac.nombre area,
            TRIM(
                            COALESCE(TRIM(p.primer_nombre)||' ','')||
                            COALESCE(TRIM(p.primer_apellido||' '),'')
                    ) medico
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join tbl_areas_clinica ac ON ac.id = r.id_area
            join per_empleado p ON p.id = r.id_medico
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
            and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

        return view('historial_clinico.examenes_laboratorio')->with("paciente" , $paciente)->with("id_paciente", $id_paciente)
                ->with("id_remision", $id_remision)->with("id_expediente", $id_expediente)->with("lab_escribir_examen", $lab_escribir_examen)
                ->with("lab_ver_examen", $lab_ver_examen)
                ->with("lab_subir_examen", $lab_subir_examen);
    }

    public function ver_otros_archios($id_paciente, $id_remision, $id_expediente){
        $arc_escribir_otros_archivos = session('arc_escribir_otros_archivos');
        $arc_ver_otros_archivos = session('arc_ver_otros_archivos');
        $arc_subir_otros_archivos = session('arc_subir_otros_archivos');
        if(session('arc_leer_otros_archivos')!='1'){
            return view('error');
        }
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
            ds.nombre_espanol||', '||to_char( r.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(r.created_at,'yyyy') fecha,
            to_char(r.created_at, 'HH12:MI AM') hora,
            ac.nombre area,
            TRIM(
                            COALESCE(TRIM(p.primer_nombre)||' ','')||
                            COALESCE(TRIM(p.primer_apellido||' '),'')
                    ) medico
            from reg_ficha_pacientes rfp 
            join tbl_remisiones r on rfp.id = r.id_paciente
            join tbl_areas_clinica ac ON ac.id = r.id_area
            join per_empleado p ON p.id = r.id_medico
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( r.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(r.created_at::date,'D')
            where rfp.deleted_at is null and r.deleted_at is null
                    and rfp.id = :id_paciente and r.id = :id_remision
            ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision]))->first();

        return view('archivos.archivos_otros')->with("paciente" , $paciente)->with("id_paciente", $id_paciente)
                ->with("id_remision", $id_remision)->with("id_expediente", $id_expediente)->with("arc_escribir_otros_archivos", $arc_escribir_otros_archivos)
                ->with("arc_ver_otros_archivos", $arc_ver_otros_archivos)
                ->with("arc_subir_otros_archivos", $arc_subir_otros_archivos);
    }

    public function historial_examenes_laboratorio($id_paciente, $id_remision, $id_expediente){
        $examenes = DB::select("
            SELECT tl.id, id_paciente, id_expediente, id_remision, examen_laboratorio, url_pdf, 
            ds.nombre_espanol||', '||to_char( tl.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(tl.created_at,'yyyy') fecha
            FROM public.tbl_laboratorio tl
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( tl.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(tl.created_at::date,'D')
            where tl.deleted_at is null and
            id_paciente = :id_paciente and id_remision = :id_remision and id_expediente = :id_expediente
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision, "id_expediente" => $id_expediente]);

        return response()->json(['data' => $examenes]);
    }

    public function historial_otros_archivos($id_paciente, $id_remision, $id_expediente){
        $examenes = DB::select("
            SELECT oa.id, id_paciente, id_expediente, id_remision, descripcion_archivo, url_archivo, 
            ds.nombre_espanol||', '||to_char( oa.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(oa.created_at,'yyyy') fecha
            FROM public.tbl_otros_archivos oa
            join cat_meses_anio ma on ma.id_mes_bd::int = to_char( oa.created_at::date,'MM')::int
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(oa.created_at::date,'D')
            where oa.deleted_at is null and
            id_paciente = :id_paciente and id_remision = :id_remision and id_expediente = :id_expediente
        ", ["id_paciente" => $id_paciente, "id_remision" => $id_remision, "id_expediente" => $id_expediente]);

        return response()->json(['data' => $examenes]);
    }

    public function descargar_archivo($archivo){
        //$fileName = basename('archivo_1152_1667065694.jpeg');
        //$file="";
        //$file= public_path(). "/archivos/".$archivo;
        $file= "/home/shfnuaro/public_html/archivos/".$archivo;
        return Response::download($file);
    }

    public function subir_examenes(Request $request){
        $descripcion_examen = $request->descripcion_examen;
        $id_paciente = $request->id_paciente;
        $id_remision = $request->id_remision;
        $id_expediente = $request->id_expediente;

        
            if($request->hasFile("input_archivo")){
                $file=$request->file("input_archivo");
                
                // $nombre = "examen_".time().".".$file->guessExtension();
                $nombre_archivo = "examen_".$id_paciente.$id_remision.$id_expediente."_".time().".".$file->guessExtension();

                //$ruta = public_path("pdf/examenes_laboratorio/".$nombre_archivo);
                $ruta = "/home/shfnuaro/public_html/pdf/examenes_laboratorio/".$nombre_archivo;

                if($file->guessExtension()=="pdf"){
                    copy($file, $ruta);
                            
                    DB::select("
                    INSERT INTO public.tbl_laboratorio(
                        id_paciente, id_expediente, id_remision, examen_laboratorio, url_pdf, created_at)
                        VALUES (:id_paciente, :id_expediente, :id_remision, :examen_laboratorio, :nombre_archivo, (now() at time zone 'CST'));
                    ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                    "examen_laboratorio" =>  $descripcion_examen, "nombre_archivo" =>  $nombre_archivo]);
                }else{
                    dd("NO ES UN PDF");
                }

            }
        

        return redirect()->back();
       // throw new Exception($descripcion_examen);
    }

    public function subir_otros_archivos(Request $request){
        $descripcion_archivo = $request->descripcion_archivo;
        $id_paciente = $request->id_paciente;
        $id_remision = $request->id_remision;
        $id_expediente = $request->id_expediente;

        
            if($request->hasFile("input_archivo")){
                $file=$request->file("input_archivo");
                
                // $nombre = "examen_".time().".".$file->guessExtension();
                $nombre_archivo = "archivo_".$id_paciente.$id_remision.$id_expediente."_".time().".".$file->guessExtension();

                //$ruta = public_path("archivos/".$nombre_archivo);
                $ruta = "/home/shfnuaro/public_html/archivos/".$nombre_archivo;
                //if($file->guessExtension()=="pdf"){
                    copy($file, $ruta);
                            
                    DB::select("
                    INSERT INTO public.tbl_otros_archivos(
                        id_paciente, id_expediente, id_remision, descripcion_archivo, url_archivo, created_at)
                        VALUES (:id_paciente, :id_expediente, :id_remision, :descripcion_archivo, :nombre_archivo, (now() at time zone 'CST'));
                    ", ["id_paciente" => $id_paciente, "id_expediente" => $id_expediente, "id_remision" => $id_remision, 
                    "descripcion_archivo" =>  $descripcion_archivo, "nombre_archivo" =>  $nombre_archivo]);
                //}else{
                    //dd("NO ES UN PDF");
                //}

            }
        

        return redirect()->back();
       // throw new Exception($descripcion_examen);
    }

    public function eliminar_examenes($id_examen){
    

            $nombre_archivo = collect(\DB::select("
                SELECT url_pdf
                FROM public.tbl_laboratorio
                where id = :id 
            ", ["id" => $id_examen]))->first();

            File::delete('pdf/examenes_laboratorio/'.$nombre_archivo->url_pdf);

            DB::select("
            UPDATE public.tbl_laboratorio
            SET deleted_at=(now() at time zone 'CST')
            WHERE id = :id
            ", ["id" => $id_examen]);
    

        return redirect()->back();
    }

    public function eliminar_otros_archivos($id_archivo){
    

        $nombre_archivo = collect(\DB::select("
            SELECT url_archivo
            FROM public.tbl_otros_archivos
            where id = :id 
        ", ["id" => $id_archivo]))->first();

        File::delete('archivos/'.$nombre_archivo->url_archivo);

        DB::select("
        UPDATE public.tbl_otros_archivos
        SET deleted_at=(now() at time zone 'CST')
        WHERE id = :id
        ", ["id" => $id_archivo]);


    return redirect()->back();
}

    public function subir_historial_clinico_fisico(Request $request){
        $descripcion_examen = $request->descripcion_examen;
        $paciente = $request->id_paciente;
        
            if($request->hasFile("input_archivo")){
                $file=$request->file("input_archivo");
                
                // $nombre = "examen_".time().".".$file->guessExtension();
                $nombre_archivo = "expediente_fisico_".$paciente."_".time().".".$file->guessExtension();

                //$ruta = public_path("pdf/expediente_fisico/".$nombre_archivo);
                $ruta = "/home/shfnuaro/public_html/pdf/expediente_fisico/".$nombre_archivo;
                if($file->guessExtension()=="pdf"){
                    copy($file, $ruta);
                            
                    DB::select("
                    INSERT INTO public.tbl_historial_clinico_fisico(
                        id_paciente, expediente_fisico, url_expediente_fisico, created_at)
                        VALUES (:id_paciente, :examen_fisico, :nombre_archivo, (now() at time zone 'CST'));
                    ", ["id_paciente" => $paciente, "examen_fisico" =>  $descripcion_examen, "nombre_archivo" =>  $nombre_archivo]);
                }else{
                    dd("NO ES UN PDF");
                }

            }       

        return redirect()->back();
       // throw new Exception($descripcion_examen);
    }

    public function eliminar_expediente_fisico($id_examen){
       // throw new Exception($id_examen);
            $nombre_archivo = collect(\DB::select("SELECT url_expediente_fisico 
                    from tbl_historial_clinico_fisico
                    where id = :id 	
                    ", ["id" => $id_examen]))->first();

            
            //throw new Exception($nombre_archivo);
            File::delete('pdf/expediente_fisico/'.$nombre_archivo->url_expediente_fisico);
            
            DB::select("
            UPDATE public.tbl_historial_clinico_fisico
            SET deleted_at=(now() at time zone 'CST')
            WHERE id = :id
            ", ["id" => $id_examen]);

        return redirect()->back();
    }
    
    public function ver_tbl_remisiones( $id_paciente ) {
        $paciente_list = DB::select("select id, TRIM(COALESCE(TRIM(primer_nombre)||' ','')||COALESCE(TRIM(segundo_nombre)||' ','')||COALESCE(TRIM(primer_apellido)||' ','')||
            COALESCE(TRIM(segundo_apellido||' '),'') ) as nombre_paciente 
            from public.reg_ficha_pacientes where deleted_at is null");
        $medico_list = DB::select("select id, TRIM(COALESCE(TRIM(primer_nombre)||' ','')||COALESCE(TRIM(segundo_nombre)||' ','')||COALESCE(TRIM(primer_apellido)||' ','')||
            COALESCE(TRIM(segundo_apellido||' '),'') ) nombre_medico 
            from public.per_empleado where deleted_at is null and id_cargo not in ( 1, 3 )");
        $area_list = DB::select("select id, nombre from public.tbl_areas_clinica where deleted_at is null");
        $estado_remision_list = DB::select("select id, nombre from public.tbl_estados_remisiones where deleted_at is null");
        $tbl_remisiones_list = DB::select("
            select tr.id, tr.id_paciente, TRIM(COALESCE(TRIM(fp.primer_nombre)||' ','')||COALESCE(TRIM(fp.segundo_nombre)||' ','')||COALESCE(TRIM(fp.primer_apellido)||' ','')||
            COALESCE(TRIM(fp.segundo_apellido||' '),'') ) as paciente, tr.id_medico, TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||
            COALESCE(TRIM(pe.primer_apellido)||' ','')||COALESCE(TRIM(pe.segundo_apellido||' '),'') ) as medico, tr.id_area, ac.nombre area, tr.id_estado_remision,
            er.nombre estado_remision
            from public.tbl_remisiones tr
            join tbl_areas_clinica ac on tr.id_area = ac.id
            join tbl_estados_remisiones er on tr.id_estado_remision = er.id
            join per_empleado pe on tr.id_medico = pe.id
            join reg_ficha_pacientes fp on tr.id_paciente = fp.id
            where tr.deleted_at is null and tr.id_paciente = :id_paciente
            order by 1 desc",[
                'id_paciente'=>$id_paciente
            ]);
        
        return view("pacientes.remisiones")->with("tbl_remisiones_list", $tbl_remisiones_list)
        ->with("paciente_list", $paciente_list)
        ->with("medico_list", $medico_list)
        ->with("area_list", $area_list)
        ->with("estado_remision_list", $estado_remision_list)
        ->with("id_paciente", $id_paciente)
        ;
   }

   public function guardar_tbl_remisiones(Request $request) {
        $id=$request->id;
        $id_paciente=$request->id_paciente;
        $id_medico=$request->id_medico;
        $id_area=$request->id_area;
        $id_estado_remision=$request->id_estado_remision;
        $msgError=null;
        $msgSuccess=null;
        $accion=$request->accion;
        $tbl_remisiones_list=null;
        
        if($id==null && $accion==2){
            $accion=1;
        }
        
    try{ 

        if($accion==1){
        $sql_tbl_remisiones = DB::select("insert INTO public.tbl_remisiones (
        id_area,id_estado_remision,id_medico,id_paciente
        , created_at) values (
        :id_area,:id_estado_remision,:id_medico,:id_paciente
        , (now() at time zone 'CST') )
        RETURNING  id
        ", ['id_area'=>$id_area,'id_estado_remision'=>$id_estado_remision,'id_medico'=>$id_medico,'id_paciente'=>$id_paciente
        ]
        );
        
        foreach($sql_tbl_remisiones as $r){
        $id=$r->id;
        }
        
        $msgSuccess="Registro creado con el código: ".$id;
        
        }else if($accion==2){
            
        $sql_tbl_remisiones = DB::select("update public.tbl_remisiones set  updated_at = (now() at time zone 'CST'),
        id_area=:id_area,id_estado_remision=:id_estado_remision,id_medico=:id_medico,id_paciente=:id_paciente
        where id=:id"
        , ['id'=>$id,'id_area'=>$id_area,'id_estado_remision'=>$id_estado_remision,'id_medico'=>$id_medico,'id_paciente'=>$id_paciente]
        );
        
        $msgSuccess="Registro ".$id." actualizado";

        }else if($accion==3){

        $sql_tbl_remisiones = DB::select("update public.tbl_remisiones set deleted_at=(now() at time zone 'CST') where
            id=:id
        "
        , ['id'=>$id]
        );
        
        $msgSuccess="Registro ".$id." eliminado";

        }else{
            $msgError="Accion invalida";
        }
                
        if($msgError==null){
            $tbl_remisiones_list = DB::select("select * from (
                   select tr.id, tr.id_paciente, TRIM(COALESCE(TRIM(fp.primer_nombre)||' ','')||COALESCE(TRIM(fp.segundo_nombre)||' ','')||COALESCE(TRIM(fp.primer_apellido)||' ','')||
                   COALESCE(TRIM(fp.segundo_apellido||' '),'') ) as paciente, tr.id_medico, TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||
                   COALESCE(TRIM(pe.primer_apellido)||' ','')||COALESCE(TRIM(pe.segundo_apellido||' '),'') ) as medico, tr.id_area, ac.nombre area, tr.id_estado_remision,
                   er.nombre estado_remision
                   from public.tbl_remisiones tr
                   join tbl_areas_clinica ac on tr.id_area = ac.id
                   join tbl_estados_remisiones er on tr.id_estado_remision = er.id
                   join per_empleado pe on tr.id_medico = pe.id
                   join reg_ficha_pacientes fp on tr.id_paciente = fp.id
                   where tr.deleted_at is null
                   order by 1 desc
            ) x where id=:id
            ",[
                 "id"=>$id
            ]);
        }
    }catch (Exception $e){
        $msgError=$e->getMessage();
    }
            
    return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "tbl_remisiones_list"=>$tbl_remisiones_list]);
   }
   
    public function guardar_remisiones_estado(Request $request){
        
        $id = $request->id;
        $accion = $request->accion;
        $sql_update_tbl_remisiones = null;
        $msgError=null;
        $msgSuccess=null;
       
        try {
            
            if( $accion == 1){
                
            }else if( $accion == 2 ){
                $sql_update_tbl_remisiones = DB::select("update public.tbl_remisiones set id_estado_remision = :estado_remision where id = :id",
                    [
                        'estado_remision'=>$this->ESTADO_PROCESO_REMISIONES,
                        'id'=>$id
                    ]);
                
                $msgSuccess="Cargando Expediente...";
            }else{
                $msgError="Acción invalida";
            }
                
            if($msgError==null){
                $tbl_remisiones_list = DB::select("select * from (
                    select tr.id, tr.id_paciente, TRIM(COALESCE(TRIM(fp.primer_nombre)||' ','')||COALESCE(TRIM(fp.segundo_nombre)||' ','')||COALESCE(TRIM(fp.primer_apellido)||' ','')||
                    COALESCE(TRIM(fp.segundo_apellido||' '),'') ) as paciente, tr.id_medico, TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||
                    COALESCE(TRIM(pe.primer_apellido)||' ','')||COALESCE(TRIM(pe.segundo_apellido||' '),'') ) as medico, tr.id_area, ac.nombre area, tr.id_estado_remision,
                    er.nombre estado_remision,
                    case when tr.id_area = :area_ginecologia then '/exp/ginecologico/paciente/'||tr.id_paciente
                        when tr.id_area = :area_pediatria then '/exp/pediatrico/paciente/'||tr.id_paciente 
                        when tr.id_area = :area_medicina_general then '/exp/general/id_remision/'||tr.id||'/paciente/'||tr.id_paciente
                    else '' end as expediente
                    from public.tbl_remisiones tr
                    join tbl_areas_clinica ac on tr.id_area = ac.id
                    join tbl_estados_remisiones er on tr.id_estado_remision = er.id
                    join per_empleado pe on tr.id_medico = pe.id
                    join reg_ficha_pacientes fp on tr.id_paciente = fp.id
                    where tr.deleted_at is null        
                    order by 1 desc
                ) x where id=:id
                ",[
                     "id"=>$id,
                     "area_ginecologia"=> $this->AREA_GINECOLOGIA,
                     "area_pediatria"=> $this->AREA_PEDIATRIA,
                     "area_medicina_general"=> $this->AREA_MEDICINA_GENERAL
                ]);
            }

        } catch (Exception $e) {
            $msgError=$e->getMessage();
        }
        
        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "tbl_remisiones_list"=>$tbl_remisiones_list]);
       
    }

}
