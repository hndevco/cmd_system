<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Exception;
use File;

class PediatriaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_data_percentiles_infantes_masculinos_estatura_edad(Request $request){
        $sql_percentil_infante_masculino = DB::SELECT("
            SELECT  
                pime.edad::text, 
                pime.quinto_percentil,
                pime.decimo_percentil,
                pime.vigecimo_quinto_percentil,
                pime.quincuagesimo_percentil,
                pime.septuagesimo_quinto_percentil,
                pime.nonagesimo_percentil,
                pime.nonagesimo_quinto_percentil
            FROM PEDIATRIA.pd_percentiles_infantes_masculinos_estatura_edad pime
            where
                pime.deleted_at is null and
                pime.edad in (0, 3.5, 6.5, 9.5, 12.5, 15.5, 18.5, 19.5, 21.5, 24.5, 27.5, 30.5, 33.5, 35.5)
            order by pime.edad asc");
            
        return response()->json(["sql_percentil_infante_masculino"=>$sql_percentil_infante_masculino]);
    }
}
