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
                                <h1 class="display-4"><i class="nav-icon fas fa-book-medical"></i><b> Historial Clínico</b></h1>
                                    <blockquote class="quote-primary">
                                        <p><strong>Paciente:</strong> {{$paciente->nombre}}.
                                        <br><strong>Domicilio:</strong> {{$paciente->domicilio}}.
                                        <br><strong>Edad:</strong> {{$paciente->edad}}.</p>
                                        <small><strong>DNI:</strong> {{$paciente->identidad}} <cite title="Source Title"><strong> Sexo:</strong> {{$paciente->sexo}}</cite></small>
                                    </blockquote>
                                </p>
                            </div>
                        </div><a href="{{url('/historial-clinico-pacientes')}}/" type="button" class="btn btn-sm btn-success"><i class="nav-icon fas fa-hospital-user"></i> Regresar a Listado de Pacientes</a>
                    </div>
                </div>
                {{-- <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="nav-icon fas fa-book-medical"></i> Historial Clínico
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tbl_historial_clinico" class="table table-hover dataTable dtr-inline">
                                    <thead class="">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Área Remisión</th>
                                            <th>Médico</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
    
<div class="card-body table-responsive">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-book-medical"></i>
                        Historiales Médicos                        
                    </h3>
                    <!-- <div class="card-tools">
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    
                                    <button type="button" id="btn-subir-examen" class="btn btn-success" data-toggle="modal"
                                        data-target="#md-subir-expedinte_fisico"><i class="fas fa-upload"></i> Subir Expediente Físico</button>
                                    
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="card-body">                    
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">
                                Historial Clínico Digital
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">
                                Historial Clínico Físico
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-above-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="tbl_historial_clinico" class="table table-hover dataTable dtr-inline">
                                            <thead class="">
                                                <tr>
                                                    <th>Fecha</th>
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
                        <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                            <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                                <div class="card-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <table id="tbl_historial_clinico_fisico" class="table table-hover dataTable dtr-inline">
                                                <thead class="">
                                                    <tr>
                                                        <th>Descripcion Expediente Físico</th>
                                                        <th>Nombre Archivo</th>
                                                        <th>Fecha de Creacion</th>
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

<div class="modal fade bd-example-modal-lg" id="md-subir-expedinte_fisico" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-outline card-dark">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload"></i> Subir Expediente Físico
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('expediente-fisico/subir-expediente') }}" enctype="multipart/form-data" id="form">
                @csrf
                    <div class="row">
                        <input type="hidden" value="{{$paciente->id}}" name="id_paciente"/>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_examen" class="col-form-label">Descripción Expediente Físico</label>
                                <input type="text" class="form-control" id="descripcion_examen" name="descripcion_examen" placeholder="Ejm: Expediente General">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input_archivo">Cargar Expediente Físico</label>
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
        var url_get_historial_clinico="{{url('/historial-clinico/paciente/')}}/{{$paciente->id}}/historialclincio";
        var url_get_historial_clinico_fisico="{{url('/historial-clinico-fisico/paciente/')}}/{{$paciente->id}}/historialclinicofisico";
        var url_guardar_paciente="{{route('guardar_paciente')}}";
        var table_paciente =null; 
        var table_expediente_fisico =null;       
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
        var lab_leer_examen = "{{$lab_leer_examen}}";
        var accion = null;

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
//alert(url_get_historial_clinico)
            table_paciente = $('#tbl_historial_clinico').DataTable({
                procesing: true,
                //reponsive:true,
                serverside: true,
                ajax: url_get_historial_clinico,
                columns:[
                    /*{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },*/
                    {data:'fecha'},
                    {data:'area'},
                    {data:'medico'},
                ],
                'language': languageOptionsDatatables,
                deferRender: true,
                "columnDefs": [
                    {
                        targets: 3,
                        data: null,
                        render: function(data, type, row, meta) {
                            //console.table(td);
                            var btn_ver_expediente= "<a target='_blank' href='{{url('/')}}/historial-clinico/paciente/"+row.id_paciente+"/remision/"+row.id+"/expediente/"+row.id_area+"' class='btn btn-sm btn-info' title='Ver Expediente'><i class='fas fa-folder'></i> Expediente</a>&nbsp;";
                            var btn_ver_examenes= '';
                            if(lab_leer_examen == 1){
                                btn_ver_examenes= "<a target='_blank' href='{{url('/')}}/examenes-laboratorio/paciente/"+row.id_paciente+"/remision/"+row.id+"/expediente/"+row.id_area+"' class='btn btn-sm btn-success' title='Ver Exámenes de Laboratorio'><i class='fas fa-flask'></i> Exámenes</a>";
                            }
                            
                            return btn_ver_expediente;
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

            

            /* $('#tbl_historial_clinico_fisico tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table_expediente_fisico.row(tr);
                
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
            */
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

            $('#identidad').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g,'');
            });
            $('#telefono').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g,'');
            });


            $(".modal-footer").on("click", "#btn_guardar_paciente", function(){
                primer_nombre = $("#primer_nombre").val();
                segundo_nombre = $("#segundo_nombre").val();
                primer_apellido = $("#primer_apellido").val();
                segundo_apellido = $("#segundo_apellido").val();
                identidad = $("#identidad").val();
                fecha_nacimiento = $("#fecha_nacimiento").val();
                telefono =$("#telefono").val();
                genero = $("#sexo").val();
                domicilio = $("#domicilio").val();
                nombre_padre = $("#nombre_padre").val();
                nombre_madre = $("#nombre_madre").val();
                nombre_tutor = $("#nombre_tutor").val();
                //console.log(identidad.length);
                
                if (primer_nombre == null || primer_nombre == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para primer nombre',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }
                if (primer_apellido == null || primer_apellido == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para primer apellido',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }

                if (identidad == null || identidad == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para la identidad',
                        type: 'error',
                        shadow: true
                        });
                    });
                    

                return false;
                }else if(identidad.length != 13){
                    
                    $(function() {
                    new PNotify({
                            title: 'El valor no cumple las restricciones',
                            text: 'La identidad debe tener 13 digitos. Longitud ingresada: ' + identidad.length,
                            type: 'warning',
                            shadow: true
                        });
                    });
                return false;
                }
                if (fecha_nacimiento == null || fecha_nacimiento == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para fecha de nacimiento',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }
                if (telefono == null || telefono == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para el telefono',
                        type: 'error',
                        shadow: true
                        });
                    });
                    

                return false;
                }else if(telefono.length != 8){
                    
                    $(function() {
                    new PNotify({
                            title: 'El valor no cumple las restricciones',
                            text: 'El campo telefono, debe tener 8 digitos. Longitud ingresada: ' + telefono.length,
                            type: 'warning',
                            shadow: true
                        });
                    });
                return false;
                }
                if (genero == null || genero == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para el género',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }if (domicilio == null || domicilio == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para el domicilio',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }

                $('#btn_guardar_paciente').prop('disabled', true);
                guardar_paciente();

            });

            $("#tbl_pacientes tbody").on("click","#btn_remitir_paciente", function(){
                var tr = $(this).parents('tr');
                var row = table_paciente.row(tr);

                //console.table(row.data());
                var url_ver_exp_genicoligico = "{{url('/')}}/exp/ginecologico/paciente/"+row.data().id;
                var url_ver_exp_general= "{{url('/')}}/exp/general/paciente/"+row.data().id;
                var url_ver_exp_pediatrico = "{{url('/')}}/exp/pediatrico/paciente/"+row.data().id;

                var exp_edad = row.data().edad.slice(0,2);
                var exp_genero = row.data().sexo;


                //console.log(exp_edad);

                if(exp_edad < 18 && exp_genero == 'Femenino'){
                    $(".botones-expedientes").html('<a href="'+ url_ver_exp_genicoligico +'" class="btn btn-light" id="btn_exp_ginecologico" target="_blank"><i class="fas fa-female"></i> Ginecológico</a>'+
                                                '<a href="'+ url_ver_exp_pediatrico +'" class="btn btn-info" id="btn_exp_pediatrico" target="_blank"><i class="fas fa-baby"></i> Pediátrico</a>');
                }else if (exp_edad >= 18 && exp_genero == 'Femenino') {
                    $(".botones-expedientes").html('<a href="'+ url_ver_exp_general +'" class="btn btn-primary" id="btn_exp_general" target="_blank"><i class="fas fa-notes-medical"></i> General</a>'+
                                                    '<a href="'+ url_ver_exp_genicoligico +'" class="btn btn-light" id="btn_exp_ginecologico" target="_blank"><i class="fas fa-female"></i> Ginecológico</a>');
                } else if(exp_edad < 18 && exp_genero == 'Masculino'){
                    $(".botones-expedientes").html('<a href="'+ url_ver_exp_pediatrico +'" class="btn btn-info" id="btn_exp_pediatrico" target="_blank"><i class="fas fa-baby"></i> Pediátrico</a>');
                } else if (exp_edad >= 18 && exp_genero == 'Masculino'){
                    $(".botones-expedientes").html('<a href="'+ url_ver_exp_general +'" class="btn btn-primary" id="btn_exp_general" target="_blank"><i class="fas fa-notes-medical"></i> General</a>');
                }
                
                //<a href=""></a>

                /*numero_registro = row.data().numero_registro_asignado;
                id_matricula_seccion = row.data().id_matricula_seccion;
                estado = row.data().estado;*/
               // console.log(id_matricula_seccion);

                //habilitar_deshabilitar_matricula(); 
                             
            });

            


        });


        $('#custom-content-above-profile-tab').on('click', function () {
                if(accion == null){
                    accion = 1;
                    //alert(url_get_historial_clinico_fisico)
                        table_expediente_fisico = $('#tbl_historial_clinico_fisico').DataTable({
                            procesing: true,
                            reponsive:true,
                            serverside: true,
                            ajax: url_get_historial_clinico_fisico,
                            columns:[
                                /*{
                                    className: 'dt-control',
                                    orderable: false,
                                    data: null,
                                    defaultContent: '',
                                },*/
                                {data:'expediente_fisico'},
                                {data:'url_expediente_fisico'},
                                {data:'fecha_creacion'},
                            ],
                            'language': languageOptionsDatatables,
                            deferRender: true,
                            "columnDefs": [
                                {
                                    targets: 3,
                                    data: null,
                                    render: function(data, type, row, meta) {
                                        //console.table(td);                           
                                        var btn_ver_examenes= "<a target='_blank' href='{{asset('pdf/expediente_fisico')}}/"+row.url_expediente_fisico+"' class='btn btn-sm btn-info' title='Ver Expediente Fisico'><i class='fas fa-file-pdf'></i> Ver Expediente Fisico</a>&nbsp;";
                                        var btn_eliminar_examenes= '';
                                        btn_eliminar_examenes= "<a href='javascript:eliminar_examen("+row.id+")' class='btn btn-sm btn-danger' id='btn_eliminar_examen' data-id=5 title='Ver Expediente Fisico'><i class='fas fa-trash'></i> Eliminar Expediente Fisico</a>";
                                        
                                        return btn_ver_examenes; 
                                    }
                                }
                            ] 
                        });
                }
                
            });

        function guardar_paciente(){
            $.ajax({
                type: "post",
                url: url_guardar_paciente,
                data: {
                    'primer_nombre': primer_nombre,
                    'segundo_nombre': segundo_nombre, 
                    'primer_apellido': primer_apellido,
                    'segundo_apellido': segundo_apellido, 
                    'identidad': identidad,
                    'fecha_nacimiento': fecha_nacimiento, 
                    'telefono': telefono, 
                    'genero': genero, 
                    'domicilio': domicilio, 
                    'nombre_padre': nombre_padre, 
                    'nombre_madre': nombre_madre, 
                    'nombre_tutor': nombre_tutor,
                },
                success: function(data){
                    if(data.msgError != null){
                        titleMsg = "Error al guardar";
                        textMsg = data.msgError;
                        typeMsg = "error";
                    }else{
                        
                        
                        titleMsg = "Creación exitosa";
                        textMsg = data.msgSuccess;
                        typeMsg = "success";
                
                        

                        /*
                        |-------------------------------------------------|
                        |Funcion recargar SERVICIOS
                        |-------------------------------------------------|
                        */
                        table_paciente.ajax.reload(null, false);
                        $("#md-agregar-paciente").modal("hide");
                        limpiar_campos();
                        $('#btn_guardar_paciente').prop('disabled', false);
                        
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

        function eliminar_examen(id){
            if (confirm('¿Realemente desea eliminar el exámen? ¡Imposible recuperar si se elimina!')) {
            
            window.location.href  = "{{url('/expediente-fisico/eliminar-examen/id_examen/')}}/"+id+"";
            } else {
            
            }
        }

        function limpiar_campos(){
            primer_nombre = $("#primer_nombre").val('');
                segundo_nombre = $("#segundo_nombre").val('');
                primer_apellido = $("#primer_apellido").val('');
                segundo_apellido = $("#segundo_apellido").val('');
                identidad = $("#identidad").val('');
                fecha_nacimiento = $("#fecha_nacimiento").val('');
                telefono =$("#telefono").val('');
                genero = $("#sexo").val('');
                domicilio = $("#domicilio").val('');
                nombre_padre = $("#nombre_padre").val('');
                nombre_madre = $("#nombre_madre").val('');
                nombre_tutor = $("#nombre_tutor").val('');
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