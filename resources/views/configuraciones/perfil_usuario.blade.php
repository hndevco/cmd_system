@extends ("layouts.menu")
@section("scriptsCSS")
@endsection
@section("content")
<!-- Content Header (Page header) -->
<div class="content">
    <div class="container-fluid">        
                       
                <!-- Default box -->
                <div class="card text- left">
                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4"><i class="nav-icon fas fa-regular fa-user-lock"></i><b> Permisos - Empleado </b></h1>
                                @foreach($sql_user as $su)
                                <h2 class="lead">{{$su->nombre_medico}}</h2>
                                <h2 class="lead">{{$su->username}}</h2>
                                <p class="lead">{{$su->cargo}}</p>
                                @endforeach
                                <a class="btn btn-primary" title="Regresar" href="{{url('/empleado')}}" ><i class="fa fa-reply"></i> </a>&nbsp&nbsp
                            <a class="btn btn-warning" href="" id="btn_reiniciar_clave" ><i class="fa fa-lock"></i>Resetear Contraseña</a>
                            </div>                           
                        </div>
                    </div>                    
                  <!-- /.card-body -->
                </div>                
                <!-- /.card -->                
            
        
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
                    <i class="nav-icon fas fa-list"></i> Listado de Permisos
                </h3>
    
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                           <!--  <button type="button" id="btn_agregar_permisos" class="btn btn-success" data-toggle="modal"
                                data-target="#"><i class="fas fa-user-plus"></i> Agregar</button>-->
                            <button type="button" id="btn_permisos" class="btn btn-success" data-toggle="modal"
                                data-target="#"><i class="fas fa-user-plus"></i> Tabla de Permisos</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>  
                        </li>
                        
                    </ul>
                                  
              </div>
            </div>                                      
            <div class="card-body">
                <div class="table-responsive">
                    <table class="jambo_table table table-hover table-bordered" id="tbl_users">
                    <thead >
                    <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Permiso</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuario_permisos_list as $row)
                    <tr style="font-size: medium">
                    <td scope="row">{{$row->id}}</td>
                    <td scope="row">{{$row->usuario}}</td>
                    <td scope="row">{{$row->permiso_usuario}}</td>
                    <td scope="row">{{$row->estado}}</td>                    
                    <td>
                    
                    
                    &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permisos_users"
                    data-id="{{$row->id}}"
                    data-id_usuario="{{$row->id_usuario}}"
                    data-usuario="{{$row->usuario}}"
                    data-permiso="{{$row->permiso}}"
                    data-permiso_usuario="{{$row->permiso_usuario}}"
                    
                    ><i class="fa fa-trash"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_permisos_users"
                    data-id="{{$row->id}}"
                    data-id_usuario="{{$row->id_usuario}}"
                    data-usuario="{{$row->usuario}}"
                    data-permiso="{{$row->permiso}}"
                    data-permiso_usuario="{{$row->permiso_usuario}}"
                    ><i class="fa fa-check-circle"></i></button>
                    
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                    </div>
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

<div id="modal_permisos_users" class="modal fade"  role="dialog" aria-labelledby="modal_permisos_users" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cargar Permisos Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="antoform2" class="form-horizontal calender" role="form">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Permiso</label>
                    <div class="col-sm-9">
                        <select id="permiso" name="permiso" class="select2_single form-control country" >
                                                <option></option>
                                                @foreach ($permisos_list as $permisos)
                                                    <option value="{{$permisos->id}}">{{$permisos->nombre}}</option>
                                                @endforeach
                                            </select>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_guardar_permisos_users" class="btn btn-primary antosubmit2">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
<div id="modal_permisos" class="modal fade"  role="dialog" aria-labelledby="modal_permisos" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Lista de Permisos</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="jambo_table table table-hover table-bordered" id="tbl_permisos">
                    <thead >
                        <tr style="color: black; background-color: buttonhighlight; font-size: large    ">                   
                        <th scope="col">Permiso</th>
                        <th scope="col">Descripci&oacute;n</th>                    
                        <th scope="col">Acci&oacute;n</th>                    
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sql_permisos_descripcion as $row)
                        <tr style="font-size: medium">                    
                        <td scope="row">{{$row->permiso}}</td>
                        <td scope="row">{{$row->descripcion}}</td>                                        
                        <td scope="row">
                            <button id="btn_permisos_users" class="btn btn-success"
                                data-id_permiso="{{$row->id}}"
                                title='Agregar Permiso'                                       
                            ><i class="fa fa-plus-square"></i></button>
                        </td>                                        
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    </div>
            </div>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div id="modal_eliminar_permisos_users" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_permisos_users aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar Registro</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="antoform2" class="form-horizontal calender" role="form">

                <div class="form-group">
                    <label class="control-label" style="font-size: 20px">¿Seguro que desea eliminar este registro?</label>
                </div>

            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_eliminar_permisos_users" class="btn btn-danger antosubmit2">Eliminar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div id="modal_activar_permisos_users" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_activar_permisos_users aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Activar Registro</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="antoform2" class="form-horizontal calender" role="form">

                <div class="form-group">
                    <label class="control-label" style="font-size: 20px">¿Seguro que desea activar este registro?</label>
                </div>

            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_activar_permisos_users" class="btn btn-success antosubmit2">Activar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@endsection
