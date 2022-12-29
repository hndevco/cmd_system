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
    public function guardar_percentiles_infantes(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $msgWarning = null;
        $id_percentil = null;
        $id_remision =  $request->id_remision;
        $edad = floatval($request->edad);
        $peso = floatval($request->peso);
        $altura = floatval($request->altura);
        
        $sql_percentil = DB::SELECT("
            SELECT id from pediatria.pd_percentiles_infantes
            WHERE deleted_at is null AND id_remision = :id_remision 
        ", ["id_remision" =>$id_remision]);

        foreach($sql_percentil as $row){
            $id_percentil = $row->id;
        }
        
        //throw new Exception($id_percentil);
        
        try{
            if($id_percentil == null || $id_percentil = ''){
                $sql=DB::SELECT("
                    INSERT INTO pediatria.pd_percentiles_infantes
                        (id_remision, edad, peso, altura)
                    VALUES (:id_remision, :edad, :peso, :altura)
                ", ["id_remision"=>$id_remision, "edad"=>$edad, "peso"=>$peso, "altura"=>$altura]);
                $msgSuccess = "¡Los datos se han guardado correctamente!";
            }else{
            //throw new Exception($altura);
            $sql= DB::SELECT("
                    UPDATE pediatria.pd_percentiles_infantes
                        SET edad =:edad, peso =:peso, altura =:altura, updated_at = now()
                    WHERE id_remision = :id_remision  
                ",["id_remision" =>$id_remision, "edad"=>$edad, "peso"=>$peso, "altura"=>$altura]);
                
                $msgSuccess = "¡Los datos se han actualizado correctamente!";

            }
    
            
        }catch(Execption $e){
            
            $msgError=$e->getMessage();
        }

        return response()->json(["msgSuccess"=>$msgSuccess, "msgError"=>$msgError]);
    }
}
