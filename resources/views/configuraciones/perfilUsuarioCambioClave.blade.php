@extends ("layouts.menu")
@section("scriptsCSS")
@endsection
@section("content")
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">        
            <section class="content">                
                <!-- Default box -->
                <div class="card">
                    <div class="card-body">
                      <div class="jumbotron jumbotron-fluid" style="padding-bottom: 2%">
                          <div class="container">
                                <h1 class="display-4"><i class="nav-icon fas fa-regular fa-bell"></i><b>Cambio de Contraseña</b></h1>                                
                            </div>                           
                      </div>
                      <ol class="breadcrumb float-sm-left">
                      </ol>
                  </div>                    
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->                
            </section>
        
        <!-- /.content -->           
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    
          <!-- Default box -->
          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="nav-icon fas fa-hospital-user"></i>Contraseña
                </h3>
    
                <div class="card-tools">                    
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                    </button>                
                </div>                
            </div>
            <div class="card-body">
                <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group row">
                <div class="form-group col-6">
                    <label id="l-identidad" class="">Contraseña actual</label>
                        <div class="">
                            <input type="text" class="form-control" id="clave_actual" name="identidad">
                        </div>
                    </div>
                    
                <div class="form-group col-6">
                        <label id="l-primer_nombre" class="">Nueva Contraseña</label>
                        <div class="">
                            <input type="text" class="form-control" id="clave_nueva" name="primer_nombre">
                        </div>
                    </div>
                 </div>   
                    
                </form>
                
                <button type="button" id="btn_guardar_clave" class="btn btn-primary antosubmit2">Guardar</button>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              
            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
    
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section("scripts")
 
<script type="text/javascript">
var accion=null;
var id=null;
var clave_actual=null;
var clave_nueva=null;
var permiso=null;
var url_cambio_clave_usuario= "{{url('/configuraciones/usuario/cambio-calve')}}/guardar";
var table=null;
var rowNumber=null;


$(document).ready(function () {
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

$("#btn_guardar_clave").on( "click", function ( e ) {
    e.preventDefault();
    
    clave_actual=$("#clave_actual").val();
    clave_nueva=$("#clave_nueva").val();
    
    var valida = null;
    valida = evaluar( ['clave_actual' , 'clave_nueva' ] );
    
    if( valida ){
        preguardar_clave_usuario();
    }else{
        return false;
    }
    
    $( this ).prop( "disabled", true );
});

});


    function preguardar_clave_usuario() {
              
    var indexUploadCoincidence=0;

$.when(


      ).done(function (){
        guardar_clave_usuario();
      } )
      ;
    }
    
  
function guardar_clave_usuario(){
$.ajax({
type: "post",
url:url_cambio_clave_usuario,
data: {
 "clave_actual": clave_actual,
 "clave_nueva": clave_nueva,
 accion: accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";
textMsg=data.msgError;
typeMsg="error";

$("#btn_guardar_clave").prop( "disabled", false );

}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
console.log( data.clave_actual_encriptada );

$("#btn_guardar_clave").prop( "disabled", false );

}

new PNotify({
title: titleMsg,
text: textMsg,
type: typeMsg,
shadow: true
});

},
error: function (xhr, status, error) {
alert(xhr.responseText);
}
});
}

//realiza el despliegue de mensage de exito o erro
function evaluar ( id_elemento ) {
     
    for (var i = 0; i < id_elemento.length ; i++) {
        
        var valor_elemento = $("#"+id_elemento[ i ]+"").val();
    
        var label_elemento = $("#l-"+id_elemento[ i ]+"").text();
        console.log( id_elemento[ i ] )
        
        if( valor_elemento == null || valor_elemento == ''){

            new PNotify({
                title: 'Valor Requerido',
                text: 'Debe especificar un valor para '+label_elemento,
                type: 'error',
                shadow: true
            });
            
            $("#"+id_elemento[ i ]+"").addClass('is-invalid');
            
            return false;
        }else{
            $("#"+id_elemento[ i ]+"").removeClass('is-invalid');
            
        }
    }
    
    return true;
}
//finaliza
</script>
@endsection