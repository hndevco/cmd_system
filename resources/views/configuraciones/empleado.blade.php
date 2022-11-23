@extends ("layouts.menu")
@section("scriptsCSS")
@endsection
@section("content")
    
<!-- Content Header (Page header) -->
<div class="content">
    <div class="container-fluid">        
                <div class="card text-left">
                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                  <h1 class="display-4"><i class="nav-icon fas fa-regular fa-user-alt"></i><b> Empleados</b></h1>
                                  <p class="lead">Secci&oacute;n para administrar empleados.</p>
                              </div>                           
                        </div>
                    </div>                    
                  <!-- /.card-body -->
                </div>
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
                    <i class="nav-icon fas fa-list"></i> Listado de Empleados
                </h3>
    
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            @if (session('ventana_configuracion_empleado')=='1')
                                <button type="button" id="btn_agregar_empleados" class="btn btn-success" data-toggle="modal"
                                data-target="#"><i class="fas fa-user-plus"></i> Agregar</button>
                            @endif                                                            
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
                    <table class="jambo_table table table-hover table-bordered"  id="tbl_per_empleado">
                    <thead>
                    <tr style=" background-color: buttonhighlight; font-size: large    ">
                    <th scope="col">Id</th>
                    <th scope="col">Identidad</th>
                    <th scope="col">Primer Nombre</th>
                    <th scope="col">Segundo Nombre</th>
                    <th scope="col">Primer Apellido</th>
                    <th scope="col">Segundo Apellido</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($per_empleado_list as $row)
                    <tr style="font-size: medium">
                    <td scope="row">{{$row->id}}</td>
                    <td scope="row">{{$row->identidad}}</td>
                    <td scope="row">{{$row->primer_nombre}}</td>
                    <td scope="row">{{$row->segundo_nombre}}</td>
                    <td scope="row">{{$row->primer_apellido}}</td>
                    <td scope="row">{{$row->segundo_apellido}}</td>
                    <td scope="row">{{$row->domicilio}}</td>
                    <td scope="row">{{$row->telefono}}</td>
                    <td scope="row">{{$row->correo}}</td>
                    <td scope="row">{{$row->deleted_at}}</td>
                    <td>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_per_empleado"
                    data-id="{{$row->id}}"
                    data-identidad="{{$row->identidad}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-domicilio="{{$row->domicilio}}"
                    data-telefono="{{$row->telefono}}"
                    data-correo="{{$row->correo}}"
                    data-id_cargo="{{$row->id_cargo}}"
                    data-id_pais="{{$row->id_pais}}"
                    data-deleted_at="{{$row->deleted_at}}" title='Editar Empleado'
                    ><i class="fa fa-edit"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-warning" data-toggle="modal" data-target="#modal_eliminar_per_empleado"
                    data-id="{{$row->id}}"
                    data-identidad="{{$row->identidad}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-domicilio="{{$row->domicilio}}"
                    data-telefono="{{$row->telefono}}"
                    data-correo="{{$row->correo}}"
                    data-id_cargo="{{$row->id_cargo}}"
                    data-id_pais="{{$row->id_pais}}"
                    data-deleted_at="{{$row->deleted_at}}" title='Desactivar Empleado'
                    ><i class="fa fa-user-slash"></i></button>
                    
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_per_empleado"
                    data-id="{{$row->id}}"
                    data-identidad="{{$row->identidad}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-domicilio="{{$row->domicilio}}"
                    data-telefono="{{$row->telefono}}"
                    data-correo="{{$row->correo}}"
                    data-id_cargo="{{$row->id_cargo}}"
                    data-id_pais="{{$row->id_pais}}"
                    data-deleted_at="{{$row->deleted_at}}" title='Activar Empleado'
                    ><i class="fa fa-user-check"></i></button>
                    &nbsp&nbsp&nbsp
                    <a class="btn btn-primary" href="{{url('/empleado/'.$row->id_usuario."/perfil-usuario")}}" title='Permisos'><i class="fa fa-cog"></i> </a>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                    </div>
            </div>
            <!-- /.card-body -->            
            
          </div>
          <!-- /.card -->
    
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<div id="modal_per_empleado" class="modal fade"  role="dialog" aria-labelledby="modal_per_empleado" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Empleados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group row">
                <div class="form-group col-6">
                    <label id="l-identidad" class="">Identidad</label>
                        <div class="">
                            <input type="text" class="form-control" id="identidad" name="identidad">
                        </div>
                    </div>
                    
                <div class="form-group col-6">
                        <label id="l-primer_nombre" class="">Primer Nombre</label>
                        <div class="">
                            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre">
                        </div>
                    </div>
                 </div>   
                    
                <div class="form-group row">
                <div class="form-group col-6">
                        <label id="l-segundo_nombre" class="">Segundo Nombre</label>
                        <div class="">
                            <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                        </div>
                    </div>
                    
                <div class="form-group col-6">
                        <label id="l-primer_apellido" class="">Primer Apellido</label>
                        <div class="">
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido">
                        </div>
                    </div>
                </div>
                
                    
                <div class="form-group row">
                <div class="form-group col-6">
                        <label id="l-segundo_apellido" class="">Segundo Apellido</label>
                        <div class="">
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                        </div>
                    </div>
                    
                <div class="form-group col-6">
                        <label id="l-domicilio" class="">Domicilio</label>
                        <div class="">
                            <input type="text" class="form-control" id="domicilio" name="domicilio">
                        </div>
                    </div>
                </div>
                
                
                    <div class="form-group row">
                <div class="form-group col-6">
                        <label id="l-telefono" class="">Telefono</label>
                        <div class="">
                            <input type="number" class="form-control validatornumber" id="telefono" name="telefono">
                        </div>
                    </div>
                
                    <div class="form-group col-6">
                        <label id="l-correo" class="">Correo</label>
                        <div class="">
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                    </div>
                
                </div>
                
                    <div class="form-group row">
                        <div class="form-group col-6">
                            <label id="l-id_cargo"  class="">Cargo</label>
                            <div class="">
                                <select id="id_cargo" name="id_cargo" class="select2_single form-control country" >
                                    <option></option>
                                    @foreach ($tbl_cargos_list as $cargos)
                                        <option value="{{$cargos->id}}">{{$cargos->cargo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                        <div class="form-group col-6">
                            <label id="l-id_pais"   class="">Pais Nacimiento</label>
                            <div class="">
                                <select id="id_pais" name="id_pais" class="select2_single form-control country" >
                                    <option></option>
                                    @foreach ($tbl_paises_list as $paises)
                                        <option value="{{$paises->id}}">{{$paises->pais}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                          
                    </div>
                </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn_guardar_per_empleado" class="btn btn-primary antosubmit2">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div id="modal_eliminar_per_empleado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_per_empleado aria-hidden="true">
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
            <button type="button" id="btn_eliminar_per_empleado" class="btn btn-danger antosubmit2">Eliminar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div id="modal_activar_per_empleado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_activar_per_empleado aria-hidden="true">
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
            <button type="button" id="btn_activar_per_empleado" class="btn btn-primary antosubmit2">Aceptrar</button>
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
var identidad=null;
var primer_nombre=null;
var segundo_nombre=null;
var primer_apellido=null;
var segundo_apellido=null;
var domicilio=null;
var telefono=null;
var correo=null;
var deleted_at=null;
var id_cargo=null;
var id_pais=null;
var url_guardar_per_empleado= "{{url('/empleado')}}/guardar";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        }); 

        $('.validatornumber').keypress(function ()
        {

            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        });

table=$("#tbl_per_empleado" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
]
});
$('.dt-button').removeClass('dt-button'); 

