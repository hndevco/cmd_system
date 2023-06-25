<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session('dashboard_graficos')!='1'){
            return view('dashboardWelcome');
        }

        $pacientes_registrados_lista = DB::select("select count(1) numero_registros , to_char( fp.created_at::date, 'YYYY-MM') fecha_registra, ma.nombre_espanol mes_registro
        from public.reg_ficha_pacientes fp
        join public.cat_meses_anio ma on ma.id_mes_bd::integer = (to_char( fp.created_at::date,'MM'))::integer
        where fp.deleted_at is null
        group by 2, 3
        order by 2");
        
        $areas_atendidos_historico = db::select("select count(1) filter( where tr.id_area = 1 ) pediatria ,
        count(1) filter( where tr.id_area = 2 ) ginecologia,
        count(1) filter( where tr.id_area = 3 ) medicina_general 
        --to_char( tr.created_at, 'YYYY-MM') fecha_registra, to_char( tr.created_at, 'MM') mes_registro
        from public.tbl_remisiones tr 
        join tbl_areas_clinica ac on tr.id_area = ac.id
        where tr.deleted_at is null");
        
        $pacientes_genero_edad = db::select("select 
        count(1) filter( where upper(sexo) = 'F' and date_part('year', age(current_date, fecha_nacimiento) ) > 18  ) adultos_femeninos ,
        count(1) filter( where upper(sexo) = 'F' and date_part('year', age(current_date, fecha_nacimiento) ) < 18  ) ninos_femeninos,
        count(1) filter( where upper(sexo) = 'M' and date_part('year', age(current_date, fecha_nacimiento) ) > 18  ) adultos_masculinos ,
        count(1) filter( where upper(sexo) = 'M' and date_part('year', age(current_date, fecha_nacimiento) ) < 18  ) ninos_masculinos
        --to_char( created_at::date, 'YYYY-MM') fecha_registra, to_char( created_at::date, 'MM') mes_registro
        from public.reg_ficha_pacientes
        where deleted_at is null");
        
        $pacientes_region_procedencia = db::select("select count(1) pacientes, id_departamento, d.cod_departamento 
        from public.reg_ficha_pacientes fp
        join public.tbl_departamentos d ON d.id = fp.id_departamento
        where fp.deleted_at is null
        group by 2, 3");
        
        return view('dashboardHome')
            ->with("pacientes_registrados_lista", $pacientes_registrados_lista)
            ->with("areas_atendidos_historico", $areas_atendidos_historico)
            ->with("pacientes_genero_edad", $pacientes_genero_edad)
            ->with("pacientes_region_procedencia", $pacientes_region_procedencia);
    }
}