@section("scripts")
 
<script type="text/javascript">
var accion=null;
var id=null;
var id_usuario=null;
var usuario=null;
var permiso=null;
var url_guardar_permisos_users= "{{url('/configuraciones/permisos')}}/guardar";
var url_reiniciar_clave_usuario= "{{url('/configuraciones/usuario/reinicio-clave')}}/guardar";
var table=null;
var table_permisos=null;
var rowNumber=null;
var id_usuario = {{ $id_usuario }}

$(document).ready(function () {
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        }); 
table=$("#tbl_users" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [

]
});
$('.dt-button').removeClass('dt-button');

table_permisos=$("#tbl_permisos" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [

]
});

$("#btn_agregar_permisos").on('click', function( e ){
    accion=1;
    $("#modal_permisos_users").modal("show");
});

$("#btn_permisos").on('click', function( e ){
    accion=1;
    $("#modal_permisos").modal("show");
});
 
$("#modal_permisos_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
permiso=triggerLink.data("permiso");

$("#id").val(id);
$("#permiso").val(permiso);

});
  
$("#modal_eliminar_permisos_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
permiso=triggerLink.data("permiso");

$("#id").val(id);
$("#permiso").val(permiso);
accion=3;
});
  
$("#modal_activar_permisos_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
permiso=triggerLink.data("permiso");

$("#id").val(id);
$("#permiso").val(permiso);
accion=4;
});
  
$("#tbl_users tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});

$("#btn_reiniciar_clave").on( "click", function ( e ) {
    e.preventDefault();
    
    reiniciar_clave_usuario();
    $( this ).prop( "disabled", true );
});
  
$(".modal-footer").on("click", "#btn_guardar_permisos_users", function () {

    permiso=$("#permiso").val();
 
    if(permiso== null || permiso == ''){
                        
                
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para permiso',
                        type: 'error',
                        shadow: true
                    });
               
                return false;
            }
    
preguardar_permisos_users();
});

$("#modal_permisos").on("click", "#btn_permisos_users", function ( e ) {
    e.preventDefault();
    accion=1;
    
    permiso = $( this ).data("id_permiso");
    
    console.log(id);
   
    guardar_permisos_users();
});

$(".modal-footer").on("click", "#btn_eliminar_permisos_users", function () {
guardar_permisos_users();
});

$(".modal-footer").on("click", "#btn_activar_permisos_users", function () {
guardar_permisos_users();
});

});


    function preguardar_permisos_users() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_permisos_users();
                } )
                ;
              }
    
  
function guardar_permisos_users(){
$.ajax({
type: "post",
url:url_guardar_permisos_users,
data: {
 "id": id,
 "id_usuario": id_usuario,
 "permiso": permiso,
 accion: accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_permisos_users").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_permisos_users").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_permisos_users").modal("hide");
for(var i = 0; i < data.sql_seg_usuario_permisos_list.length; i++) {
var row= data.sql_seg_usuario_permisos_list[i];
var nuevaFilaDT=[
row.id,row.usuario,row.permiso_usuario, row.estado

 , 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permisos_users"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_usuario="'+row.id_usuario+'" '+ 
 'data-usuario="'+row.usuario+'" '+ 
 'data-permiso="'+row.permiso+'" '+ 
 'data-permiso_usuario="'+row.permiso_usuario+'" '+
 '><i class="fa fa-trash"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_permisos_users"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_usuario="'+row.id_usuario+'" '+ 
 'data-usuario="'+row.usuario+'" '+ 
 'data-permiso="'+row.permiso+'" '+ 
 'data-permiso_usuario="'+row.permiso_usuario+'" '+
 '><i class="fa fa-check-circle"></i></button>'+ 
''
];
if(accion==1) {
    $("#modal_permisos_users").modal("hide");
        table.row.add(nuevaFilaDT).draw();
    }else if (accion==2) {
        $("#modal_permisos_users").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }else if (accion==4) {
        $("#modal_activar_permisos_users").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }
}
 if (accion == 3){
     $("#modal_eliminar_permisos_users").modal("hide");
     table.row(rowNumber).data(nuevaFilaDT);
} 
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

function reiniciar_clave_usuario(){
$.ajax({
type: "post",
url:url_reiniciar_clave_usuario,
data: {
 "id_usuario": id_usuario,
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";
textMsg=data.msgError;
typeMsg="error";

$( "#btn_reiniciar_clave" ).prop( "disabled", false );

}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";

$( "#btn_reiniciar_clave" ).prop( "disabled", false );
                
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
   
</script>
@endsection