$("#btn_agregar_empleados").on('click', function( e ){
    accion=1;
    $("#modal_per_empleado").modal("show");
});

    
$("#modal_per_empleado").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    identidad=triggerLink.data("identidad");
    primer_nombre=triggerLink.data("primer_nombre");
    segundo_nombre=triggerLink.data("segundo_nombre");
    primer_apellido=triggerLink.data("primer_apellido");
    segundo_apellido=triggerLink.data("segundo_apellido");
    domicilio=triggerLink.data("domicilio");
    telefono=triggerLink.data("telefono");
    correo=triggerLink.data("correo");
    deleted_at=triggerLink.data("deleted_at");
    id_cargo=triggerLink.data("id_cargo");
    id_pais=triggerLink.data("id_pais");
    $("#id").val(id);
    $("#identidad").val(identidad);
    $("#primer_nombre").val(primer_nombre);
    $("#segundo_nombre").val(segundo_nombre);
    $("#primer_apellido").val(primer_apellido);
    $("#segundo_apellido").val(segundo_apellido);
    $("#domicilio").val(domicilio);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    $("#deleted_at").val(deleted_at);
    $("#id_cargo").val(id_cargo);
    $("#id_pais").val(id_pais);
});
  
$("#modal_eliminar_per_empleado").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    identidad=triggerLink.data("identidad");
    primer_nombre=triggerLink.data("primer_nombre");
    segundo_nombre=triggerLink.data("segundo_nombre");
    primer_apellido=triggerLink.data("primer_apellido");
    segundo_apellido=triggerLink.data("segundo_apellido");
    domicilio=triggerLink.data("domicilio");
    telefono=triggerLink.data("telefono");
    correo=triggerLink.data("correo");
    deleted_at=triggerLink.data("deleted_at");
    $("#id").val(id);
    $("#identidad").val(identidad);
    $("#primer_nombre").val(primer_nombre);
    $("#segundo_nombre").val(segundo_nombre);
    $("#primer_apellido").val(primer_apellido);
    $("#segundo_apellido").val(segundo_apellido);
    $("#domicilio").val(domicilio);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    $("#deleted_at").val(deleted_at);
    accion=3;
});
  
