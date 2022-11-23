@extends ("layouts.menu")
@section("scriptsCSS")
@endsection
@section("content")

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <div class="jumbotron" style="padding-bottom: 2%">-->
                <h1>Cuenta Usuario</h1>  
            <!--</div>-->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">              
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="jambo_table table table-hover" id="tbl_users" border=1>
                    <thead >
                    <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users_list as $row)
                    <tr style="font-size: medium">
                    <td scope="row">{{$row->id}}</td>
                    <td scope="row">{{$row->usuario}}</td>
                    <td scope="row">{{$row->email}}</td>
                    <td scope="row">{{$row->password}}</td>
                    <td>
                    
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_users"
                    data-id="{{$row->id}}"
                    data-usuario="{{$row->usuario}}"
                    data-email="{{$row->email}}"
                    data-password="{{$row->password}}"
                    ><i class="fa fa-edit"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_users"
                    data-id="{{$row->id}}"
                    data-usuario="{{$row->usuario}}"
                    data-email="{{$row->email}}"
                    data-password="{{$row->password}}"
                    ><i class="fa fa-trash"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_users"
                    data-id="{{$row->id}}"
                    data-usuario="{{$row->usuario}}"
                    data-email="{{$row->email}}"
                    data-password="{{$row->password}}"
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

<div id="modal_users" class="modal fade"  role="dialog" aria-labelledby="modal_users" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="modal_title_users">Cuenta Usuario</h4>
        </div>
    <div class="modal-body">
<div id="testmodal2" style="padding: 5px 20px;">
<form id="antoform2" class="form-horizontal calender" role="form">
<div class="form-group">
        <label class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Correo</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="email" name="email">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Contraseña</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="password" name="password" maxlength="8">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Resetear Contraseña?</label>
        <div class="col-sm-9">
            <input type="checkbox" class="form-control" id="resetpassword" name="resetpassword" value="1">
        </div>
    </div>
    
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
<button type="button" id="btn_guardar_users" class="btn btn-primary antosubmit2">Guardar</button>
</div>
</div>
</div>
</div>
</div>
</div>
 
<div id="modal_eliminar_users" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_users aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title_eliminar_users">Eliminar Registro</h4>
            </div>
            <div class="modal-body">
                <div id="testmodal2" style="padding: 5px 20px;">
                    <form id="antoform2" class="form-horizontal calender" role="form">

                        <div class="form-group">
                            <label class="control-label" style="font-size: 20px">¿Seguro que desea eliminar este registro?</label>
                        </div>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btn_eliminar_users" class="btn btn-danger antosubmit2">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_activar_users" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_activar_users aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title_activar_users">activar Registro</h4>
            </div>
            <div class="modal-body">
                <div id="testmodal2" style="padding: 5px 20px;">
                    <form id="antoform2" class="form-horizontal calender" role="form">

                        <div class="form-group">
                            <label class="control-label" style="font-size: 20px">¿Seguro que desea activar este registro?</label>
                        </div>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btn_activar_users" class="btn btn-danger antosubmit2">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("scripts")
 
<script type="text/javascript">
var accion=null;
var id=null;
var usuario=null;
var email=null;
var password=null;
var url_guardar_users= "{{url('/configuraciones/registrar')}}/guardar";
var table=null;
var rowNumber=null;
var resetpassword = null;
$(document).ready(function () {
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        }); 
table=$("#tbl_users" ).DataTable({
'language':languageOptionsDatatables,
"responsive": true, "lengthChange": false, "autoWidth": false,
dom: "lfBtipr",
buttons: [

]
});
 

    
$("#modal_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
usuario=triggerLink.data("usuario");
email=triggerLink.data("email");
password=triggerLink.data("password");
$("#id").val(id);
$("#usuario").val(usuario);
$("#email").val(email);
$("#password").val(password);
});
  
$("#modal_eliminar_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
usuario=triggerLink.data("usuario");
email=triggerLink.data("email");
password=triggerLink.data("password");
$("#id").val(id);
$("#usuario").val(usuario);
$("#email").val(email);
$("#password").val(password);
accion=3;
});
  
$("#modal_activar_users").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
usuario=triggerLink.data("usuario");
email=triggerLink.data("email");
password=triggerLink.data("password");
$("#id").val(id);
$("#usuario").val(usuario);
$("#email").val(email);
$("#password").val(password);
accion=4;
});
  
$("#tbl_users tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_users", function () {
usuario=$("#usuario").val();
email=$("#email").val();
password=$("#password").val();
resetpassword = $("#resetpassword:checked").val(); 
 
    if(usuario== null || usuario == ''){
                        
               
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Nombre',
                        type: 'error',
                        shadow: true
                    });
               
                return false;
            }
    
 
    if(email== null || email == ''){
                        
                
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Correo',
                        type: 'error',
                        shadow: true
                    });
               
                return false;
            }
    
 
    if(password== null || password == ''){
                        
                
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Contraseña',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
preguardar_users();
});

$(".modal-footer").on("click", "#btn_eliminar_users", function () {
guardar_users();
});
$(".modal-footer").on("click", "#btn_activar_users", function () {
guardar_users();
});

});


    function preguardar_users() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_users();
                } )
                ;
              }
    
  
function guardar_users(){
$.ajax({
type: "post",
url:url_guardar_users,
data: {
 "id": id,
 "usuario": usuario,
 "email": email,
 "password": password,
 "resetpassword":resetpassword,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_users").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_users").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_users").modal("hide");
for(var i = 0; i < data.users_list.length; i++) {
var row= data.users_list[i];
var nuevaFilaDT=[
row.id,row.usuario,row.email,row.password

 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_users"'+ 
 'data-id="'+row.id+'" '+ 
 'data-usuario="'+row.usuario+'" '+ 
 'data-email="'+row.email+'" '+ 
 'data-password="'+row.password+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_users"'+ 
 'data-id="'+row.id+'" '+ 
 'data-usuario="'+row.usuario+'" '+ 
 'data-email="'+row.email+'" '+ 
 'data-password="'+row.password+'" '+ 
 '><i class="fa fa-trash"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_activar_users"'+ 
 'data-id="'+row.id+'" '+ 
 'data-usuario="'+row.usuario+'" '+ 
 'data-email="'+row.email+'" '+ 
 'data-password="'+row.password+'" '+ 
 '><i class="fa fa-check-circle"></i></button>'+ 
''

];
if(accion==1) {
    $("#modal_users").modal("hide");
        table.row.add(nuevaFilaDT).draw();
    }else if (accion==2) {
        $("#modal_users").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }else if (accion==4) {
        $("#modal_activar_users").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }
}
 if (accion == 3){
     $("#modal_eliminar_users").modal("hide");
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
   
</script>
@endsection