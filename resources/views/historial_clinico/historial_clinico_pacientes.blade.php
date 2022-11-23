@extends('layouts.menu')
@section('scriptsCSS')
<style>
    .btn-ginecologico{
        color: #fff;
        background-color: #e83e8c!important;;
        border-color:#e83e8c!important;;
    }
</style>
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
                                        <p>Listado de Pacientes.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="nav-icon fas fa-hospital-user"></i> Listado de Pacientes
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tbl_pacientes" class="table table-hover dataTable dtr-inline">
                                    <thead class="">
                                        <tr>
                                            <th></th>
                                            <th>Identidad</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Teléfono</th>
                                            <th>Creado</th>
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

@endsection

@section('scripts')
<script>
        var url_get_paciente="{{route('obtener_lista_pacientes')}}";
        var url_guardar_paciente="{{route('guardar_paciente')}}";
        var table_paciente =null;
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
        var departamento = null;
        var municipio = null;

       


        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table_paciente = $('#tbl_pacientes').DataTable({
                procesing: true,
                //reponsive:true,
                serverside: true,
                ajax: url_get_paciente,
                columns:[
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {data:'identidad'},
                    {data:'nombre_completo'},
                    {data:'sexo'},
                    {data:'telefono'},
                    {data:'created_at'},
                ],
                'language': languageOptionsDatatables,
                deferRender: true,
                "columnDefs": [
                    {
                        targets: 6,
                        data: null,
                        render: function(data, type, row, meta) {
                            //console.table(td);
                            var btn_modificar_paciente= "<a href='{{url('/')}}/registro/modificar/paciente/"+row.id+"' class='btn btn-sm btn-info' title='Editar'><i class='fas fa-edit'></i></a>";
                            //var btn_remitir ="<button id='btn_remitir_paciente' class='btn btn-sm btn-warning' title='Remitir Paciente' data-toggle='modal' data-target='#md_remitir_paciente'><i class='fa fa-heartbeat' ></i></button>";                            
                            var btn_remitir ="<a href='{{url('/')}}/remisiones/"+row.id+"/paciente' id='btn_remitir_paciente' class='btn btn-sm btn-warning' title='Remitir Paciente' ><i class='fa fa-heartbeat'></i></a>";
                            var btn_historial_paciente ="<a href='{{url('/')}}/historial-clinico/paciente/"+row.id+"' id='btn_historial_paciente' class='btn btn-sm btn-success' title='Historial Clinico' ><i class='fas fa-book-medical'></i> Ver Historial Clínico</a>";
                            
                            return btn_historial_paciente;
                        }
                    }
                ]



            });

           $('#tbl_pacientes tbody').on('click', 'td.dt-control', function () {
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
                departamento = $("#input_departamento").val();
                municipio = $("#input_municipio").val();

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
                }
                if (domicilio == null || domicilio == '') {
                
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
                if (departamento == null || departamento == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para el departamento',
                        type: 'error',
                        shadow: true
                        });
                    });
                    return false;
                }
                if (municipio == null || municipio == '') {
                
                $(function() {
                    new PNotify({
                        title: 'Valor Requerido',
                        text: 'Debe especificar un valor para el municipio',
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

            obtener_departamentos_municipios();


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
                    'id_departamento': departamento,
                    'id_municipio': municipio
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
        function obtener_departamentos_municipios(){
            
            $.ajax({
                type: "GET",
                url: url_get_paciente,
                success: function(data){
                    //<console.log(data.deparmatento_municipios);
                    var id_departamento = null;
                    var list_departamentos = data.departamentos;
                    var list_municipios = data.deparmatento_municipios;
                    var listitemsdepartamento = '';
                    var listitemsMunicipio = '';
                    
                    //Mostrar option en blade
                    $.each(list_departamentos, function(key, value) {
                        listitemsdepartamento += '<option value=' + value.id + '>' + value.departamento + '</option>';
                    });
                    $('#input_departamento').append(listitemsdepartamento);
                    
                    
                    
                    $( "#input_departamento").change( function() {
                        id_departamento =  this.options[this.selectedIndex].value;
                        console.log(id_departamento);
                        
                        $('#input_municipio').empty().append('<option value=""> -- Seleccionar municipio -- </option>');
                        
                        $.each(list_municipios, function(key, value) {
                            
                            if(value.id_departamento == id_departamento){
                                
                                $('#input_municipio').append('<option value=' + value.id_municipio + '>' + value.municipio + '</option>');
                            }
                            
                        });
                        //$('#input_municipio').append(listitemsMunicipio);
                        
                    
                    });

                    
                    

                    
                },
                error: function(xhr, status, error){
                    alert(xhr.responseText);
                } 
            });
        }
        function vaciar_municipios(){
            $('#input_municipio option').remove();
        }

</script>
@endsection