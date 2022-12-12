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
                                <h1 class="display-4"><i class="nav-icon fas fa-copy"></i><b> Otros Archivos</b></h1>
                                    <blockquote class="quote-primary">
                                        <p><strong>Paciente:</strong> {{$paciente->nombre}}.
                                        <br><strong>Domicilio:</strong> {{$paciente->domicilio}}.
                                        <br><strong>Edad:</strong> {{$paciente->edad}}.</p>
                                        <small><strong>DNI:</strong> {{$paciente->identidad}} <cite title="Source Title"><strong> Sexo:</strong> {{$paciente->sexo}}</cite></small>
                                        <hr>
                                        <i class="fas fa-folder"></i>&nbsp;&nbsp; <small><cite title="Source Title"><strong> Fecha:</strong> {{$paciente->fecha}} </cite>&nbsp;&nbsp; <cite title="Source Title"><strong> Área Remisión:</strong> {{$paciente->area}}</cite>&nbsp;&nbsp; <cite title="Source Title"><strong> Médico:</strong> {{$paciente->medico}}</cite></small>
                                    </blockquote>
                                </p>
                            </div>
                        </div><a href="{{url('/archivos/paciente/')}}/{{$id_paciente}}" type="button" class="btn btn-sm btn-success"><i class="nav-icon fas fa-regular fa-folder-open"></i> Regresar a Archivos del Paciente</a>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="nav-icon fas fa-copy"></i> Otros Archivos
                        </h3>
                        <div class="card-tools">
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        @if($arc_subir_otros_archivos == '1')
                                        <button type="button" id="btn-subir-examen" class="btn btn-success" data-toggle="modal"
                                            data-target="#md-subir-examen"><i class="fas fa-upload"></i> Subir Nuevo Archivo</button>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tbl_historial_archivos" class="table table-hover dataTable dtr-inline">
                                    <thead class="">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Archivo</th>
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
<div class="modal fade bd-example-modal-lg" id="md-subir-examen" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-outline card-dark">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload"></i> Subir Nuevo Archivo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('archivos/subir-archivo') }}" enctype="multipart/form-data" id="form">
                @csrf
                    <div class="row">
                        <input type="hidden" value="{{$id_paciente}}" name="id_paciente">
                        <input type="hidden" value="{{$id_remision}}" name="id_remision">
                        <input type="hidden" value="{{$id_expediente}}" name="id_expediente">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_archivo" class="col-form-label">Descripción de archivo</label>
                                <input type="text" class="form-control" id="descripcion_archivo" name="descripcion_archivo" placeholder="Ejm: Imagen Radiografía">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input_archivo">Cargar archivo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input_archivo" name="input_archivo" >
                                        <label class="custom-file-label" for="input_archivo">Click aquí para cargar el archivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-loading-text="Subiendo..." id="btn_subir_archivo">Subir</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
        var url_get_archivos="{{url('/archivos-listado/paciente/')}}/{{$id_paciente}}/remision/{{$id_remision}}/expediente/{{$id_expediente}}";
        var url_subir_archivo="/archivos/subir-archivo";
        var table_paciente =null;
        var descripcion_archivo = null;
        var input_archivo = null;
        var accion = null;
        var arc_escribir_otros_archivos = "{{$arc_escribir_otros_archivos}}";
        var arc_ver_otros_archivos = "{{$arc_ver_otros_archivos}}";


        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
//alert(url_get_historial_clinico)
            table_paciente = $('#tbl_historial_archivos').DataTable({
                procesing: true,
                //reponsive:true,
                serverside: true,
                ajax: url_get_archivos,
                columns:[
                    /*{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },*/
                    {data:'fecha'},
                    {data:'descripcion_archivo'},
                ],
                'language': languageOptionsDatatables,
                deferRender: true,
                "columnDefs": [
                    {
                        targets: 2,
                        data: null,
                        render: function(data, type, row, meta) {
                            //console.table(td);
                            
                            var btn_descargar_archivo= '';
                            var btn_eliminar_archivoes= '';
                            if(arc_ver_otros_archivos == 1){
                                btn_descargar_archivo= "<a href='{{asset('archivos-descargar')}}/"+row.url_archivo+"' class='btn btn-sm btn-info' title='Descargar Archivo'><i class='fas fa-download'></i> Descargar Archivo</a>&nbsp;";
                            }
                            if(arc_escribir_otros_archivos == 1){
                                btn_eliminar_archivoes= "<a href='javascript:eliminar_archivo("+row.id+")' class='btn btn-sm btn-danger' id='btn_eliminar_archivo' data-id=5 title='Ver Archivo'><i class='fas fa-trash'></i> Eliminar Archivo</a>";
                            }

                            return btn_descargar_archivo + btn_eliminar_archivoes;
                        }
                    }
                ]



            });

           $('#tbl_historial_clinico tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table_paciente.row(tr);
                
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

            $('#identidad').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g,'');
            });
            $('#telefono').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g,'');
            });

            $(".modal-footer").on("click", "#btn_subir_archivo", function(){
                descripcion_archivo = $("#descripcion_archivo").val();
                input_archivo = $("#input_archivo").val();
                //console.log(identidad.length);
                
                if (descripcion_archivo == null || descripcion_archivo == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Descripción de archivo',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }
                if (input_archivo == null || input_archivo == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe cargar un archivo',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }

                $('#btn_subir_archivo').prop('disabled', true);
                var $btn = $('#btn_subir_archivo').button('loading')
                $('#form').submit();

            });


        });
        
        function limpiar_campos(){
            descripcion_archivo = $("#descripcion_archivo").val('');
            input_archivo = $("#input_archivo").val('');
        }

        function eliminar_archivo(id){
            if (confirm('¿Realemente desea eliminar el archivo? ¡Imposible recuperar si se elimina!')) {
            
            window.location.href  = "{{url('archivos-eliminar/archivo')}}/"+id+"";
            } else {
            
            }
        }
        function format(d) {
        // `d` is the original data object for the row
        return (
            '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                    '<td>Fecha de Nacimiento:</td>' +
                    '<td>' +
                        d.fecha_nacimiento +
                    '</td>' +'<tr>' +
                    '<td>Edad:</td>' +
                    '<td>' +
                        d.edad +
                    '</td>' +'<tr>' +
                    '<td>Nombre Padre:</td>' +
                    '<td>' +
                        d.nombre_padre +
                    '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>Nombre Madre:</td>' +
                    '<td>' +
                        d.nombre_madre +
                    '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>Nombre Tutor:</td>' +
                    '<td>' +
                        d.nombre_tutor +
                    '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>Domicilio:</td>' +
                    '<td>'+
                        d.domicilio    +
                    '</td>' +
                '</tr>' +
                '<tr>' +
                    '<td>Datos actualizados:</td>' +
                    '<td>'+
                        d.updated_at    +
                    '</td>' +
                '</tr>' +
                '</table>'
            );
        }

</script>
@endsection