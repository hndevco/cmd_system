<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Auth;


class EmpleadoController extends Controller
{
    
    public $ESTADO_ESPERA_REMISIONES = 1;
    public $ESTADO_PROCESO_REMISIONES = 2;
    public $ESTADO_OBSERVACION_REMISIONES = 3;
    public $ESTADO_RETIRO_REMISIONES = 4;
    public $ESTADO_FINALIZO_REMISIONES = 5;
    
    public function ver_users() {
    
        $users_list = DB::select("select id, username as usuario,email,password,updated_at
        from public.users
        order by 1 desc");

        return view("configuraciones.registrar")->with("users_list", $users_list);

    }

    public function guardar_users(Request $request) {
        $id=$request->id;
        $usuario=$request->usuario;
        $email=$request->email;
        $passwordPlana=$request->password;
        $password = Hash::make($passwordPlana);
        $resetpassword = $request->resetpassword;
        $msgError=null;
        $msgSuccess=null;
        $accion=$request->accion;
        $users_list=null;
        if($id==null && $accion==2){
                    $accion=1;
                }
        try{ 

        if($accion==1){
        $sql_users = DB::select("insert INTO public.users (email,name,password, created_at) values (
        :email,:usuario,:password, now() )
        RETURNING  id", ['email'=>$email,'usuario'=>$usuario,'password'=>$password
        ]);

        foreach($sql_users as $r){
            $id=$r->id;
        }

        $msgSuccess="Registro creado con el código: ".$id;

        }else if($accion==2){

            if($resetpassword == '1'){
                $sql_users = DB::select("update public.users set updated_at = now(),
                email=:email,name=:usuario,password=:password
                where id=:id
                ", ['email'=>$email,'id'=>$id,'usuario'=>$usuario,'password'=>$password]);
            }else{
                $sql_users = DB::select("update public.users set updated_at = now(),
                email=:email,name=:usuario
                where id=:id
                ", ['email'=>$email,'id'=>$id,'usuario'=>$usuario]);
            }



        $msgSuccess="Registro ".$id." actualizado";

        }else if($accion==3){

        $sql_users = DB::select("update public.users set deleted_at=now() where
        id=:id", ['id'=>$id]);

        $msgSuccess="Registro ".$id." eliminado";

        }else if($accion==4){

        $sql_users = DB::select("update public.users set deleted_at=null where
        id=:id", ['id'=>$id]);

        $msgSuccess="Registro ".$id." eliminado";

        }else{
            $msgError="Accion invalida";
        }

        if($msgError==null){

        $users_list = DB::select("select * from (
        select id, username as usuario,email,password,updated_at
        from public.users
        order by 1 desc) x where id=:id
        ",["id"=>$id]);

        }

        }catch (Exception $e){
            $msgError=$e->getMessage();
        }

        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "users_list"=>$users_list]);
    }
    
    public function ver_per_empleado() {
        
        if(session('ventana_configuracion_empleado')!='1'){
            return view('error');
        }
        
        $per_empleado_list = DB::select("
        select pe.id,identidad,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,domicilio,telefono,
        correo, pe.id_cargo, tc.nombre cargo, pe.id_pais, tp.nombre pais,
        case when pe.deleted_at is not null then 'Activo' else '' end deleted_at, id_usuario
        from per_empleado pe 
        left join tbl_cargos tc ON tc.id = pe.id_cargo
        join tbl_paises tp ON tp.id = pe.id_pais
        order by 1 desc");
        
        $tbl_cargos_list = DB::select("
        select id, nombre as cargo from tbl_cargos
        where deleted_at is null
        order by 2 desc");
        
        $tbl_paises_list = DB::select("
        select id, nombre as pais from tbl_paises
        where deleted_at is null
        order by 2 desc");

        return view("configuraciones.empleado")
                ->with("tbl_paises_list", $tbl_paises_list)
                ->with("tbl_cargos_list", $tbl_cargos_list)
                ->with("per_empleado_list", $per_empleado_list);

    }

    public function guardar_per_empleado(Request $request) {
        $id=$request->id;
        $id_usuario=null;
        $identidad=$request->identidad;
        $primer_nombre=$request->primer_nombre;
        $segundo_nombre=$request->segundo_nombre;
        $primer_apellido=$request->primer_apellido;
        $segundo_apellido=$request->segundo_apellido;
        $domicilio=$request->domicilio;
        $telefono=$request->telefono;
        $id_cargo=$request->id_cargo;
        $id_pais=$request->id_pais;
        $deleted_at=$request->deleted_at;
        $password = '$2y$10$Ejm5dHOBuR7licPYpUz1Cu961gl/ZuL4/IMy7KM4u/RnpXYxC8zSa';
        $msgError=null;
        $msgSuccess=null;
        $accion=$request->accion;
        $correo=$request->correo;
        $per_empleado_list=null;
        $sql_users =null;
        $sql_per_empleado =null;
        $empleado_existe = null;
        $empleado_existe_permitido = 1;
        if($id==null && $accion==2){
                    $accion=1;
                }
        try{ 

        if($accion==1){
            
            $sql_per_empleado_existente =collect( DB::select("select count(1) empleado_existe from per_empleado where identidad = :identidad",['identidad'=>$identidad]) )->first();

            $empleado_existe = intval(isset($sql_per_empleado_existente->empleado_existe) ? $sql_per_empleado_existente->empleado_existe : null);
            
            if( $empleado_existe !=  $empleado_existe_permitido){
                $sql_users = DB::select("insert INTO public.users (email,username,password, created_at, name, forzar_cambio_contrasenia)
                select x.email::text, x.username::text, x.password::text, x.created_at, x.name::text, true::bool forzar_cambio_contrasenia from (
                    select :email::text email, 
                    lower(substr(trim(:primer_nombre::text),1,1)||substr(coalesce(trim(:segundo_nombre::text),''),1,1)||trim(:primer_apellido::text)||substr(coalesce(trim(:segundo_apellido::text),''),1,1)||length(trim(:primer_nombre::text)||trim(:primer_apellido::text))) as username, 
                    :password::text as password, now() created_at,
                    TRIM(
                    COALESCE(TRIM(:primer_nombre::text)||' ','')||
                    COALESCE(TRIM(:segundo_nombre::text)||' ','')||
                    COALESCE(TRIM(:primer_apellido::text)||' ','')||
                    COALESCE(TRIM(:segundo_apellido::text||' '),'')
                    ) as name
                )x
                RETURNING id", 
                ['email'=>$correo,'password'=>$password,
                    'primer_apellido'=>$primer_apellido,'primer_nombre'=>$primer_nombre,
                    'segundo_apellido'=>$segundo_apellido,'segundo_nombre'=>$segundo_nombre
                ]);

                foreach($sql_users as $r){
                    $id_usuario=$r->id;
                }

                $sql_per_empleado = DB::select("insert INTO public.per_empleado (
                telefono,domicilio,identidad,primer_apellido,primer_nombre,segundo_apellido,segundo_nombre
                ,correo, id_usuario, created_at, id_cargo, id_pais) values (
                :telefono,:domicilio,:identidad,:primer_apellido,:primer_nombre,:segundo_apellido,:segundo_nombre
                ,:correo,:id_usuario, now(), :id_cargo, :id_pais )
                RETURNING  id
                ", ['telefono'=>$telefono,'domicilio'=>$domicilio,'identidad'=>$identidad,
                    'primer_apellido'=>$primer_apellido,'primer_nombre'=>$primer_nombre,
                    'segundo_apellido'=>$segundo_apellido,'segundo_nombre'=>$segundo_nombre,
                    'correo'=>$correo, 'id_usuario'=>$id_usuario, 'id_cargo'=>$id_cargo, 'id_pais'=>$id_pais
                ]
                );

                foreach($sql_per_empleado as $r){
                    $id=$r->id;
                }

                $msgSuccess="Registro creado con el código: ".$id;
            }else if( $empleado_existe ==  $empleado_existe_permitido ){
                $msgError="Registro duplicado, ya existe un empleado!";
            }
            
            
            
        }else if($accion==2){
        $sql_per_empleado = DB::select("update public.per_empleado set  updated_at = now(),
        telefono=:telefono,domicilio=:domicilio,identidad=:identidad,primer_apellido=:primer_apellido,
        primer_nombre=:primer_nombre,segundo_apellido=:segundo_apellido,segundo_nombre=:segundo_nombre,
        correo=:correo, id_cargo= :id_cargo, id_pais = :id_pais
        where id=:id
        "
        , ['telefono'=>$telefono,'domicilio'=>$domicilio,'id'=>$id,'identidad'=>$identidad,
            'primer_apellido'=>$primer_apellido,'primer_nombre'=>$primer_nombre,'segundo_apellido'=>$segundo_apellido,
            'segundo_nombre'=>$segundo_nombre, 'correo'=>$correo, 'id_cargo'=>$id_cargo, 'id_pais'=>$id_pais
            ]
        );
        $msgSuccess="Registro ".$id." actualizado";

        }else if($accion==3){

        $sql_per_empleado = DB::select("update public.per_empleado set deleted_at=now() where
        id=:id
        "
        , ['id'=>$id]
        );
        $msgSuccess="Registro ".$id." eliminado";

        }else if($accion==4){

        $sql_per_empleado = DB::select("update public.per_empleado set deleted_at=null where
        id=:id
        "
        , ['id'=>$id]
        );
        $msgSuccess="Registro ".$id." modificado";

        }else{
                        $msgError="Accion invalida";
                    }
        if($msgError==null){
        $per_empleado_list = DB::select("select * from (
        select pe.id,identidad,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,domicilio,telefono,
        correo, pe.id_cargo, tc.nombre cargo, pe.id_pais, tp.nombre pais,
        case when pe.deleted_at is not null then 'Desactivado' else '' end deleted_at, id_usuario
        from per_empleado pe 
        left join tbl_cargos tc ON tc.id = pe.id_cargo
        join tbl_paises tp ON tp.id = pe.id_pais
        order by 1 desc
        ) x where id=:id
        ",[
        "id"=>$id
        ]);
        }
        }catch (Exception $e){
                    $msgError=$e->getMessage();
                }
        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "per_empleado_list"=>$per_empleado_list]);
    }

    public function ver_seg_usuario_permisos(){

        $sql_users_permisos = DB::select("select up.id, up.id_usuario, u.username usuario, up.permiso, p.nombre permiso_usuario,
            case when up.deleted_at is not null then 'Desactivado' else '' end estado
            from seg_usuario_permisos up
            join users u on u.id = up.id_usuario
            join seg_permisos p on up.permiso = p.id
        order by 1 desc");

        $sql_permisos_list = DB::select("select id, nombre from seg_permisos");

        return view("configuraciones.perfil_usuario")        
        ->with("permisos_list",$sql_permisos_list)
        ->with("usuario_list",$sql_users_permisos);
    }

    public function guardar_seg_usuario_permisos(Request $request){

        $id=$request->id;
        $id_usuario=$request->id_usuario;
        $permiso=$request->permiso;
        $accion=$request->accion;
        $msgError= null;
        $msgSuccess=null;
        $sql_seg_usuario_permisos_list = null;
        $sql_seg_usuario_permisos=null;

        if($id==null && $accion==2){
            $accion=1;
        }

        try {
            if ($accion == 1) {
                               
                $sql_seg_usuario_permisos=DB::select("insert into seg_usuario_permisos(id_usuario,  permiso, created_at)
                with usuario_permiso as (
                        select :id_usuario::integer id_usuario , :permiso::integer permiso , (now() at time zone 'CST') created_at 
                )
                select id_usuario,  permiso, created_at from usuario_permiso
                where permiso not in (
                        select permiso from public.seg_usuario_permisos where id_usuario = :id_usuario::integer
                )
                returning id", 
                [   'id_usuario'=>$id_usuario,
                    'permiso'=>$permiso
                ]); 
                foreach($sql_seg_usuario_permisos as $up){
                    $id=$up->id;
                }
                $msgSuccess="Registro creado con el código: ".$id;

            }else if($accion==2){

            }else if($accion==3){
                $sql_seg_usuario_permisos=DB::select("update seg_usuario_permisos set deleted_at = (now() at time zone 'CST')                
                    where id = :id", 
                [
                    'id'=>$id
                ]); 
                
                $msgSuccess="Registro desactivado con el código: ".$id;

            }else if($accion==4){
                $sql_seg_usuario_permisos=DB::select('update seg_usuario_permisos set deleted_at = null               
                    where id = :id', 
                [
                    'id'=>$id
                ]); 
                
                $msgSuccess="Registro activado con el código: ".$id;
            }else{
                $msgError="Accion invalida";
            }

            if($msgError==null){
                $sql_seg_usuario_permisos_list = DB::select("select * from (
                    select up.id, up.id_usuario, u.username usuario, up.permiso, p.nombre permiso_usuario,
                    case when up.deleted_at is not null then 'Desactivado' else '' end estado
                    from seg_usuario_permisos up
                    join users u on u.id = up.id_usuario
                    join seg_permisos p on up.permiso = p.id
                    order by 1 desc
                    ) x where id=:id
                    ",[
                    "id"=>$id
                    ]);
            } 

        } catch (Exception $e){
            $msgError=$e->getMessage();
        }

        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "sql_seg_usuario_permisos_list"=>$sql_seg_usuario_permisos_list]);

    }

    public function ver_per_empleado_perfil_usuario( $id_usuario ){
        
        if(session('ventana_configuracion_usuario')!='1'){
            return view('error');
        }
        
        $sql_permisos_descripcion = db::select("select id, nombre as permiso, descripcion from public.seg_permisos
        where deleted_at is null
        order by id asc");
        
        $sql_users_permisos = DB::select("select up.id, up.id_usuario, u.username usuario, up.permiso, p.nombre permiso_usuario,
        case when up.deleted_at is not null then 'Desactivado' else '' end estado
        from seg_usuario_permisos up
        join users u on u.id = up.id_usuario
        join seg_permisos p on up.permiso = p.id
        where u.id = :id_usuario
        order by 1 desc",
        [
            'id_usuario'=>$id_usuario
        ]);
        
        $sql_user = DB::select("select pe.id,identidad,TRIM(COALESCE(TRIM(primer_nombre)||' ','')||COALESCE(TRIM(segundo_nombre)||' ','')||COALESCE(TRIM(primer_apellido)||' ','')||
        COALESCE(TRIM(segundo_apellido||' '),'') ) nombre_medico, tc.nombre cargo, u.username
        from per_empleado pe 
        join tbl_cargos tc ON tc.id = pe.id_cargo
        join tbl_paises tp ON tp.id = pe.id_pais
        join users u on u.id = pe.id_usuario
        where pe.id_usuario = :id_usuario
        order by 1 desc",
        [
            'id_usuario'=>$id_usuario
        ]);

        $sql_permisos_list = DB::select("select id, nombre from seg_permisos order by 2");

        return view("configuraciones.perfil_usuario")    
        ->with("permisos_list",$sql_permisos_list)
        ->with("usuario_permisos_list",$sql_users_permisos)
        ->with("id_usuario",$id_usuario)
        ->with("sql_user",$sql_user)
        ->with("sql_permisos_descripcion",$sql_permisos_descripcion)
        ;
    }
    
    public function guardar_seg_usuario_clave_reinicio(Request $request){

        $id=null;
        $id_usuario=$request->id_usuario;
        $msgError= null;
        $msgSuccess=null;       
        $password = '$2y$10$Ejm5dHOBuR7licPYpUz1Cu961gl/ZuL4/IMy7KM4u/RnpXYxC8zSa';
        
        try {
           

                $sql_seg_usuario_permisos=DB::select('update users set password = :password, forzar_cambio_contrasenia = true where id = :id_usuario', 
                [   'id_usuario'=>$id_usuario,
                    'password'=>$password
                ]); 
                
                $msgSuccess="Reinicio de clave exitosa";          
            
        } catch (Exception $e){
            $msgError=$e->getMessage();
        }
        
        if($msgError==null){
                
        }

        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError]);

    }
    
    public function ver_users_cambio_clave(){
        
        return view("configuraciones.perfilUsuarioCambioClave")          
        ;
    }
    
    public function guardar_users_cambio_clave(Request $request){

        $id_user = Auth::user()->id;    
        $clave_actual=$request->clave_actual;
        $clave_nueva=$request->clave_nueva;
        $clave_actual_encriptada = Hash::make($clave_actual);
        $clave_nueva_encriptada = Hash::make($clave_nueva);
        $clave_actual_coincide = null;
        $clave_nueva_coincide = null;
        $msgError= null;
        $msgSuccess=null;       
        
        
        try {
                $sql_users_actual = db::select('select count(1) clave_actual_coincide from users where password = :clave_actual_encriptada and id = :id_user',
                    [
                       'clave_actual_encriptada'=>$clave_actual_encriptada,
                       'id_user'=>$id_user
                    ]);
                
                $sql_users_nueva = db::select('select count(1) clave_nueva_coincide from users where password = :clave_nueva_encriptada and id = :id_user',
                    [
                       'clave_nueva_encriptada'=>$clave_nueva_encriptada,
                       'id_user'=>$id_user
                    ]);
                
                foreach ($sql_users_actual as $u) {
                    $clave_actual_coincide = $u->clave_actual_coincide;
                }
                
                foreach ($sql_users_nueva as $un) {
                    $clave_nueva_coincide = $un->clave_nueva_coincide;
                }

                if ($clave_actual_coincide == 0 && $clave_nueva_coincide == 0 ) {
                    //procede a actualizar
                    $sql_seg_usuario_permisos=DB::select('update users set password = :clave_nueva_encriptada, 
                            updated_at = now(), forzar_cambio_contrasenia = false where id = :id_user', 
                        [   'id_user'=>$id_user,
                            'clave_nueva_encriptada'=>$clave_nueva_encriptada
                        ]); 
                    
                }else if ( $clave_actual_coincide == 1 && $clave_nueva_coincide == 1 ){
                    $msgError="La clave actual no debe ser la misma que le clave anterior!";
                }        
               
             

        } catch (Exception $e){
            $msgError=$e->getMessage();
        }
        
        if($msgError==null){
            $msgSuccess="Cambio de clave exitosa!";
        }

        return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "clave_actual_encriptada"=>$clave_actual_encriptada]);

    }
    
    public function ver_medico_tbl_remisiones(){
        
        $id_usuario = Auth::user()->id;
                
        $medico_list = DB::select("select id, TRIM(COALESCE(TRIM(primer_nombre)||' ','')||COALESCE(TRIM(segundo_nombre)||' ','')||COALESCE(TRIM(primer_apellido)||' ','')||
            COALESCE(TRIM(segundo_apellido||' '),'') ) nombre_medico 
            from public.per_empleado 
            where deleted_at is null and id_cargo not in ( 1, 3 )");
        $area_list = DB::select("select id, nombre from public.tbl_areas_clinica where deleted_at is null");
        $estado_remision_list = DB::select("select id, nombre from public.tbl_estados_remisiones where deleted_at is null");
        $sql_sala_espera_remisiones = db::select("select tr.id, tr.id_paciente, TRIM(COALESCE(TRIM(fp.primer_nombre)||' ','')||COALESCE(TRIM(fp.segundo_nombre)||' ','')||COALESCE(TRIM(fp.primer_apellido)||' ','')||
        COALESCE(TRIM(fp.segundo_apellido||' '),'') ) as paciente, tr.id_medico, TRIM(COALESCE(TRIM(pe.primer_nombre)||' ','')||COALESCE(TRIM(pe.segundo_nombre)||' ','')||
        COALESCE(TRIM(pe.primer_apellido)||' ','')||COALESCE(TRIM(pe.segundo_apellido||' '),'') ) as medico, tr.id_area, ac.nombre area, 
        tr.id id_remision, tr.id_estado_remision,er.nombre estado_remision,
        case when tr.id_estado_remision in (:estado_remision_espera, :estado_remision_proceso) then '' else 'none' end atender_paciente,
        case when tr.id_estado_remision = :estado_remision_observacion then '' else 'none' end ver_expediente
        from public.tbl_remisiones tr
        join tbl_areas_clinica ac on tr.id_area = ac.id
        join tbl_estados_remisiones er on tr.id_estado_remision = er.id
        join per_empleado pe on tr.id_medico = pe.id
        join reg_ficha_pacientes fp on tr.id_paciente = fp.id
        where tr.deleted_at is null
        and pe.id_usuario = :id_usuario
        and tr.id_estado_remision in ( :estado_remision_espera, :estado_remision_proceso, :estado_remision_observacion )
        order by 1 desc",[
           'id_usuario'=>$id_usuario,
           'estado_remision_espera'=> $this->ESTADO_ESPERA_REMISIONES, 
           'estado_remision_proceso'=> $this->ESTADO_PROCESO_REMISIONES,
           'estado_remision_observacion'=> $this->ESTADO_OBSERVACION_REMISIONES
            
        ]);
        
        return view("empleados.medico.salaEsperaRemisiones")
        ->with("sql_sala_espera_remisiones",$sql_sala_espera_remisiones)        
        ->with("medico_list", $medico_list)
        ->with("area_list", $area_list)
        ->with("estado_remision_list", $estado_remision_list)
        ;
    }
    
}
