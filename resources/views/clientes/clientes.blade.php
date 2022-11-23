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
            <h1>Sesion</h1> 
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
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="jambo_table table table-hover" id="tbl_usuario" border=1>
                    <thead >
                    <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                    <th scope="col">Id</th>
                    <th scope="col">Primer Nombre</th>
                    <th scope="col">Segundo Nombre</th>
                    <th scope="col">Primer Apellido</th>
                    <th scope="col">Segundo Apellido</th>
                    <th scope="col">Identidad</th>
                    <th scope="col">RTN</th>
                    <th scope="col">celular</th>
                    <th scope="col">correo</th>
                    <th scope="col">Estado Civil</th>
                    <th scope="col">Hijos</th>
                    <th scope="col">Fecha Visita</th>
                    <th scope="col">Trabajo</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Borrado</th>
                    <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuario_list as $row)
                    <tr style="font-size: medium">
                    <td scope="row">{{$row->id}}</td>
                    <td scope="row">{{$row->primer_nombre}}</td>
                    <td scope="row">{{$row->segundo_nombre}}</td>
                    <td scope="row">{{$row->primer_apellido}}</td>
                    <td scope="row">{{$row->segundo_apellido}}</td>
                    <td scope="row">{{$row->identidad}}</td>
                    <td scope="row">{{$row->rtn}}</td>
                    <td scope="row">{{$row->celular}}</td>
                    <td scope="row">{{$row->correo}}</td>
                    <td scope="row">{{$row->estado_civil}}</td>
                    <td scope="row">{{$row->hijos}}</td>
                    <td scope="row">{{$row->fecha_visita}}</td>
                    <td scope="row">{{$row->trabajo}}</td>
                    <td scope="row">{{$row->direccion}}</td>
                    <td scope="row">{{$row->edad}}</td>
                    <td scope="row">{{$row->deleted_at}}</td>
                    <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario"
                    data-id="{{$row->id}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-identidad="{{$row->identidad}}"
                    data-rtn="{{$row->rtn}}"
                    data-celular="{{$row->celular}}"
                    data-correo="{{$row->correo}}"
                    data-id_estado_civil="{{$row->id_estado_civil}}"
                    data-hijos="{{$row->hijos}}"
                    data-fecha_visita="{{$row->fecha_visita}}"
                    data-trabajo="{{$row->trabajo}}"
                    data-direccion="{{$row->direccion}}"
                    data-edad="{{$row->edad}}"
                    data-deleted_at="{{$row->deleted_at}}"
                    data-estado_civil="{{$row->estado_civil}}"
                    ><i class="fa fa-edit"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_usuario"
                    data-id="{{$row->id}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-identidad="{{$row->identidad}}"
                    data-rtn="{{$row->rtn}}"
                    data-celular="{{$row->celular}}"
                    data-correo="{{$row->correo}}"
                    data-id_estado_civil="{{$row->id_estado_civil}}"
                    data-hijos="{{$row->hijos}}"
                    data-fecha_visita="{{$row->fecha_visita}}"
                    data-trabajo="{{$row->trabajo}}"
                    data-direccion="{{$row->direccion}}"
                    data-edad="{{$row->edad}}"
                    data-deleted_at="{{$row->deleted_at}}"
                    data-estado_civil="{{$row->estado_civil}}"
                    ><i class="fa fa-trash"></i></button>
                    &nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_usuario"
                    data-id="{{$row->id}}"
                    data-primer_nombre="{{$row->primer_nombre}}"
                    data-segundo_nombre="{{$row->segundo_nombre}}"
                    data-primer_apellido="{{$row->primer_apellido}}"
                    data-segundo_apellido="{{$row->segundo_apellido}}"
                    data-identidad="{{$row->identidad}}"
                    data-rtn="{{$row->rtn}}"
                    data-celular="{{$row->celular}}"
                    data-correo="{{$row->correo}}"
                    data-id_estado_civil="{{$row->id_estado_civil}}"
                    data-hijos="{{$row->hijos}}"
                    data-fecha_visita="{{$row->fecha_visita}}"
                    data-trabajo="{{$row->trabajo}}"
                    data-direccion="{{$row->direccion}}"
                    data-deleted_at="{{$row->deleted_at}}"
                    data-edad="{{$row->edad}}"
                    data-estado_civil="{{$row->estado_civil}}"
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


