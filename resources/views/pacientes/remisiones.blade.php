@extends ("layouts.menu")
@section("scriptsCSS")
@endsection
@section("content")

<!-- Content Header (Page header) -->
<div class="content">
    <div class="container-fluid">        
                       
                <!-- Default box -->
                <div class="card text-left">
                  <div class="card-body">
                      <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                                <h1 class="display-4"><i class="nav-icon fas fa-regular fa-bell"></i><b> Remisiones</b></h1>
                                <p class="lead">Seccion para remitir al paciente con el medico disponible.</p>
                                <a class="btn btn-primary" id="btn_volver" href="{{route('vista_recepcion')}}">Volver</a>
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
                    <i class="nav-icon fas fa-list"></i> Listado de Remisiones
                </h3>
    
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <button type="button" id="btn_agregar_remisiones" class="btn btn-success" data-toggle="modal"
                                data-target="#"><i class="fas fa-user-plus"></i> Agregar</button>
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
                      <table class="jambo_table table table-hover table-bordered" id="tbl_tbl_remisiones">
                          <thead >
                              <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                                  <th scope="col">id</th>
                                  <th scope="col">Paciente</th>
                                  <th scope="col">Medico</th>
                                  <th scope="col">Area</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Opciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($tbl_remisiones_list as $row)
                              <tr style="font-size: medium">
                                  <td scope="row">{{$row->id}}</td>
                                  <td scope="row">{{$row->paciente}}</td>
                                  <td scope="row">{{$row->medico}}</td>
                                  <td scope="row">{{$row->area}}</td>
                                  <td scope="row">{{$row->estado_remision}}</td>
                                  <td>
                                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal_tbl_remisiones"
                                              data-id="{{$row->id}}"
                                              data-id_paciente="{{$row->id_paciente}}"
                                              data-id_medico="{{$row->id_medico}}"
                                              data-id_area="{{$row->id_area}}"
                                              data-id_estado_remision="{{$row->id_estado_remision}}"
                                              data-paciente="{{$row->paciente}}"
                                              data-medico="{{$row->medico}}"
                                              data-area="{{$row->area}}"
                                              data-estado_remision="{{$row->estado_remision}}"
                                              ><i class="fa fa-edit"></i></button>
                                      &nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_tbl_remisiones"
                                                             data-id="{{$row->id}}"
                                                             data-id_paciente="{{$row->id_paciente}}"
                                                             data-id_medico="{{$row->id_medico}}"
                                                             data-id_area="{{$row->id_area}}"
                                                             data-id_estado_remision="{{$row->id_estado_remision}}"
                                                             data-paciente="{{$row->paciente}}"
                                                             data-medico="{{$row->medico}}"
                                                             data-area="{{$row->area}}"
                                                             data-estado_remision="{{$row->estado_remision}}"
                                                             ><i class="fa fa-trash"></i></button>
                                      &nbsp&nbsp&nbsp
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
<div id="modal_tbl_remisiones" class="modal fade"  role="dialog" aria-labelledby="modal_tbl_remisiones" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
          <h4 class="modal-title">Remisiones</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="antoform2" class="form-horizontal calender" role="form">

	
<div class="form-group">
		<label id="l-id_medico" class="">Medico</label>					                          
                        <select id="id_medico" name="id_medico" class="select2_single form-control country" >
                                   <option></option>
                                   @foreach ($medico_list as $d)
                                       <option value="{{$d->id}}">{{$d->nombre_medico}}</option>
                                   @endforeach
                               </select>
		
	</div>
	
<div class="form-group">
		<label id="l-id_area" class="">Area</label>		
			<select id="id_area" name="id_area" class="select2_single form-control country" >
                                    <option></option>
                                    @foreach ($area_list as $area)
                                        <option value="{{$area->id}}">{{$area->nombre}}</option>
                                    @endforeach
                                </select>
	</div>
	
<div class="form-group">
		<label id="l-id_estado_remision" class="">Estado</label>		
			<select id="id_estado_remision" name="id_estado_remision" class="select2_single form-control country" >
                                    <option></option>
                                    @foreach ($estado_remision_list as $estado_remision)
                                        <option value="{{$estado_remision->id}}">{{$estado_remision->nombre}}</option>
                                    @endforeach
                                </select>
	</div>
	
</form>
</div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button> 
	<button type="button" id="btn_guardar_tbl_remisiones" class="btn btn-primary antosubmit2">Guardar</button>
            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->  

 
<div id="modal_eliminar_tbl_remisiones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_tbl_remisiones aria-hidden="true">
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
			<button type="button" id="btn_eliminar_tbl_remisiones" class="btn btn-danger antosubmit2">Eliminar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  

<div id="modal_eliminar_tbl_remisiones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_tbl_remisiones aria-hidden="true">
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
			<button type="button" id="btn_activar_tbl_remisiones" class="btn btn-primary antosubmit2">Activar</button>
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
var id_paciente = {{ $id_paciente }};
var accion=null;
var id=null;
var id_medico=null;
var id_area=null;
var id_estado_remision=null;
var paciente=null;
var medico=null;
var url_guardar_tbl_remisiones= "{{url('/remisiones/paciente')}}/guardar";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});	
table=$("#tbl_tbl_remisiones" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
]
});
 
