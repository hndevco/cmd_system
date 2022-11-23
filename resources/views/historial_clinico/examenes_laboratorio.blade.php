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
                                <h1 class="display-4"><i class="nav-icon fas fa-flask"></i><b> Exámenes de Laboratorio</b></h1>
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
                            <i class="nav-icon fas fa-flask"></i> Exámenes de Laboratorio
                        </h3>
                        <div class="card-tools">
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        @if($lab_escribir_examen == '1')
                                        <button type="button" id="btn-subir-examen" class="btn btn-success" data-toggle="modal"
                                            data-target="#md-subir-examen"><i class="fas fa-upload"></i> Subir Nuevo Exámen</button>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tbl_historial_examenes" class="table table-hover dataTable dtr-inline">
                                    <thead class="">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Exámen</th>
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload"></i> Subir Nuevo Exámen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('examenes-laboratorio/subir-examen') }}" enctype="multipart/form-data" id="form">
                @csrf
                    <div class="row">
                        <input type="hidden" value="{{$id_paciente}}" name="id_paciente">
                        <input type="hidden" value="{{$id_remision}}" name="id_remision">
                        <input type="hidden" value="{{$id_expediente}}" name="id_expediente">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_examen" class="col-form-label">Descripción de exámen</label>
                                <input type="text" class="form-control" id="descripcion_examen" name="descripcion_examen" placeholder="Ejm: Hemograma Completo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input_archivo">Cargar exámen</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input_archivo" name="input_archivo" accept="application/pdf"/>
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
        var url_get_historial_examenes="{{url('/examenes-laboratorio-historial/paciente/')}}/{{$id_paciente}}/remision/{{$id_remision}}/expediente/{{$id_expediente}}";
        var url_subir_examen="/examenes-laboratorio/subir-examen";
        var table_paciente =null;
        var descripcion_examen = null;
        var input_archivo = null;
        var accion = null;
        var lab_escribir_examen = "{{$lab_escribir_examen}}";


        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
//alert(url_get_historial_clinico)
            table_paciente = $('#tbl_historial_examenes').DataTable({
                procesing: true,
                //reponsive:true,
                serverside: true,
                ajax: url_get_historial_examenes,
                columns:[
                    /*{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },*/
                    {data:'fecha'},
                    {data:'examen_laboratorio'},
                ],
                'language': languageOptionsDatatables,
                deferRender: true,
                "columnDefs": [
                    {
                        targets: 2,
                        data: null,
                        render: function(data, type, row, meta) {
                            //console.table(td);
                            
                            var btn_ver_examenes= "<a target='_blank' href='{{asset('pdf/examenes_laboratorio')}}/"+row.url_pdf+"' class='btn btn-sm btn-info' title='Ver Exámen'><i class='fas fa-file-pdf'></i> Ver Exámen</a>&nbsp;";
                            var btn_eliminar_examenes= '';
                            if(lab_escribir_examen == 1){
                                btn_eliminar_examenes= "<a href='javascript:eliminar_examen("+row.id+")' class='btn btn-sm btn-danger' id='btn_eliminar_examen' data-id=5 title='Ver Exámen'><i class='fas fa-trash'></i> Eliminar Exámen</a>";
                            }

                            return btn_ver_examenes + btn_eliminar_examenes;
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
                descripcion_examen = $("#descripcion_examen").val();
                input_archivo = $("#input_archivo").val();
                //console.log(identidad.length);
                
                if (descripcion_examen == null || descripcion_examen == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para Descripción de exámen',
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
            descripcion_examen = $("#descripcion_examen").val('');
            input_archivo = $("#input_archivo").val('');
        }

        function eliminar_examen(id){
            if (confirm('¿Realemente desea eliminar el exámen? ¡Imposible recuperar si se elimina!')) {
            
            window.location.href  = "{{url('examenes-laboratorio/eliminar-examen/id_examen/')}}/"+id+"";
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