<div id="modal_usuario" class="modal fade"  role="dialog" aria-labelledby="modal_usuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="modal_title_usuario">Clientes</h4>
        </div>
    <div class="modal-body">
<div id="testmodal2" style="padding: 5px 20px;">
<form id="antoform2" class="form-horizontal calender" role="form">
<div class="form-group">
        <label class="col-sm-3 control-label">Primer Nombre</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validatorword" id="primer_nombre" name="primer_nombre">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Segundo Nombre</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validatorword" id="segundo_nombre" name="segundo_nombre">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Primer Apellido</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validatorword" id="primer_apellido" name="primer_apellido">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Segundo Apellido</label>
        <div class="col-sm-9">
            <input type="text" class="form-control validatorword" id="segundo_apellido" name="segundo_apellido">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Identidad</label>
        <div class="col-sm-9">
            <input type="number" class="form-control validatornumber" id="identidad" name="identidad">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">RTN</label>
        <div class="col-sm-9">
            <input type="number" class="form-control validatornumber" id="rtn" name="rtn">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Celular</label>
        <div class="col-sm-9">
            <input type="number" class="form-control validatornumber" id="celular" name="celular">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Correo</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="correo" name="correo">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Seleccione Estado Civil</label>
        <div class="col-sm-9">
            <select id="id_estado_civil" name="id_estado_civil" class="select2_single form-control country" >
                                    <option></option>
                                    @foreach ($estado_civil_list as $estado_civil)
                                        <option value="{{$estado_civil->id}}">{{$estado_civil->nombre}}</option>
                                    @endforeach
                                </select>
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Numero Hijos</label>
        <div class="col-sm-9">
            <input type="number" class="form-control validatornumber" id="hijos" name="hijos">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Fecha Visita</label>
        <div class="col-sm-9">
            <input type="text" class="form-control date" id="fecha_visita" name="fecha_visita">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label"> Lugar Trabajo</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="trabajo" name="trabajo">
        </div>
    </div>
    
<div class="form-group">
        <label class="col-sm-3 control-label">Direccion</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Edad</label>
        <div class="col-sm-9">
            <input type="number" class="form-control validatornumber" id="edad" name="edad">
        </div>
    </div>
    

</form>
<div class="modal-footer">
<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
<button type="button" id="btn_guardar_usuario" class="btn btn-primary antosubmit2">Guardar</button>
</div>
</div>
</div>
</div>
</div>
</div>

 
<div id="modal_eliminar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_usuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title_eliminar_usuario">Eliminar Registro</h4>
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
                        <button type="button" id="btn_eliminar_usuario" class="btn btn-danger antosubmit2">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_activar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_activar_usuario aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title_activar_usuario">Activar Registro</h4>
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
                        <button type="button" id="btn_activar_usuario" class="btn btn-primary antosubmit2">Activar</button>
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
var primer_nombre=null;
var segundo_nombre=null;
var primer_apellido=null;
var segundo_apellido=null;
var identidad=null;
var rtn=null;
var celular=null;
var correo=null;
var id_estado_civil=null;
var hijos=null;
var fecha_visita=null;
var trabajo=null;
var direccion=null;
var edad = null;
var deleted_at=null;
var url_guardar_usuario= "{{url('/clientes')}}/guardar";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        }); 

    $('.date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,                    
                    "locale": {
                        "monthNames": monthNames,
                        "daysOfWeek": daysOfWeek,
                        "applyLabel": "Aplicar",
                        "cancelLabel": "Cancelar",
                        "fromLabel": "Desde",
                        "toLabel": "Hasta",
                        format: 'YYYY-MM-DD'
                    },
                  });


        $('.validatornumber').keypress(function ()
        {

            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        });


        $('.validatorword').keypress(function ()
        {
            var keyword = window.event ? window.event.keyCode : e.which;
       
            if ( (keyword == 8) || (keyword == 46))
                return true;
                
            return /^[a-zA-Z\s]+$/.test(String.fromCharCode(keyword));
            
        });

