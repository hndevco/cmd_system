@extends('layouts.menu')
@section('scriptsCSS')
    
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4"><i class="nav-icon fa fa-receipt"></i><b> Recetas</b></h1>
                                <blockquote class="quote-primary">
                                        <p>Listado de recetas médicas.</p>
                                </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="pt-2 px-3"><h3 class="card-title"><i class="nav-icon fas fa-receipt"></i> Recetas</h3></li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false"><i class="nav-icon fas fa-clock"></i> Pendientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="nav-icon fas fa-check"></i> Atendidas</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                        <div class="card-body table-responsive">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="tbl_historial_recetas" class="table table-hover dataTable dtr-inline">
                                                        <thead class="">
                                                            <tr>
                                                                <th>Fecha Emisión</th>
                                                                <th>Paciente</th>
                                                                <th>Área Remisión</th>
                                                                <th>Médico</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                        <div class="card-body table-responsive">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="tbl_historial_recetas_atendidas" class="table table-hover dataTable dtr-inline">
                                                        <thead class="">
                                                            <tr>
                                                                <th>Fecha Emisión</th>
                                                                <th>Hora/Fecha Atentido</th>
                                                                <th>Paciente</th>
                                                                <th>Área Remisión</th>
                                                                <th>Médico</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_ver_receta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title"><i class="fa fa-receipt"></i> Receta Médica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <img src="{{ asset('/images/LOGO.png') }}" width="150" height="80" />
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <center>
                                <h1>Centro Médico Díaz</h1>
                                <ul class="list-unstyled">
                                    <li>
                                        <h4><strong id="medico"> </strong></h4>
                                    </li>
                                    <li id="medico_cargo"></li>
                                    <li id="medico_cel"></li>
                                </ul>
                            </center>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            @if($far_escribir_recetas == 1)
                            <div class="icheck-primary d-outline" id="div_checkbox_peciente_atendido">
                                
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-dark progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                    <div class="progress progress-xxs">
                        <div class="progress-bar bg-light progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                    <div class="progress progress-xxs">
                        <div class="progress-bar bg-dark progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only">60% Complete (warning)</span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h5>
                                Nombre del Paciente:
                                <small class="text-muted"><ins id="nombre_paciente"></ins></small>
                            </h5>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h5>
                                Fecha:
                                <small class="text-muted"><ins id="fecha_paciente"></ins></small>
                            </h5>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <h5>
                                Edad:
                                <small class="text-muted"><ins id="edad_paciente"></ins></small>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card elevation-1">
                                <div class="card-body" id="div_receta">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_imprimir_receta" class="btn btn-primary" data-dismiss="modal">Imprimir</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
        var url_get_recetas = "{{url('/farmacia/lista_recetas')}}";
        var url_get_recetas_atendidas = "{{url('/farmacia/lista_recetas_atendidas')}}";
        var url_ver_receta = "{{url('farmacia/ver_receta')}}";
        var url_paciente_atendido = "{{url('farmacia/paciente_atendido_receta')}}";
        var table_recetas =null;
        var table_recetas_atendidas =null;
        var primer_nombre = null;
        var segundo_nombre = null;
        var primer_apellido = null;
        var segundo_apellido = null;
        var identidad = null;
        var fecha_nacimiento = null;
        var telefono = null;
        var genero = null;
        var domicilio = null;
        var nombre_padre = null;
        var nombre_madre = null;
        var nombre_tutor = null;
        var accion = null;
        var receta_medica = null;

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#custom-tabs-two-home-tab').trigger("click");

            table_recetas = $('#tbl_historial_recetas').DataTable({
                procesing: true,
                //reponsive:true,
                serverside: true,
                ajax: url_get_recetas,
                columns:[
                    /*{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },*/
                    {data:'fecha'},
                    {data:'paciente'},
                    {data:'area'},
                    {data:'medico'},
                ],
                'language': languageOptionsDatatables,
                deferRender: true,
                "columnDefs": [
                    {
                        targets: 4,
                        data: null,
                        render: function(data, type, row, meta) {
                            //console.table(td);
                            var btn_ver_receta= "<a href='javascript:ver_receta("+row.id+")'' id='btn_ver_receta' class='btn btn-sm btn-info' title='Ver Receta Médica'><i class='fas fa-receipt'></i> Receta</a>&nbsp;";
                            
                            return btn_ver_receta;
                        }
                    }
                ]



            });

            

           $('#tbl_historial_recetas tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table_recetas.row(tr);
                
                if (row.child.isShown()) {
                // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });


            $('#custom-tabs-two-profile-tab').on('click', function () {
                if(accion == null){
                    accion = 1;
                    table_recetas_atendidas = $('#tbl_historial_recetas_atendidas').DataTable({
                        procesing: true,
                        //reponsive:true,
                        serverside: true,
                        ajax: url_get_recetas_atendidas,
                        columns:[
                            /*{
                                className: 'dt-control',
                                orderable: false,
                                data: null,
                                defaultContent: '',
                            },*/
                            {data:'fecha'},
                            {data:'hora_fecha_atendido'},
                            {data:'paciente'},
                            {data:'area'},
                            {data:'medico'},
                        ],
                        'language': languageOptionsDatatables,
                        deferRender: false,
                        "columnDefs": [
                            {
                                targets: 5,
                                data: null,
                                render: function(data, type, row, meta) {
                                    //console.table(td);
                                    var btn_ver_receta= "<a href='javascript:ver_receta("+row.id+")'' id='btn_ver_receta' class='btn btn-sm btn-info' title='Ver Receta Médica'><i class='fas fa-receipt'></i> Receta</a>&nbsp;";
                                    
                                    return btn_ver_receta;
                                }
                            }
                        ]



                    });
                }
                
            });
            
            $("#btn_imprimir_receta").on('click', function( e ){
                e.preventDefault();
                
                printDiv();
    
            });
            
        });

        function ver_receta(id_receta){
            $("#btn_ver_receta").attr('disabled', true);
            $.ajax({
                type: "post",
                url: url_ver_receta,
                data: {
                    'id_receta': id_receta,
                },
                success: function(data){
                    if(data.msgError != null){
                        titleMsg = "Error al cargar";
                        textMsg = data.msgError;
                        typeMsg = "error";
                    }else{
                        titleMsg = "Carga exitosa";
                        textMsg = data.msgSuccess;
                        typeMsg = "success";
                        var receta = data.receta;
                        
                        receta_medica = data.receta;
                        
                        $("#medico").html('Dr (a): '+receta.medico);
                        $("#medico_cargo").html(receta.cargo);
                        $("#medico_cel").html('Cel:. '+receta.telefono);
                        $("#nombre_paciente").html(receta.paciente);
                        $("#fecha_paciente").html(receta.fecha);
                        $("#edad_paciente").html(receta.edad_paciente);
                        $("#div_receta").html("<h1>℞. </h1> "+receta.descripcion_receta);
                        $("#div_checkbox_peciente_atendido").html(
                            '<input type="checkbox" id="checkboxPacienteAtendido" onclick="paciente_atendido('+id_receta+')" />'+
                                '<label for="checkboxPacienteAtendido">'+
                                    'Paciente atendido'+
                                '</label>');
                        if(receta.atendido_farmacia == null){
                            $('#checkboxPacienteAtendido').prop('checked', false);  
                        }else{
                            $('#checkboxPacienteAtendido').prop('checked', true);  
                        }
                        $("#modal_ver_receta").modal('show');
                        $("#btn_ver_receta").attr('disabled', false);
                    }
                    $(function() {
                        new PNotify({
                            title: titleMsg,
                            text: textMsg,
                            type: typeMsg,
                            shadow: true
                        });
                    });     
                },
                error: function(xhr, status, error){
                    alert(xhr.responseText);
                } 
            });
        }

        function paciente_atendido(id_receta){
            var checkboxPacienteAtendido = null;
            if($('#checkboxPacienteAtendido').is(':checked')){
                checkboxPacienteAtendido = 1;
            }else{
                checkboxPacienteAtendido = 0;
            }
            $.ajax({
                type: "post",
                url: url_paciente_atendido,
                data: {
                    'id_receta': id_receta,
                    'checkboxPacienteAtendido': checkboxPacienteAtendido,
                },
                success: function(data){
                    if(data.msgError != null){
                        titleMsg = "Error al cargar";
                        textMsg = data.msgError;
                        typeMsg = "error";
                        $('#checkboxPacienteAtendido').prop('checked', false);
                    }else{
                        table_recetas.ajax.reload();
                        if(accion == 1){
                          table_recetas_atendidas.ajax.reload();  
                        }
                        titleMsg = "Proceso exitoso";
                        textMsg = data.msgSuccess;
                        typeMsg = "success";
                    }
                    $(function() {
                        new PNotify({
                            title: titleMsg,
                            text: textMsg,
                            type: typeMsg,
                            shadow: true
                        });
                    });     
                },
                error: function(xhr, status, error){
                    alert(xhr.responseText);
                } 
            });
        }
        
    function printDiv() {
        
        console.log( $('#medico_cargo').val() )
        
        var divContents = $("modal_ver_receta").innerHTML;
        
         var receta = '<div class="card-body" style="display: block;">'+
                    '<div class="row">'+
                        '<div class="column side">'+
                            '<img src="https://centromedicodiaz.com/images/LOGO.png" width="150" height="80" />'+
                        '</div>'+
                        '<div class="column middle">'+
                            '<center>'+
                                '<h1>Centro Médico Díaz</h1>'+
                                '<ul class="list-unstyled">'+
                                    '<li>'+
                                        '<h4><strong id="medico">Dr (a): '+ receta_medica.medico +'</strong></h4>'+
                                    '</li>'+
                                    '<li id="medico_cargo">'+ receta_medica.cargo +'</li>'+
                                    '<li id="medico_cel">Cel:. '+ receta_medica.telefono +'</li>'+
                                '</ul>'+
                            '</center>'+
                        '</div>'+       
                    '</div>'+                    
                    '<br />'+
                    '<div class="row" >'+
                        '<table>'+
                            '<tr>'+
                              '<td><h5>Nombre del Paciente:<small class="text-muted"><ins id="nombre_paciente">'+ receta_medica.paciente +'</ins></small></h5></td>'+
                              '<td><h5>Fecha:<small class="text-muted"><ins id="nombre_paciente">'+ receta_medica.fecha +'</ins></small></h5></td>'+
                              '<td><h5>Edad:<small class="text-muted"><ins id="nombre_paciente">'+ receta_medica.edad_paciente +'</ins></small></h5></td>'+                              
                            '</tr>'+
                        '</table>'+
                    '</div>'+
                    '<div class="row solid" ></div>'+
                    '<br />'+
                    '<div class="row">'+
                        '<div class="col-md-12 col-sm-12">'+
                            '<div class="card w3-container w3-border w3-round-xlarge elevation-1">'+
                                '<div class="card-body" id="div_receta">'+
                                    '<h1>℞. </h1>'+  receta_medica.descripcion_receta +''+
                                '</div>'+
                           '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                
        var a = window.open('', '', 'height=500, width=500');
        a.document.write(
            '<!DOCTYPE html>'+
            '<html>'+
            '<head>'+
                '<meta charset="utf-8">'+
                '<meta http-equiv="X-UA-Compatible" content="IE=edge">'+
                '<meta name="viewport" content="width=device-width, initial-scale=1">'+
            '</head>'+
            '<style>'+
            '.w3-round-xlarge {'+
                'border-radius: 16px;'+
            '}'+
            '.w3-container, .w3-panel {'+
                'padding: 0.01em 16px;'+
            '}'+
            '.w3-border {'+
                'border: 1px solid #ccc!important;'+
            '}'+
            'li {'+
                'display: block;'+
            '}'+
            'table {'+
                'border-collapse: collapse;'+
                'width: 100%;'+
              '}'+
             ' th, td {'+
               ' padding: 8px;'+
                'text-align: left;'+
                'border-bottom: 1px solid #ddd;'+
              '}'+
              '.solid {'+
                'border-style: solid;'+                
                'border-bottom: 1px solid #ddd;'+
              '}'+
              'h1 ,h4 ,h5 {'+
                'font-family: Arial, Helvetica, sans-serif;'+
              '}'+
              '.column {'+
                'float: left;'+
                'padding: 10px;'+
              '}'+
              '.column.side {'+
                'width: 25%;'+
              '}'+
              '.column.middle {'+
                'width: 50%;'+
              '}'+
            '</style>'+
            '<body>'    );        
        a.document.write( receta );
        a.document.write("</body></html>");
        a.document.close();
        a.print();
    }

</script>
@endsection