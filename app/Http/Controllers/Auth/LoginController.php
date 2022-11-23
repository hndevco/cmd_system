<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = strtolower( request()->input('login') );
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }


 
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
        
    }

    public function authenticated(Request $request, $user){
        $username = Auth::user()->username;
        $cambio_contrasenia = Auth::user()->forzar_cambio_contrasenia;

        $user_permisos = DB::select('select p.nombre permiso, 
        case when up.deleted_at is null then true else false end estado_permiso,
        case when pe.deleted_at is not null then true else false end estado_empleado        
        from users u 
        join seg_usuario_permisos up on u.id = up.id_usuario
        join seg_permisos p on up.permiso = p.id
        join per_empleado pe on pe.id_usuario = u.id
        where lower( u.username ) = lower( :username )
            ', [
            'username'=>$username
        ]);

        foreach ($user_permisos as $up) {
            
            if( $up->estado_permiso ){
                Session::put($up->permiso, '1');                
            }
            
            if( $up->estado_empleado ){              
                Auth::logout();                               
                return redirect()->back()->with("error","Su cuenta ha sido deshabilitada temporalmente. Por favor intente contactarse con el departamento de administración.");
   
            }
                                    
        }
        
        if( $cambio_contrasenia ){
            return redirect('/configuraciones/usuario/cambio-calve');
            
        }


    }
}