table=$("#tbl_usuario" ).DataTable({
'language':languageOptionsDatatables,
"responsive": true, "lengthChange": false, "autoWidth": false,
dom: "lfBtipr",
 buttons: [
{
    text: "Agregar",
    className: "btn btn-primary glyphicon glyphicon-plus", 
    action: function ( e, dt, node, config ) {
        accion=1;
        $("#modal_usuario").modal("show");
    }
},
{ extend: 'excel', className: 'btn btn-primary glyphicon glyphicon-file' },
{ extend: 'pdf', className: 'btn btn-primary glyphicon glyphicon-file' },
]
});
$('.dt-button').removeClass('dt-button'); 

    
$("#modal_usuario").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
identidad=triggerLink.data("identidad");
rtn=triggerLink.data("rtn");
celular=triggerLink.data("celular");
correo=triggerLink.data("correo");
id_estado_civil=triggerLink.data("id_estado_civil");
hijos=triggerLink.data("hijos");
fecha_visita=triggerLink.data("fecha_visita");
trabajo=triggerLink.data("trabajo");
direccion=triggerLink.data("direccion");
edad=triggerLink.data("edad");
deleted_at=triggerLink.data("deleted_at");
$("#id").val(id);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#identidad").val(identidad);
$("#rtn").val(rtn);
$("#celular").val(celular);
$("#correo").val(correo);
$("#id_estado_civil").val(id_estado_civil);
$("#hijos").val(hijos);
$("#fecha_visita").val(fecha_visita);
$("#trabajo").val(trabajo);
$("#direccion").val(direccion);
$("#edad").val(edad);
$("#deleted_at").val(deleted_at);
});
  
$("#modal_eliminar_usuario").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
identidad=triggerLink.data("identidad");
rtn=triggerLink.data("rtn");
celular=triggerLink.data("celular");
correo=triggerLink.data("correo");
id_estado_civil=triggerLink.data("id_estado_civil");
hijos=triggerLink.data("hijos");
fecha_visita=triggerLink.data("fecha_visita");
trabajo=triggerLink.data("trabajo");
direccion=triggerLink.data("direccion");
edad=triggerLink.data("edad");
deleted_at=triggerLink.data("deleted_at");
$("#id").val(id);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#identidad").val(identidad);
$("#rtn").val(rtn);
$("#celular").val(celular);
$("#correo").val(correo);
$("#id_estado_civil").val(id_estado_civil);
$("#hijos").val(hijos);
$("#fecha_visita").val(fecha_visita);
$("#trabajo").val(trabajo);
$("#direccion").val(direccion);
$("#edad").val(edad);
$("#deleted_at").val(deleted_at);
accion=3;
});
  
