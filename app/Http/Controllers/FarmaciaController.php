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

class FarmaciaController extends Controller
{
    public function ver_recetas(){
        if(session('far_leer_recetas')!='1'){
            return view('error');
        }

        $far_escribir_recetas = session('far_escribir_recetas');
        return view('farmacia.far_recetas')->with("far_escribir_recetas", $far_escribir_recetas);
    }

    public function lista_recetas(){

        $recetas = DB::select("
        select rm.id,
        to_char(rm.created_at,'TMDay')||', '||to_char( rm.created_at ,'dd')||' de '||to_char(rm.created_at,'TMMonth')||' de '||to_char(rm.created_at,'yyyy') fecha,
        concat(fp.primer_nombre,' ',fp.segundo_nombre,' ',fp.primer_apellido,' ',fp.segundo_apellido) paciente, ac.nombre area,
        concat(p.primer_nombre,' ', p.primer_apellido) medico, rm.descripcion_receta
        from tbl_receta_medica rm
        join reg_ficha_pacientes fp on rm.id_paciente = fp.id
        join tbl_areas_clinica ac on rm.id_expediente = ac.id
        join per_empleado p on rm.id_medico = p.id
        where rm.atendido_farmacia is null and rm.deleted_at is null
        ");
        

        return response()->json(['data' => $recetas]);
    }

    public function lista_recetas_atendidas(){

        $recetas_atendidas = DB::select("
        select rm.id,
        ds.nombre_espanol||', '||to_char( rm.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(rm.created_at,'yyyy') fecha,
        concat(fp.primer_nombre,' ',fp.segundo_nombre,' ',fp.primer_apellido,' ',fp.segundo_apellido) paciente, ac.nombre area,
        concat(p.primer_nombre,' ', p.primer_apellido) medico, rm.descripcion_receta,
        concat(ds1.nombre_espanol||', '||to_char( rm.atendido_farmacia ,'dd')||' de '||ma1.nombre_espanol||' de '||to_char(rm.atendido_farmacia,'yyyy'),' ',
        to_char(rm.atendido_farmacia, 'HH12:MI AM')) hora_fecha_atendido
        from tbl_receta_medica rm
        join reg_ficha_pacientes fp on rm.id_paciente = fp.id
        join tbl_areas_clinica ac on rm.id_expediente = ac.id
        join per_empleado p on rm.id_medico = p.id
        join cat_meses_anio ma on ma.id_mes_bd = to_char( rm.created_at::date,'MM')
        join cat_dias_semana ds on ds.id_dia_bd::text = to_char(rm.created_at::date,'D')
        join cat_meses_anio ma1 on ma1.id_mes_bd = to_char( rm.atendido_farmacia::date,'MM')
        join cat_dias_semana ds1 on ds1.id_dia_bd::text = to_char(rm.atendido_farmacia::date,'D')
        where rm.atendido_farmacia is not null and rm.deleted_at is null
        ");
        

        return response()->json(['data' => $recetas_atendidas]);
    }

    public function ver_receta_unica(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $id_receta = $request->id_receta;

        $receta = collect(\DB::select("
            select rm.id,
            ds.nombre_espanol||', '||to_char( rm.created_at ,'dd')||' de '||ma.nombre_espanol||' de '||to_char(rm.created_at,'yyyy') fecha,
            concat(fp.primer_nombre,' ',fp.segundo_nombre,' ',fp.primer_apellido,' ',fp.segundo_apellido) paciente, 
            case 
                    when 
                            date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)) >1 
                    then 
                            concat(date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)),' años') 
                    else
                            concat(date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)),' año') 
            end edad_paciente,
            ac.nombre area,
            concat(p.primer_nombre,' ', p.primer_apellido) medico, c.nombre cargo, p.telefono, rm.descripcion_receta,
            rm.atendido_farmacia
            from tbl_receta_medica rm
            join reg_ficha_pacientes fp on rm.id_paciente = fp.id
            join tbl_areas_clinica ac on rm.id_expediente = ac.id
            join per_empleado p on rm.id_medico = p.id
            join tbl_cargos c on p.id_cargo = c.id
            join cat_dias_semana ds on ds.id_dia_bd::text = to_char(rm.created_at::date,'D')
            join cat_meses_anio ma on ma.id_mes_bd::integer = to_char( rm.created_at::date,'MM')::integer
            where rm.id = :id_receta and rm.deleted_at is null
        ", ["id_receta" => $id_receta]))->first();

        $msgSuccess = "Receta cargada exitosamente.";

        return response()->json(['receta' => $receta, 'msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }

    public function paciente_atendido_receta(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $id_receta = $request->id_receta;
        $checkboxPacienteAtendido = $request->checkboxPacienteAtendido;
        try{
            DB::select("
            update tbl_receta_medica set atendido_farmacia = 
                case when :checkboxPacienteAtendido = 1 then now() else null end 
            where id = :id_receta
            ", ["id_receta" => $id_receta, "checkboxPacienteAtendido" => $checkboxPacienteAtendido]);

            // $receta = collect(\DB::select("
            //     select rm.id,
            //     to_char(rm.created_at,'TMDay')||', '||to_char( rm.created_at ,'dd')||' de '||to_char(rm.created_at,'TMMonth')||' de '||to_char(rm.created_at,'yyyy') fecha,
            //     concat(fp.primer_nombre,' ',fp.segundo_nombre,' ',fp.primer_apellido,' ',fp.segundo_apellido) paciente, 
            //     case 
            //         when 
            //             date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)) >1 
            //         then 
            //             concat(date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)),' años') 
            //         else
            //             concat(date_part('year',age(CURRENT_DATE, fp.fecha_nacimiento)),' año') 
            //     end edad_paciente,
            //     ac.nombre area,
            //     concat(p.primer_nombre,' ', p.primer_apellido) medico, c.nombre cargo, p.telefono, rm.descripcion_receta
            //     from tbl_receta_medica rm
            //     join reg_ficha_pacientes fp on rm.id_paciente = fp.id
            //     join tbl_areas_clinica ac on rm.id_expediente = ac.id
            //     join per_empleado p on rm.id_medico = p.id
            //     join tbl_cargos c on p.id_cargo = c.id
            //     where rm.id = :id_receta and rm.deleted_at is null
            // ", ["id_receta" => $id_receta]))->first();

            $msgSuccess = "Receta editada exitosamente";

        }catch (Exception $e){
            $msgError=$e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }
}