$("#btn_agregar_remisiones").on('click', function( e ){
    accion=1;
    $("#modal_tbl_remisiones").modal("show");
});
	
$("#modal_tbl_remisiones").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    id_medico=triggerLink.data("id_medico");
    id_area=triggerLink.data("id_area");
    id_estado_remision=triggerLink.data("id_estado_remision");
    paciente=triggerLink.data("paciente");
    medico=triggerLink.data("medico");
    $("#id").val(id);
    $("#id_area").val(id_area);
    $("#id_estado_remision").val(id_estado_remision);
    $("#id_medico").val(id_medico);
});
  
$("#modal_eliminar_tbl_remisiones").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    id_paciente=triggerLink.data("id_paciente");
    id_medico=triggerLink.data("id_medico");
    id_area=triggerLink.data("id_area");
    id_estado_remision=triggerLink.data("id_estado_remision");
    $("#id").val(id);
    $("#id_medico").val(id_medico);
    $("#id_area").val(id_area);
    $("#id_estado_remision").val(id_estado_remision);
    accion=3;
});
  
$("#tbl_tbl_remisiones tbody").on( "click", "tr", function () {
    rowNumber=parseInt(table.row( this ).index());
    accion=2;
    table.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_tbl_remisiones", function () {

    id_medico=$("#id_medico").val();
    id_area=$("#id_area").val();
    id_estado_remision=$("#id_estado_remision").val();

    var valida = null;
    valida = evaluar( ['id_medico' , 'id_area', 'id_estado_remision' ] );

    if( valida ){
        preguardar_tbl_remisiones();
    }else{
        return false;
    }

});
});
$(".modal-footer").on("click", "#btn_eliminar_tbl_remisiones", function () {
guardar_tbl_remisiones();
});
$(".modal-footer").on("click", "#btn_activar_tbl_remisiones", function () {
guardar_tbl_remisiones();
});

function preguardar_tbl_remisiones() {

var indexUploadCoincidence=0;

$.when(


).done(function (){
  guardar_tbl_remisiones();
} )
;
}
	
  
function guardar_tbl_remisiones(){
$.ajax({
type: "post",
url:url_guardar_tbl_remisiones,
data: {
 "id": id,
 "id_paciente": id_paciente,
 "id_medico": id_medico,
 "id_area": id_area,
 "id_estado_remision": id_estado_remision,
accion:accion
},
success: function (data) {
if(data.msgError!=null){
titleMsg="Error al Guardar";;
textMsg=data.msgError;
typeMsg="error";
if(accion==1 || accion==2){
                        $("#modal_tbl_remisiones").modal("show");
                    }else if(accion==3){
                        $("#modal_eliminar_tbl_remisiones").modal("show");
                    }
}else{
titleMsg="Datos Guardados";
textMsg=data.msgSuccess;
typeMsg="success";
$("#modal_tbl_remisiones").modal("hide");
for(var i = 0; i < data.tbl_remisiones_list.length; i++) {
var row= data.tbl_remisiones_list[i];
var nuevaFilaDT=[
row.id,row.paciente,row.medico,row.area,row.estado_remision
 ,'<button class="btn btn-primary" data-toggle="modal" data-target="#modal_tbl_remisiones"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_paciente="'+row.id_paciente+'" '+ 
 'data-id_medico="'+row.id_medico+'" '+ 
 'data-id_area="'+row.id_area+'" '+ 
 'data-id_estado_remision="'+row.id_estado_remision+'" '+ 
 'data-paciente="'+row.paciente+'" '+ 
 'data-medico="'+row.medico+'" '+ 
 'data-area="'+row.area+'" '+ 
 'data-estado_remision="'+row.estado_remision+'" '+ 
 '><i class="fa fa-edit"></i></button>'+ 
 '&nbsp&nbsp&nbsp<button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_tbl_remisiones"'+ 
 'data-id="'+row.id+'" '+ 
 'data-id_paciente="'+row.id_paciente+'" '+ 
 'data-id_medico="'+row.id_medico+'" '+ 
 'data-id_area="'+row.id_area+'" '+ 
 'data-id_estado_remision="'+row.id_estado_remision+'" '+ 
 'data-paciente="'+row.paciente+'" '+ 
 'data-medico="'+row.medico+'" '+ 
 'data-area="'+row.area+'" '+ 
 'data-estado_remision="'+row.estado_remision+'" '+ 
 '><i class="fa fa-trash"></i></button>'+
''
];
if(accion==1) {
	$("#modal_tbl_remisiones").modal("hide");
		table.row.add(nuevaFilaDT).draw();
	}else if (accion==2) {
		$("#modal_tbl_remisiones").modal("hide");
		table.row(rowNumber).data(nuevaFilaDT);
	}else if (accion==4) {		
	}
}
 if (accion == 3){
     $("#modal_eliminar_tbl_remisiones").modal("hide");
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
   
function getDataValue(idDataList, idInput){
    var value = $('#'+idInput).val();
    return $('#'+idDataList+' [value="' + value + '"]').data('value');
}
	
</script>
@endsection