$("#modal_activar_usuario").on("show.bs.modal", function (e) {
var triggerLink = $(e.relatedTarget);
id=triggerLink.data("id");
primer_nombre=triggerLink.data("primer_nombre");
segundo_nombre=triggerLink.data("segundo_nombre");
primer_apellido=triggerLink.data("primer_apellido");
segundo_apellido=triggerLink.data("segundo_apellido");
identidad=triggerLink.data("identidad");
rtn=triggerLink.data("rtn");
celular=triggerLink.data("celular");
correo=triggerLink.data("correo");
id_estado_civil=triggerLink.data("id_estado_civil");
hijos=triggerLink.data("hijos");
fecha_visita=triggerLink.data("fecha_visita");
trabajo=triggerLink.data("trabajo");
direccion=triggerLink.data("direccion");
edad=triggerLink.data("edad");
deleted_at=triggerLink.data("deleted_at");
$("#id").val(id);
$("#primer_nombre").val(primer_nombre);
$("#segundo_nombre").val(segundo_nombre);
$("#primer_apellido").val(primer_apellido);
$("#segundo_apellido").val(segundo_apellido);
$("#identidad").val(identidad);
$("#rtn").val(rtn);
$("#celular").val(celular);
$("#correo").val(correo);
$("#id_estado_civil").val(id_estado_civil);
$("#hijos").val(hijos);
$("#fecha_visita").val(fecha_visita);
$("#trabajo").val(trabajo);
$("#direccion").val(direccion);
$("#edad").val(edad);
$("#deleted_at").val(deleted_at);
accion=4;
});
  
