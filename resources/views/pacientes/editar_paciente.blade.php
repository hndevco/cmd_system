@extends('layouts.menu')
@section('scriptsCSS')

@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card text-left">
                  <div class="card-body">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4"><i class="fas fa-hospital-user"></i><b> Perfil del paciente</b></h1>
                            <p class="lead">Editar información del paciente.</p>
                            <a class="btn btn-primary" id="btn_volver" href="{{route('vista_recepcion')}}">Volver</a>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="card card-info">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i> Información del paciente
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" id="btn-actualizar-paciente" class="btn btn-success"
                                            ><i class="fas fa-save"></i> Actualizar información</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @foreach ($info_paciente as $p)
                        
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="primer_nombre" class="col-form-label">Primer nombre (*):</label>
                                    <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="{{$p->primer_nombre}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="segundo_nombre" class="col-form-label">Segundo nombre:</label>
                                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" value="{{$p->segundo_nombre}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="primer_apellido" class="col-form-label">Primer apellido (*):</label>
                                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{$p->primer_apellido}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="segundo_apellido" class="col-form-label">Segundo apellido:</label>
                                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"  value="{{$p->segundo_apellido}}">
                                </div>
                            </div>
        
                        </div>
                        <hr>
                        <div class="row">
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Número de identidad:</label>
                                    <div class="input-group">
        
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-id-card"></i></div>
                                        </div>
                                        <input type="text" name="identidad" id="identidad" class="form-control" placeholder="1503199907851"  value="{{$p->identidad}}">
                                    </div>
                                    <small>Número de identidad sin guiones (-)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha nacimiento (*):</label>
                                    <div class="input-group date" id="reservationdatetime">
        
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{$p->fecha_nacimiento}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Número de teléfono (*):</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                        </div>
                                        <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="96998844"
                                            pattern="[0-9]{4}-[0-9]{4}"  value="{{$p->telefono}}">
                                    </div>
                                    <small>Número de teléfono sin guiones (-)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Género (*):</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-genderless"></i></div>
                                        </div>
                                        <select id="sexo" name="sexo" class="form-control">
                                            <option ></option>
                                            <option value="F"@if ($p->sexo== 'Femenino')
                                                selected
                                            @endif>Femenino</option>

                                            <option value="M" @if ($p->sexo== 'Masculino')
                                                selected
                                            @endif>Masculino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="domicilio" class="col-form-label">Dirección (*): </label>
                                    <textarea class="form-control" id="domicilio" name="domicilio"
                                        placeholder="Barrio El Estadio"  >{{$p->domicilio}}</textarea>
                                    <small>Barrio o Colonia</small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del padre:</label>
                                    <div class="input-group">
        
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-male"></i></div>
                                        </div>
                                        <input type="text" name="nombre_padre" id="nombre_padre" class="form-control" value="{{$p->nombre_padre}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre de la madre:</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-female"></i></div>
                                        </div>
                                        <input type="text" name="nombre_madre" id="nombre_madre" class="form-control"  value="{{$p->nombre_madre}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del tutor:</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" name="nombre_tutor" id="nombre_tutor" class="form-control"  value="{{$p->nombre_tutor}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var url_update_info_paciente = "{{route('update_informacion_paciente')}}";
        var id_paciente = "{{$p->id}}";
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

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        $('#identidad').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g,'');
        });
        $('#telefono').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g,'');
        });
        $("#btn-actualizar-paciente").on("click", function(){
                //console.log("fantasma de la opera")
                
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

                /*if (identidad == null || identidad == '') {
                
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
                }*/
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
                /*if (telefono == null || telefono == '') {
                
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
                }*/
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

                actualizar_paciente();

            });

            function actualizar_paciente(){
                $.ajax({
                type: "post",
                url: url_update_info_paciente,
                data: {
                    'id_paciente': id_paciente,
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
                        titleMsg = "Error al actualizar";
                        textMsg = data.msgError;
                        typeMsg = "error";
                    }else{
                        titleMsg = "Actualización exitosa";
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

    </script>
@endsection