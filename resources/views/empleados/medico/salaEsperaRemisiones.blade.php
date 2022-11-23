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
                      <div class="jumbotron jumbotron-fluid" >
                          <div class="container">
                                <h1 class="display-4"><i class="nav-icon fas fa-regular fa-restroom"></i><b> Sala de Espera - Remisiones</b></h1>
                                <p class="lead">Seccion para visualizar el listado de pacientes que estan en espera.</p>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                    </button>                
                </div>
            </div>
              <div class="card-body"> 

                  <div class="table-responsive">
                      <table class="jambo_table table table-hover table-bordered" id="tbl_remisiones">
                          <thead >
                              <tr style="color: black; background-color: buttonhighlight; font-size: large    ">
                                  <th scope="col">Id</th>
                                  <th scope="col">Paciente</th>
                                  <th scope="col">Medico</th>
                                  <th scope="col">Area</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Opciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($sql_sala_espera_remisiones as $row)
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
                                              ><i class="fa fa-edit"></i></button> &nbsp&nbsp&nbsp                                     
                                    <button id="btn_atender_paciente" style="display: {{$row->atender_paciente}};" data-id_area="{{$row->id_area}}" data-id_paciente="{{$row->id_paciente}}" data-id="{{$row->id}}" class="btn btn-warning" title='Atender Paciente'><i class="fa fa-clipboard-check"></i></button>
                                    <a target='_blank' href="{{url('/')}}/historial-clinico/paciente/{{$row->id_paciente}}/remision/{{$row->id_remision}}/expediente/{{$row->id_area}}" style="display: {{$row->ver_expediente}};" class="btn btn-success" title='Ver Expediente'><i class="fa fa-folder"></i></a>                                                                            
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
                <select id="id_area" name="id_area" class="select2_single form-control country" disabled="true" >
                                    <option></option>
                                    @foreach ($area_list as $area)
                                        <option value="{{$area->id}}">{{$area->nombre}}</option>
                                    @endforeach
                                </select>
	</div>
	
<div class="form-group">
		<label id="l-id_estado_remision" class="">Estado</label>		
			<select id="id_estado_remision" name="id_estado_remision" class="select2_single form-control country" disabled="true"  >
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
  


  

@endsection
@section("scripts")
  
<script type="text/javascript">

var accion=null;
var id=null;
var id_paciente=null;
var id_medico=null;
var id_area=null;
var id_estado_remision=null;
var paciente=null;
var medico=null;
var url_guardar_remisiones_proceso= "{{url('/sala-espera/remisiones/paciente/estado')}}";
var url_guardar_tbl_remisiones= "{{url('/remisiones/paciente')}}/guardar";
var uri = "{{url('/')}}";
var table=null;
var rowNumber=null;
$(document).ready(function () {
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});	
table=$("#tbl_remisiones" ).DataTable({
'language':languageOptionsDatatables,
dom: "lfBtipr",
"responsive": true, "lengthChange": false, "autoWidth": false,
 buttons: [
	
]
});

$("#modal_tbl_remisiones").on("show.bs.modal", function (e) {
    var triggerLink = $(e.relatedTarget);
    id=triggerLink.data("id");
    id_paciente=triggerLink.data("id_paciente");
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
  
$("#tbl_remisiones tbody").on( "click", "tr", function () {
    rowNumber=parseInt(table.row( this ).index());
    table.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
});
  
$(".modal-footer").on("click", "#btn_guardar_tbl_remisiones", function () {

    id_medico=$("#id_medico").val();
    id_area=$("#id_area").val();
    id_estado_remision=$("#id_estado_remision").val();
    accion = 2;
    
    var valida = null;
    valida = evaluar( [ 'id_medico' ] );

    if( valida ){
        preguardar_tbl_remisiones();
    }else{
        return false;
    }

});

$("#tbl_remisiones").on("click", "#btn_atender_paciente", function (  ) {
    
    id = $( this ).data( "id" );
    id_paciente = $( this ).data( "id_paciente" );
    id_area = $( this ).data( "id_area" );
    accion = 2;
    
    preguardar_remisiones_proceso();
});

});

function preguardar_tbl_remisiones() {

var indexUploadCoincidence=0;

    $.when(
    ).done(function (){
      guardar_tbl_remisiones();
    });

}

function preguardar_remisiones_proceso() {

var indexUploadCoincidence=0;

    $.when(
    ).done(function (){
      guardar_remisiones_proceso();
    });

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
''
];                             
    if (accion==2) {
        $("#modal_tbl_remisiones").modal("hide");
        table.row(rowNumber).remove().draw();
        //table.row(rowNumber).data(nuevaFilaDT);
    }
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

function guardar_remisiones_proceso(){
$.ajax({
type: "post",
url:url_guardar_remisiones_proceso,
data: {
    "id": id,
    accion:accion
},
success: function (data) {
    if(data.msgError!=null){
        titleMsg="Error al Guardar";;
        textMsg=data.msgError;
        typeMsg="error";

    }else{
        titleMsg="Paciente Recibido";
        textMsg=data.msgSuccess;
        typeMsg="success";
        if(id_area == 1){//GINECOLOGÍA
            window.location.href = "{{url('/exp_ginecologico/id_remision/')}}/"+id+"/paciente/"+id_paciente;
        }else if(id_area == 2){//PEDIATRÍA
            window.location.href = "{{url('/exp_pediatrico/id_remision/')}}/"+id+"/paciente/"+id_paciente;
        }else if(id_area == 3){//MEDICINA GENERAL
            window.location.href = "{{url('/exp/general/id_remision/')}}/"+id+"/paciente/"+id_paciente;
        }
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
             '&nbsp&nbsp&nbsp<a href="'+ uri + row.expediente+'" class="btn btn-light" id="btn_exp_'+row.area+'" target="_blank"><i class="fas fa-stethoscope"></i>'+row.area+'</a>'+
            ''
            ];
                        
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