$("#tbl_usuario tbody").on( "click", "tr", function () {
rowNumber=parseInt(table.row( this ).index());
accion=2;
table.$('tr.selected').removeClass('selected');
$(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_usuario", function () {
primer_nombre=$("#primer_nombre").val();
segundo_nombre=$("#segundo_nombre").val();
primer_apellido=$("#primer_apellido").val();
segundo_apellido=$("#segundo_apellido").val();
identidad=$("#identidad").val();
rtn=$("#rtn").val();
celular=$("#celular").val();
correo=$("#correo").val();
id_estado_civil=$("#id_estado_civil").val();
hijos=$("#hijos").val();
fecha_visita=$("#fecha_visita").val();
trabajo=$("#trabajo").val();
direccion=$("#direccion").val();
edad=$("#edad").val();
deleted_at=$("#deleted_at").val();
 
    if(primer_nombre== null || primer_nombre == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Primer Nombre',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(segundo_nombre== null || segundo_nombre == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Segundo Nombre',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(primer_apellido== null || primer_apellido == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Primer Apellido',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(segundo_apellido== null || segundo_apellido == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Segundo Apellido',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(  (identidad.length) != 13  ){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Identidad, que no tenga mas de 13 caraacteres',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    if(identidad== null || identidad == '' ){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Identidad',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }

    if(celular== null || celular == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Celular',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    // if(correo== null || correo == ''){

    //                 new PNotify({
    //                     title: 'Valor Requerido',
    //                     text: 'Debe especificar un valor para Correo',
    //                     type: 'error',
    //                     shadow: true
    //                 });
                
    //             return false;
    //         }
    
 
    if(id_estado_civil== null || id_estado_civil == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Estado Civil',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(hijos== null || hijos == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Numero Hijos',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 
    if(fecha_visita== null || fecha_visita == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Fecha Visita',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }

    if(direccion== null || direccion == ''){

                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Direccion',
                        type: 'error',
                        shadow: true
                    });
                
                return false;
            }
    
 if(edad== null || edad == ''){

            new PNotify({
                title: 'Valor Requerido',
                text: 'Debe especificar un valor para Edad',
                type: 'error',
                shadow: true
            });

            return false;
            }
    
preguardar_usuario();
});
});
$(".modal-footer").on("click", "#btn_eliminar_usuario", function () {
guardar_usuario();
});
$(".modal-footer").on("click", "#btn_activar_usuario", function () {
guardar_usuario();
});

    function preguardar_usuario() {
              
              var indexUploadCoincidence=0;
              
$.when(


                ).done(function (){
                  guardar_usuario();
                } )
                ;
              }
    
  
function guardar_usuario(){
$.ajax({
type: "post",
url:url_guardar_usuario,
data: {
 "id": id,
 "primer_nombre": primer_nombre,
 "segundo_nombre": segundo_nombre,
 "primer_apellido": primer_apellido,
 "segundo_apellido": segundo_apellido,
 "identidad": identidad,
 "rtn": rtn,
 "celular": celular,
 "correo": correo,
 "id_estado_civil": id_estado_civil,
 "hijos": hijos,
 "fecha_visita": fecha_visita,
 "trabajo": trabajo,
 "direccion": direccion,
 "edad": edad,
 "deleted_at": deleted_at,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_usuario").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_usuario").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_usuario").modal("hide");
for(var i = 0; i < data.usuario_list.length; i++) {
var row= data.usuario_list[i];
var nuevaFilaDT=[
row.id,row.primer_nombre,row.segundo_nombre,row.primer_apellido,row.segundo_apellido,row.identidad,row.rtn,
row.celular,row.correo,row.estado_civil,row.hijos,row.fecha_visita,row.trabajo,row.direccion,row.edad,row.deleted_at
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_usuario"'+ 
 'data-id="'+row.id+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-rtn="'+row.rtn+'" '+ 
 'data-celular="'+row.celular+'" '+ 
 'data-correo="'+row.correo+'" '+ 
 'data-id_estado_civil="'+row.id_estado_civil+'" '+ 
 'data-hijos="'+row.hijos+'" '+ 
 'data-fecha_visita="'+row.fecha_visita+'" '+ 
 'data-trabajo="'+row.trabajo+'" '+ 
 'data-direccion="'+row.direccion+'" '+ 
 'data-edad="'+row.edad+'" '+ 
 'data-deleted_at="'+row.deleted_at+'" '+ 
 'data-estado_civil="'+row.estado_civil+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_usuario"'+ 
 'data-id="'+row.id+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-rtn="'+row.rtn+'" '+ 
 'data-celular="'+row.celular+'" '+ 
 'data-correo="'+row.correo+'" '+ 
 'data-id_estado_civil="'+row.id_estado_civil+'" '+ 
 'data-hijos="'+row.hijos+'" '+ 
 'data-fecha_visita="'+row.fecha_visita+'" '+ 
 'data-trabajo="'+row.trabajo+'" '+ 
 'data-direccion="'+row.direccion+'" '+ 
 'data-edad="'+row.edad+'" '+
 'data-deleted_at="'+row.deleted_at+'" '+ 
 'data-estado_civil="'+row.estado_civil+'" '+ 
 '><i class="fa fa-trash"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-success" data-toggle="modal" data-target="#modal_activar_usuario"'+ 
 'data-id="'+row.id+'" '+ 
 'data-primer_nombre="'+row.primer_nombre+'" '+ 
 'data-segundo_nombre="'+row.segundo_nombre+'" '+ 
 'data-primer_apellido="'+row.primer_apellido+'" '+ 
 'data-segundo_apellido="'+row.segundo_apellido+'" '+ 
 'data-identidad="'+row.identidad+'" '+ 
 'data-rtn="'+row.rtn+'" '+ 
 'data-celular="'+row.celular+'" '+ 
 'data-correo="'+row.correo+'" '+ 
 'data-id_estado_civil="'+row.id_estado_civil+'" '+ 
 'data-hijos="'+row.hijos+'" '+ 
 'data-fecha_visita="'+row.fecha_visita+'" '+ 
 'data-trabajo="'+row.trabajo+'" '+ 
 'data-direccion="'+row.direccion+'" '+ 
 'data-edad="'+row.edad+'" '+
 'data-deleted_at="'+row.deleted_at+'" '+ 
 'data-estado_civil="'+row.estado_civil+'" '+ 
 '><i class="fa fa-check-circle"></i></button>'+ 
''
];
if(accion==1) {
    $("#modal_usuario").modal("hide");
        table.row.add(nuevaFilaDT).draw();
    }else if (accion==2) {
        $("#modal_usuario").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }else if (accion==4) {
        $("#modal_activar_usuario").modal("hide");
        table.row(rowNumber).data(nuevaFilaDT);
    }
}
 if (accion == 3){
     $("#modal_eliminar_usuario").modal("hide");
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