$("#modal_activar_per_empleado").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    identidad=triggerLink.data("identidad");
    primer_nombre=triggerLink.data("primer_nombre");
    segundo_nombre=triggerLink.data("segundo_nombre");
    primer_apellido=triggerLink.data("primer_apellido");
    segundo_apellido=triggerLink.data("segundo_apellido");
    domicilio=triggerLink.data("domicilio");
    telefono=triggerLink.data("telefono");
    correo=triggerLink.data("correo");
    deleted_at=triggerLink.data("deleted_at");
    $("#id").val(id);
    $("#identidad").val(identidad);
    $("#primer_nombre").val(primer_nombre);
    $("#segundo_nombre").val(segundo_nombre);
    $("#primer_apellido").val(primer_apellido);
    $("#segundo_apellido").val(segundo_apellido);
    $("#domicilio").val(domicilio);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    $("#deleted_at").val(deleted_at);
    accion=4;
});
  
$("#tbl_per_empleado tbody").on( "click", "tr", function () {
    rowNumber=parseInt(table.row( this ).index());
    accion=2;
    table.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_per_empleado", function () {
    identidad=$("#identidad").val();
    primer_nombre=$("#primer_nombre").val();
    segundo_nombre=$("#segundo_nombre").val();
    primer_apellido=$("#primer_apellido").val();
    segundo_apellido=$("#segundo_apellido").val();
    domicilio=$("#domicilio").val();
    telefono=$("#telefono").val();
    correo=$("#correo").val();
    deleted_at=$("#deleted_at").val();
    id_cargo=$("#id_cargo").val();
    id_pais=$("#id_pais").val();

    var valida = null;
        valida = evaluar( ['identidad' , 'primer_nombre', 'segundo_nombre', 'primer_apellido' , 'domicilio', 'telefono', 'correo', 'id_cargo' ,'id_pais' ] );

    if( valida ){
        preguardar_per_empleado();
    }else{
        return false;
    }   

});

$(".modal-footer").on("click", "#btn_eliminar_per_empleado", function () {
guardar_per_empleado();
});
$(".modal-footer").on("click", "#btn_activar_per_empleado", function () {
guardar_per_empleado();
});

});


function preguardar_per_empleado() {

    var indexUploadCoincidence=0;

    $.when(

    ).done(function (){
        guardar_per_empleado();
    });
}
    
  
function guardar_per_empleado(){
$.ajax({
type: "post",
url:url_guardar_per_empleado,
data: {
 "id": id,
 "identidad": identidad,
 "primer_nombre": primer_nombre,
 "segundo_nombre": segundo_nombre,
 "primer_apellido": primer_apellido,
 "segundo_apellido": segundo_apellido,
 "domicilio": domicilio,
 "telefono": telefono,
 "correo": correo,
 "id_cargo": id_cargo,
 "id_pais": id_pais,
 "deleted_at": deleted_at,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_per_empleado").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_per_empleado").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_per_empleado").modal("hide");
for(var i = 0; i < data.per_empleado_list.length; i++) {
var row= data.per_empleado_list[i];
var nuevaFilaDT=[
row.id,row.identidad,row.primer_nombre,row.segundo_nombre,row.primer_apellido,row.segundo_apellido,row.domicilio,row.telefono,row.correo,row.deleted_at

 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_per_empleado"'+ 
 'data-id="'+row.id+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-domicilio="'+row.domicilio+'" '+ 
 'data-telefono="'+row.telefono+'" '+
 'data-correo="'+row.correo+'" '+  
 'data-deleted_at="'+row.deleted_at+'" '+
 'data-id_cargo="'+row.id_cargo+'" '+ 
 'data-id_pais="'+row.id_pais+'" '+  
 'title="Editar Empleado"><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-warning" data-toggle="modal" data-target="#modal_eliminar_per_empleado"'+ 
 'data-id="'+row.id+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-domicilio="'+row.domicilio+'" '+ 
 'data-telefono="'+row.telefono+'" '+ 
 'data-correo="'+row.correo+'" '+
 'data-deleted_at="'+row.deleted_at+'" '+ 
 'data-id_cargo="'+row.id_cargo+'" '+ 
 'data-id_pais="'+row.id_pais+'" '+  
 'title="Desactivar Empleado"><i class="fa fa-user-slash"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_per_empleado"'+ 
 'data-id="'+row.id+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-domicilio="'+row.domicilio+'" '+ 
 'data-telefono="'+row.telefono+'" '+ 
 'data-correo="'+row.correo+'" '+
 'data-deleted_at="'+row.deleted_at+'" '+ 
 'data-id_cargo="'+row.id_cargo+'" '+ 
 'data-id_pais="'+row.id_pais+'" '+  
 'title="Activar Empleado"><i class="fa fa-user-check"></i></button>'+ 
 '&nbsp&nbsp&nbsp<a class="btn btn-primary" href="/empleado/'+row.id+'/perfil-usuario" title="Permisos"><i class="fa fa-cog"></i> </a>'+
''

];
console.log(nuevaFilaDT);
if(accion==1) {
    $("#modal_per_empleado").modal("hide");
        table.row.add(nuevaFilaDT).draw();
    }else if (accion==2) {
        $("#modal_per_empleado").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }else if (accion==4) {
        $("#modal_activar_per_empleado").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }
}
 if (accion == 3){
     $("#modal_eliminar_per_empleado").modal("hide");
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