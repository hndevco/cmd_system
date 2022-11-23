@extends('layouts.menu')
@section("scriptsCSS")
@endsection
@section('content')
<div class="right_col" role="main" >
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <img src="{{ asset('/images/LOGO.png') }}" width="150" height="80">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <center>
                            <h1>Centro Médico Díaz</h1>
                            <h4>Pediatría</h4>
                        </center> 
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <center>
                            <div class="color-palette-set">
                                <div @if($estado_edicion->estado_edicion == 1) class="bg-success color-palette"> @else class="bg-danger color-palette"> @endif <span>Periódo de Edición</span></div>
                                @if($estado_edicion->estado_edicion == 1)
                                    <div class="bg-success disabled color-palette"><span><i class="fas fa-unlock"></i> Activo</span></div>
                                @else
                                    <div class="bg-danger disabled color-palette"><span><i class="fas fa-lock"></i> Inactivo</span></div>
                                @endif 
                                <hr>
                                <div class="bg-info color-palette"><span>Estado de Expediente</span></div>
                                    <div class="bg-info disabled color-palette"><span> 
                                    @if($estado_edicion->id_estado_remision == 1) <i class="fas fa-clock"></i> 
                                    @elseif($estado_edicion->id_estado_remision == 2) <i class="fas fa-sync"></i> 
                                    @elseif($estado_edicion->id_estado_remision == 3) <i class="fas fa-eye"></i> 
                                    @elseif($estado_edicion->id_estado_remision == 4) <i class="fas fa-running"></i> 
                                    @else<i class="fas fa-check"></i> 
                                    @endif
                                    {{$estado_edicion->estado}} </span></div>
                                <!--<div class="bg-primary color-palette"><a type="button" href="{{url('/historial-clinico/paciente/')}}/{{$paciente->id}}" class="btn btn-block btn-primary btn-xs"><i class="fas fa-arrow-left"></i> Volver a Historial Clínco</a></div>-->
                            </div>
                        </center> 
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <h5>
                            Nombre: 
                            <small class="text-muted"><ins>{{$paciente->nombre}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Edad: 
                            <small class="text-muted"><ins>{{$paciente->edad}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Sexo: 
                            <small class="text-muted"><ins>{{$paciente->sexo}}</ins></small>
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <h5>
                            Dirección: 
                            <small class="text-muted"><ins>{{$paciente->domicilio}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Teléfono: 
                            <small class="text-muted"><ins>{{$paciente->telefono}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Identidad: 
                            <small class="text-muted"><ins>{{$paciente->identidad}}</ins></small>
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <h5>
                            Fecha: 
                            <small class="text-muted"><ins>{{$paciente->fecha}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Hora: 
                            <small class="text-muted"><ins>{{$paciente->hora}}</ins></small>
                        </h5>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h5>
                            Médico: 
                                <small class="text-muted"><ins>{{$receta->nombre}}</ins></small>
                        </h5>
                    </div>
                </div>
                <hr>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">SIGNOS VITALES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>

                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">T°</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->temperatura}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="C°" id="input_temperatura" aria-label="Username" aria-describedby="basic-addon1" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PA</span>
                                        </div>
                                        <input type="text" value="{{$signos_vitales->presion_arterial}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="mmHg" id="input_presion_arterial" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PESO</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->peso}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="kg" id="input_peso" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TALLA</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->talla}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="m" id="input_talla" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">SAT</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->saturacion}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="%" id="input_saturacion" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FC</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->frecuencia_cardiaca}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="X'" id="input_frecuencia_cardiaca" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FR</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->frecuencia_respiratoria}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="X'" id="input_frecuencia_respiratoria" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GMT</span>
                                        </div>
                                        <input type="number" value="{{$signos_vitales->glucometria}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" placeholder="mgdl" id="input_glocometria" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">CONSULTA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            MOTIVO DE LA CONSULTA (MC)
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="div_input_mc_ginecologia">
                                            <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_mc" rows="3" placeholder="Ingrese el diagnostico del paciente">{{$consulta_exp_pediatrico->motivo_consulta}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            HISTORIA DE ENFERMEDAD ACTUAL (HEA)
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="div_input_mc_ginecologia">
                                            <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif class="form-control" id="input_historia_enfermedad_actual" rows="3" placeholder="Ingrese el diagnostico del paciente">{{$consulta_exp_pediatrico->historia_enfermedad_actual}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES PERSONALES PATOLÓGICOS (APP)
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="app_radio" id="app_radio" onclick="app_radio(1)" @if($consulta_exp_pediatrico->antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->antecedentes_personales_patologicos == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="app_radio" id="app_radio" onclick="app_radio(0)" @if($consulta_exp_pediatrico->antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->antecedentes_personales_patologicos == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$consulta_exp_pediatrico->antecedentes_personales_patologicos}}" @if($estado_edicion->estado_edicion == 1 && ($consulta_exp_pediatrico->antecedentes_personales_patologicos != null || $consulta_exp_pediatrico->antecedentes_personales_patologicos != '')) @else disabled @endif id="input_app" placeholder="Describa aquí" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TRATAMIENTO (TX)
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="tx_radio" id="tx_radio" onclick="tx_radio(1)" @if($consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="tx_radio" id="tx_radio" onclick="tx_radio(0)" @if($consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == null || $consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos}}" @if($estado_edicion->estado_edicion == 1 && ($consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos != null || $consulta_exp_pediatrico->tratamiento_antecedentes_personales_patologicos != '')) @else disabled @endif id="input_tx" placeholder="Describa aquí" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES FAMILIARES PATOLÓGICOS (AFP)
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="afp_radio" id="afp_radio" onclick="afp_radio(1)" @if($consulta_exp_pediatrico->antecedentes_familiares_patologicos == null || $consulta_exp_pediatrico->antecedentes_familiares_patologicos == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="afp_radio" id="afp_radio" onclick="afp_radio(0)" @if($consulta_exp_pediatrico->antecedentes_familiares_patologicos == null || $consulta_exp_pediatrico->antecedentes_familiares_patologicos == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$consulta_exp_pediatrico->antecedentes_familiares_patologicos}}" @if($estado_edicion->estado_edicion == 1 && ($consulta_exp_pediatrico->antecedentes_familiares_patologicos != null || $consulta_exp_pediatrico->antecedentes_familiares_patologicos != '')) @else disabled @endif id="input_afp" placeholder="Describa aquí" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES HOSPITALARIOS Y QUIRÚRGICOS (AHxTxQx)
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(1)" @if($consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == null || $consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(0)" @if($consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == null || $consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos}}" @if($estado_edicion->estado_edicion == 1 && ($consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos != null || $consulta_exp_pediatrico->antecedentes_hospitalarios_quirurgicos != '')) @else disabled @endif id="input_AHxTxQx" placeholder="Describa aquí" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">INMUNIZACIÓN</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$consulta_exp_pediatrico->inmunizacion}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_inmunizacion" placeholder="Describa aquí" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            ALERGIAS
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="alergias_radio" id="alergias_radio" onclick="alergias_radio(1)" @if($consulta_exp_pediatrico->tipo_alergia == null || $consulta_exp_pediatrico->tipo_alergia == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="alergias_radio" id="alergias_radio" onclick="alergias_radio(0)" @if($consulta_exp_pediatrico->tipo_alergia == null || $consulta_exp_pediatrico->tipo_alergia == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_alergias" rows="3" placeholder="Describa aquí">{{$consulta_exp_pediatrico->tipo_alergia }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">ANTECEDENTES PRENATALES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NOMBRE </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$antecendentes_prenatales->nombre_madre}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_nombre_madre" placeholder="Nombre de la madre" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">EDAD </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$antecendentes_prenatales->edad}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_edad_madre" placeholder="Edad de la madre" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TIPO DE SANGRE</span>
                                        </div>
                                        <select class="custom-select" id="input_tipo_sangre" @if($estado_edicion->estado_edicion == 1) @else disabled @endif>
                                            <option selected disabled>Elija una opcion</option>
                                            @foreach($tipos_sangre as $row_ts)
                                            <option value="{{$row_ts->id}}">{{$row_ts->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            ENFERMEDADES DURANTE EL EMBARAZO
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="enfer_durante_embarazo_radio" id="enfer_durante_embarazo_radio" onclick="enfer_durante_embarazo_radio(1)" @if($antecendentes_prenatales->enfermedades_durante_embarazo == null || $consulta_exp_pediatrico->tipo_alergia == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="enfer_durante_embarazo_radio" id="enfer_durante_embarazo_radio" onclick="enfer_durante_embarazo_radio(0)" @if($antecendentes_prenatales->enfermedades_durante_embarazo == null || $consulta_exp_pediatrico->tipo_alergia == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_enfer_durante_embarazo" rows="3" placeholder="Describa las enfermedades">{{$consulta_exp_pediatrico->tipo_alergia}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NÚMERO DE GESTAS PREVIAS (G) </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$antecendentes_prenatales->gestas}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_numero_gestas_previas" placeholder="¿Cuántas gestas previas?" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NÚMERO DE PARTOS (P) </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$antecendentes_prenatales->partos}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_numero_partos" placeholder="¿Cuántos partos?" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NÚMERO DE CESAREAS (C) </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$antecendentes_prenatales->cesarias}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_numero_cesareas" placeholder="¿Cuántas cesareas?" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">CONTROL PRENATAL DEL ÚLTIMO EMBARAZO (CPN) </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$antecendentes_prenatales->control_prenatal_ultimo_embarazo}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_numero_control_prenatal_utlimo_parto" placeholder="¿Cuántos controles?" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">NATALICIO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NACE EN </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$natalicio->lugar_nacimiento}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_nace_en" placeholder="¿Dónde nació el bebé?" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">APGAR </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$natalicio->apgar}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_apgar" placeholder="Datos" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PESO </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$natalicio->peso}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_peso_natalicio" placeholder="g" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TALLA </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$natalicio->talla}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_talla_natalicio" placeholder="cm" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PERÍMETRO CEFÁLICO (PC) </span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$natalicio->perimetro_cefalico}}" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_perimetro_cefalico" placeholder="cm" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TIPO DE PARTO </span>
                                        </div>
                                        <select class="custom-select" id="input_tipo_parto" @if($estado_edicion->estado_edicion == 1) @else disabled @endif>
                                            <option selected disabled>Elija una opcion</option>
                                            @foreach($tipos_partos as $row_tp)
                                            <option value="{{$row_tp->id}}">{{$row_tp->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            COMPLICACIONES EN PARTO
                                            @if($estado_edicion->estado_edicion == 1)
                                                &nbsp;&nbsp;<input type="radio" name="complicaciones_parto_radio" id="complicaciones_parto_radio" onclick="complicaciones_parto_radio(1)" @if($natalicio->complicaciones_parto == null || $natalicio->complicaciones_parto == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="complicaciones_parto_radio" id="complicaciones_parto_radio" onclick="complicaciones_parto_radio(0)" @if($natalicio->complicaciones_parto == null || $natalicio->complicaciones_parto == '') checked @else @endif aria-label="Radio button for following text input"> No
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_complicaciones_parto" rows="3" placeholder="¿Qué complicaciones presentó?">{{$natalicio->complicaciones_parto}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">DESARROLLO PSICOMOTOR</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>-->
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxSonrio" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->sonrio == true) checked @else @endif>
                                                    <label for="checkboxSonrio" value="1">
                                                    Sonrió
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxSostuvoCabeza" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->sostuvo_cabeza == true) checked @else @endif>
                                                    <label for="checkboxSostuvoCabeza">
                                                    Sostuvo Cabeza
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxSeSento" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->se_sento == true) checked @else @endif>
                                                    <label for="checkboxSeSento">
                                                    Se Sentó
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxSeParo" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->se_paro == true) checked @else @endif>
                                                    <label for="checkboxSeParo">
                                                    Se Paró
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxCaminoSolo" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->comino_solo == true) checked @else @endif>
                                                    <label for="checkboxCaminoSolo">
                                                    Camino Solo
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxHabla" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->habla == true) checked @else @endif>
                                                    <label for="checkboxHabla">
                                                    Habla
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-outline">
                                                    <input type="checkbox" id="checkboxControlEsfinteres" @if($estado_edicion->estado_edicion == 1) @else disabled @endif @if($desarrollo_psicomotor->control_esfinteres == true) checked @else @endif>
                                                    <label for="checkboxControlEsfinteres">
                                                    Control Esfínteres
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                                <h5 class="card-title">
                                                    ESCOLARIDAD ACTUAL
                                                    @if($estado_edicion->estado_edicion == 1)
                                                        &nbsp;&nbsp;<input type="radio" name="escolaridad_acual_radio" id="escolaridad_acual_radio" onclick="escolaridad_acual_radio(1)" @if($desarrollo_psicomotor->escolaridad_actual == null || $desarrollo_psicomotor->escolaridad_actual == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                                        &nbsp;&nbsp;<input type="radio" name="escolaridad_acual_radio" id="escolaridad_acual_radio" onclick="escolaridad_acual_radio(0)" @if($desarrollo_psicomotor->escolaridad_actual == null || $desarrollo_psicomotor->escolaridad_actual == '') checked @else @endif aria-label="Radio button for following text input"> No
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_escolaridad_actual" rows="3" placeholder="¿Cual escolaridad?">{{$desarrollo_psicomotor->escolaridad_actual}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">LACTANCIA
                                    @if($estado_edicion->estado_edicion == 1)
                                        &nbsp;&nbsp;<input type="radio" name="lactancia_radio" id="lactancia_radio" onclick="lactancia_radio(1)" @if($lactancia->ablactacion == null || $lactancia->ablactacion == '') @else checked @endif aria-label="Radio button for following text input"> Si
                                        &nbsp;&nbsp;<input type="radio" name="lactancia_radio" id="lactancia_radio" onclick="lactancia_radio(0)" @if($lactancia->ablactacion == null || $lactancia->ablactacion == '') checked @else @endif aria-label="Radio button for following text input"> No
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>-->
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group clearfix text-left pull left">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="icheck-primary">
                                                            <input type="radio" id="checkboxMaterna" name="lactancia" @if($estado_edicion->estado_edicion == 1 && ($lactancia->ablactacion != null || $lactancia->ablactacion != '')) @else disabled @endif @if($lactancia->lactancia_materna == true && $lactancia->lactancia_artificial == false) checked @else @endif>
                                                            <label for="checkboxMaterna">
                                                            Materna
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="icheck-primary text-center pull center">
                                                            <input type="radio" id="checkboxArtificial" name="lactancia" @if($estado_edicion->estado_edicion == 1 && ($lactancia->ablactacion != null || $lactancia->ablactacion != '')) @else disabled @endif @if($lactancia->lactancia_materna == false && $lactancia->lactancia_artificial == true) checked @else @endif>
                                                            <label for="checkboxArtificial">
                                                            Artificial
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="icheck-primary  text-right pull right">
                                                            <input type="radio" id="checkboxMixta" name="lactancia" @if($estado_edicion->estado_edicion == 1 && ($lactancia->ablactacion != null || $lactancia->ablactacion != '')) @else disabled @endif @if($lactancia->lactancia_materna == true && $lactancia->lactancia_artificial == true) checked @else @endif>
                                                            <label for="checkboxMixta">
                                                            Mixta
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                                <h5 class="card-title">
                                                    ABLACTACIÓN
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1 && ($lactancia->ablactacion != null || $lactancia->ablactacion != '')) @else disabled @endif id="input_ablactacion" rows="3" placeholder="Describa la primera comida">{{$lactancia->ablactacion}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                                <h5 class="card-title">
                                                    ALIMENTACIÓN ACTUAL
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1 && ($lactancia->alimentacion_actual != null || $lactancia->alimentacion_actual != '')) @else disabled @endif id="input_alimentacion_actual" rows="3" placeholder="Describa la alimentación Actual">{{$lactancia->alimentacion_actual}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">EXAMEN FÍSICO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_examen_fisico" rows="3" placeholder="Describa el examen físico">{{$exa_fisico_diagnostico_indicaciones->examen_fisico}}</textarea>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">DIAGNÓSTICO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_diagnostico" rows="3" placeholder="Escriba el diagnóstico">{{$exa_fisico_diagnostico_indicaciones->diagnostico}}</textarea>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">INDICACIONES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif id="input_indicaciones" rows="3" placeholder="Esciba las indicaciones">{{$exa_fisico_diagnostico_indicaciones->indicaciones}}</textarea>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">RECETA MÉDICA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>

                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <img src="{{ asset('/images/LOGO.png') }}" width="150" height="80">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <center>
                                    <h1>Centro Médico Díaz</h1>
                                    <ul class="list-unstyled">
                                    @foreach ($medico as $row2)
                                        <li><h4><strong>Dr (a). {{$row2->nombre}}</strong></h4></li>
                                        <li>{{$row2->cargo}}</li>
                                        <li>Cel.: {{$row2->celular}}</h2>
                                    @endforeach
                                    </ul>
                                </center> 
                            </div>
                            <div class="col-md-2 col-sm-2">

                            </div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-dark progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>
                        <div class="progress progress-xxs">
                            <div class="progress-bar bg-light progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>
                        <div class="progress progress-xxs">
                            <div class="progress-bar bg-dark progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <h5>
                                    Nombre del Paciente: 
                                    <small class="text-muted"><ins>{{$paciente->nombre}}</ins></small>
                                </h5>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <h5>
                                    Fecha: 
                                    <small class="text-muted"><ins>{{$paciente->fecha}}</ins></small>
                                </h5>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <h5>
                                    Edad: 
                                    <small class="text-muted"><ins>{{$paciente->edad}}</ins></small>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <textarea class="form-control" @if($estado_edicion->estado_edicion == 1) @else disabled @endif  id="input_receta" rows="5" placeholder="Px">{{$receta->descripcion_receta}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="actions" class="row">
                        <div class="col-lg-12">
                            <div class="btn-group w-100">
                            <a type="button" href="{{url('/historial-clinico/paciente/')}}/{{$paciente->id}}" class="btn btn-primary col start"><i class="fas fa-arrow-left"></i> Volver a Historial Clínco</a>
                            @if($estado_edicion->estado_edicion == 1)
                                <button type="submit" class="btn btn-warning col start" id="btn_editar_expediente">
                                    <i class="fas fa-save"></i>
                                    <span>Editar</span>
                                </button>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("scripts")

<script type="text/javascript">
    var url_guardar_expediente = "{{url('/exp/pediatrico/paciente')}}/guardar";
    var validar = 1;
    var id_remision = {{$receta->id_remision}};
    var campo = null;
    var accion = 2;
    var id_paciente = {{$paciente->id}};
    var sub_siguiente = {{$sub_siguiente->existe}};
    var estado_edicion = {{$estado_edicion->estado_edicion}}
    var temperatura = null;
    var presion_arteria = null;
    var peso = null;
    var talla = null;
    var saturacion = null;
    var frecuencia_cardiaca = null;
    var frecuencia_respiratoria = null;
    var glucometria = null;
    var gestas = null;
    var partos = null;
    var cesareas = null;
    var abortos = null;
    var hijos_vivos = null;
    var hijos_muertos = null;
    var fecha_ultimo_parto = null;
    var inmunizacion = null;
    var fecha_ultima_menstruacion = null;
    var fum_desconoce = null;
    var fpp = null;
    var citologia = null;
    var planificaion_familiar = null;
    var vaginosis = null;
    var infeccion_tracto_urinario = null;
    var prurito = null;
    var menarquia = null;
    var inicio_vida_sexual = null;
    var numero_parejas_sexuales = null;
    var enfermedad_transmision_sexual = null;
    var vida_sexual_activa = null;
    var antecedentes_personales_patologicos = null;
    var tratamientos = null;
    var afp = null;
    var antecedentes_inmunoalergicos = null;
    var habitos = null;
    var antecedentes_hospitalarios_quirurgicos = null;
    var mc_ginecologica = null;
    var mc_semanas_gestacionales = null;
    var mc_examenes = null;
    var mc_notas = null;
    var historia_enfermedad_actual = null;
    var motivo_consulta = null;
    //inicia antecedentes prenatales
    var nombre_madre = null;
    var edad_madre = null;
    var tipo_sangre = null;
    var enfer_durante_embarazo = null;
    var numero_gestas_previas = null;
    var numero_partos = null;
    var numero_cesareas = null;
    var numero_control_prenatal_utlimo_parto = null;
    //finaliza antecedentes prenatales
    //inicia natalicio
    var nace_en = null;
    var apgar = null;
    var peso_natalicio = null;
    var talla_natalicio = null;
    var perimetro_cefalico = null;
    var tipo_parto = null;
    var complicaciones_parto = null;
    //finaliza natalicio
    //inicia desarrollo psicomotor
    var checkboxSonrio = null;
    var checkboxSostuvoCabeza = null;
    var checkboxSeSento = null;
    var checkboxSeParo = null;
    var checkboxCaminoSolo = null;
    var checkboxHabla = null;
    var checkboxControlEsfinteres = null;
    var escolaridad_actual = null;
    //finaliza desarrollo psicomotor
    //inicia lactancia
    var checkboxMaterna = null;
    var checkboxArtificial = null;
    var checkboxMixta = null;
    var input_ablactacion = null;
    var input_alimentacion_actual = null;
    //finaliza lactancia
    //inicia examen fisico
    var examen_fisico = null;
    //finaliza examen fisico
    //inicia examen diagnostico
    var examen_diagnostico = null;
    //finaliza examen diagnostico
    //inicia examen indicaciones
    var examen_indicaciones = null;
    //finaliza examen indicaciones
    var receta = null;

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $("#input_tipo_sangre").val("{{$antecendentes_prenatales->id_tipo_sangre}}");
        $("#input_tipo_parto").val("{{$natalicio->id_tipo_parto}}");

        $("#btn_editar_expediente").on( "click", function () {
            //inicia sigons vitales
            temperatura = $("#input_temperatura").val();
            presion_arterial = $("#input_presion_arterial").val();
            peso = $("#input_peso").val();
            talla = $("#input_talla").val();
            saturacion = $("#input_saturacion").val();
            frecuencia_cardiaca = $("#input_frecuencia_cardiaca").val();
            frecuencia_respiratoria = $("#input_frecuencia_respiratoria").val();
            glucometria = $("#input_glocometria").val();
            //finaliza sigons vitales
            //inicia antecedentes gineco-obtetricos
            historia_enfermedad_actual = $("#input_historia_enfermedad_actual").val();
            motivo_consulta = $("#input_mc").val();
            inmunizacion = $("#input_inmunizacion").val();
            alergias = $("#input_alergias").val();
            antecedentes_personales_patologicos = $("#input_app").val();
            tratamientos = $("#input_tx").val();
            afp = $("#input_afp").val();
            antecedentes_hospitalarios_quirurgicos = $("#input_AHxTxQx").val();
            //finaliza antecedentes gineco-obtetricos
            //inicia antecedentes prenatales
            nombre_madre = $("#input_nombre_madre").val();
            edad_madre = $("#input_edad_madre").val();
            tipo_sangre = $("#input_tipo_sangre").val();
            enfer_durante_embarazo = $("#input_enfer_durante_embarazo").val();
            numero_gestas_previas = $("#input_numero_gestas_previas").val();
            numero_partos = $("#input_numero_partos").val();
            numero_cesareas = $("#input_numero_cesareas").val();
            numero_control_prenatal_utlimo_parto = $("#input_numero_control_prenatal_utlimo_parto").val();
            //finaliza antecedentes prenatales
            //inicia natalicio
            nace_en = $("#input_nace_en").val();
            apgar = $("#input_apgar").val();
            peso_natalicio = $("#input_peso_natalicio").val();
            talla_natalicio = $("#input_talla_natalicio").val();
            perimetro_cefalico = $("#input_perimetro_cefalico").val();
            tipo_parto = $("#input_tipo_parto").val();
            complicaciones_parto = $("#input_complicaciones_parto").val();
            //finaliza natalicio
            //inicia desarrollo psicomotor
            if($('#checkboxSonrio').is(':checked')){
                checkboxSonrio = true;
            }else{
                checkboxSonrio = false;
            }
            if($('#checkboxSostuvoCabeza').is(':checked')){
                checkboxSostuvoCabeza = true;
            }else{
                checkboxSostuvoCabeza = false;
            }
            if($('#checkboxSeSento').is(':checked')){
                checkboxSeSento = true;
            }else{
                checkboxSeSento = false;
            }
            if($('#checkboxSeParo').is(':checked')){
                checkboxSeParo = true;
            }else{
                checkboxSeParo = false;
            }
            if($('#checkboxCaminoSolo').is(':checked')){
                checkboxCaminoSolo = true;
            }else{
                checkboxCaminoSolo = false;
            }
            if($('#checkboxHabla').is(':checked')){
                checkboxHabla = true;
            }else{
                checkboxHabla = false;
            }
            if($('#checkboxControlEsfinteres').is(':checked')){
                checkboxControlEsfinteres = true;
            }else{
                checkboxControlEsfinteres = false;
            }
            escolaridad_actual = $("#input_escolaridad_actual").val();
            //finaliza desarrollo psicomotor
            //inicia lactancia
            if($('#checkboxMaterna').is(':checked')){
                checkboxMaterna = true;
            }else{
                checkboxMaterna = false;
            }
            if($('#checkboxArtificial').is(':checked')){
                checkboxArtificial = true;
            }else{
                checkboxArtificial = false;
            }
            if($('#checkboxMixta').is(':checked')){
                checkboxMixta = true;
            }else{
                checkboxMixta = false;
            }
            ablactacion = $("#input_ablactacion").val();
            alimentacion_actual = $("#input_alimentacion_actual").val();
            //finaliza lactancia
            //inicia examen fisico
            examen_fisico = $("#input_examen_fisico").val();
            //finaliza examen fisico
            //inicia diagnostico
            diagnostico = $("#input_diagnostico").val();
            //finaliza diagnostico
            //inicia indicaciones
            indicaciones = $("#input_indicaciones").val();
            //finaliza indicaciones
            receta = $("#input_receta").val();

            if(temperatura == null || temperatura == ''){
                $('#input_temperatura').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Temperatura";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_temperatura').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(presion_arterial == null || presion_arterial == ''){
                $('#input_presion_arterial').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Presion Arterial";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_presion_arterial').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(peso == null || peso == ''){
                $('#input_peso').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Peso";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_peso').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(talla == null || talla == ''){
                $('#input_talla').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Talla";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_talla').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(saturacion == null || saturacion == ''){
                $('#input_saturacion').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Saturacion";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_saturacion').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(frecuencia_cardiaca == null || frecuencia_cardiaca == ''){
                $('#input_frecuencia_cardiaca').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Frecuencia Cardiaca";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_frecuencia_cardiaca').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(frecuencia_respiratoria == null || frecuencia_respiratoria == ''){
                $('#input_frecuencia_respiratoria').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Frecuencia Respiratoria";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_frecuencia_respiratoria').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            // if(glucometria == null || glucometria == ''){
            //     $('#input_glocometria').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Glucometria";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_glocometria').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            if(inmunizacion == null || inmunizacion == ''){
                $('#input_inmunizacion').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Inmunizacion";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_inmunizacion').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_alergias").prop('disabled') == false && (alergias == null || alergias == '')){
                $('#input_alergias').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Alergias";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_alergias').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_app").prop('disabled') == false && (antecedentes_personales_patologicos == null || antecedentes_personales_patologicos == '')){
                $('#input_app').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Antecedentes Personales Patologicos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_app').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_tx").prop('disabled') == false && (tratamientos == null || tratamientos == '')){
                $('#input_tx').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Tratamiento";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_tx').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_afp").prop('disabled') == false && (afp == null || afp == '')){
                $('#input_afp').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "AFP";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_afp').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }  validar = validar * 1;

            if($("#input_AHxTxQx").prop('disabled') == false && (antecedentes_hospitalarios_quirurgicos == null || antecedentes_hospitalarios_quirurgicos == '')){
                $('#input_AHxTxQx').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Antecedentes Hospitalarios y Quirurgicos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_AHxTxQx').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_mc").prop('disabled') == false && (motivo_consulta == null || motivo_consulta == '')){
                $('#input_mc').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Motivo de la Consulta";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_historia_enfermedad_actual").prop('disabled') == false && (historia_enfermedad_actual == null || historia_enfermedad_actual == '')){
                $('#input_historia_enfermedad_actual').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Historia de Enfermedad Actual";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_historia_enfermedad_actual').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            //inicia antecedentes prenatales
            if(nombre_madre == null || nombre_madre == ''){
                $('#input_nombre_madre').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Nombre";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_nombre_madre').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(edad_madre == null || edad_madre == ''){
                $('#input_edad_madre').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Edad";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_edad_madre').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(tipo_sangre == null || tipo_sangre == ''){
                $('#input_tipo_sangre').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Tipo de Sangre";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_tipo_sangre').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_enfer_durante_embarazo").prop('disabled') == false && (enfer_durante_embarazo == null || enfer_durante_embarazo == '')){
                $('#input_enfer_durante_embarazo').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Enfermedades Durante el Embarazo";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_enfer_durante_embarazo').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(numero_gestas_previas == null || numero_gestas_previas == ''){
                $('#input_numero_gestas_previas').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Numero de Gestas Previas";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_numero_gestas_previas').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(numero_partos == null || numero_partos == ''){
                $('#input_numero_partos').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Numero de Partos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_numero_partos').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(numero_cesareas == null || numero_cesareas == ''){
                $('#input_numero_cesareas').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Numero de Cesareas";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_numero_cesareas').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(numero_control_prenatal_utlimo_parto == null || numero_control_prenatal_utlimo_parto == ''){
                $('#input_numero_control_prenatal_utlimo_parto').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Numero de Control Prenatal del Ultimo Parto";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_numero_control_prenatal_utlimo_parto').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza antecedentes prenatales

            // //inicia natalicio
            // if(nace_en == null || nace_en == ''){
            //     $('#input_nace_en').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Nace En";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_nace_en').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(apgar == null || apgar == ''){
            //     $('#input_apgar').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "APGAR";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_apgar').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(peso_natalicio == null || peso_natalicio == ''){
            //     $('#input_peso_natalicio').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Peso Natalicio";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_peso_natalicio').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(talla_natalicio == null || talla_natalicio == ''){
            //     $('#input_talla_natalicio').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Talla Natalicio";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_talla_natalicio').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(perimetro_cefalico == null || perimetro_cefalico == ''){
            //     $('#input_perimetro_cefalico').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Perimetro Cefalico";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_perimetro_cefalico').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            if(tipo_parto == null || tipo_parto == ''){
                $('#input_tipo_parto').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Tipo de Parto";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_tipo_parto').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_complicaciones_parto").prop('disabled') == false && (complicaciones_parto == null || complicaciones_parto == '')){
                $('#input_complicaciones_parto').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Complicaciones en Parto";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_complicaciones_parto').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza natalicio

            //inicia escolaridad
            if($("#input_escolaridad_actual").prop('disabled') == false && (escolaridad_actual == null || escolaridad_actual == '')){
                $('#input_escolaridad_actual').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Escolaridad";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_escolaridad_actual').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza escolaridad

            //inicia lactancia
            if($("#input_ablactacion").prop('disabled') == false && (ablactacion == null || ablactacion == '')){
                $('#input_ablactacion').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Ablactacion";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_ablactacion').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_alimentacion_actual").prop('disabled') == false && (alimentacion_actual == null || alimentacion_actual == '')){
                $('#input_alimentacion_actual').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Alimentacion Actual";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_alimentacion_actual').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza lactancia

            //inicia examen fisico
            if(examen_fisico == null || examen_fisico == ''){
                $('#input_examen_fisico').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Examen Fisico";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_examen_fisico').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza examen fisico

            //inicia diagnostico
            if(diagnostico == null || diagnostico == ''){
                $('#input_diagnostico').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Diagnostico";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_diagnostico').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza diagnostico

            //inicia indicaciones
            if(indicaciones == null || indicaciones == ''){
                $('#input_indicaciones').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Indicaciones";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_indicaciones').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            //finaliza indicaciones

            // if(receta == null || receta == ''){
            //     $('#input_receta').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Receta";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_receta').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            $('#btn_editar_expediente').attr('disabled', true);
            guardar_expediente(); 
        });

        
    });

    function notificacion_validar_campos(campo){
        new PNotify({
            title: 'Valor Requerido',
            text: 'Debe especificar un valor para '+campo,
            type: 'warning',
            shadow: true
        });
    }

    function fum_radio(opc){
        if(opc == 1){
            $('#input_fum').attr('disabled', false);
        }else if(opc == 2){
            $('#input_fum').attr('disabled', true).val('');
            fum_desconoce = null;
        }else{
            $('#input_fum').attr('disabled', true).val('');
            fum_desconoce = true;
        }
        
    }

    function fpp_radio(opc){
        if(opc == 1){
            $('#input_fpp').attr('disabled', false);
        }else{
            $('#input_fpp').attr('disabled', true).val('');
        }
        
    }

    function pf_radio(opc){
        if(opc == 1){
            $('#input_pf').attr('disabled', false);
        }else{
            $('#input_pf').attr('disabled', true).val('');
        }
        
    }

    function vaginosis_radio(opc){
        if(opc == 1){
            $('#input_vaginosis').attr('disabled', false);
        }else{
            $('#input_vaginosis').attr('disabled', true).val('');
        }
        
    }

    function itu_radio(opc){
        if(opc == 1){
            $('#input_itu').attr('disabled', false);
        }else{
            $('#input_itu').attr('disabled', true).val('');
        }
        
    }

    function prurito_radio(opc){
        if(opc == 1){
            $('#input_prurito').attr('disabled', false);
        }else{
            $('#input_prurito').attr('disabled', true).val('');
        }
        
    }

    function menarquia_radio(opc){
        if(opc == 1){
            $('#input_menarquia').attr('disabled', false);
        }else{
            $('#input_menarquia').attr('disabled', true).val('');
        }
        
    }

    function ivs_radio(opc){
        if(opc == 1){
            $('#input_ivs').attr('disabled', false);
        }else{
            $('#input_ivs').attr('disabled', true).val('');
        }
        
    }

    function alergias_radio(opc){
        if(opc == 1){
            $('#input_alergias').attr('disabled', false);
        }else{
            $('#input_alergias').attr('disabled', true).val('');
        }
        
    }

    function app_radio(opc){
        if(opc == 1){
            $('#input_app').attr('disabled', false);
        }else{
            $('#input_app').attr('disabled', true).val('');
        }
        
    }

    function tx_radio(opc){
        if(opc == 1){
            $('#input_tx').attr('disabled', false);
        }else{
            $('#input_tx').attr('disabled', true).val('');
        }
        
    }

    function afp_radio(opc){
        if(opc == 1){
            $('#input_afp').attr('disabled', false);
        }else{
            $('#input_afp').attr('disabled', true).val('');
        }
        
    }

    function aia_radio(opc){
        if(opc == 1){
            $('#input_aia').attr('disabled', false);
        }else{
            $('#input_aia').attr('disabled', true).val('');
        }
        
    }

    function habitos_radio(opc){
        if(opc == 1){
            $('#input_habitos').attr('disabled', false);
        }else{
            $('#input_habitos').attr('disabled', true).val('');
        }
        
    }

    function AHxTxQx_radio(opc){
        if(opc == 1){
            $('#input_AHxTxQx').attr('disabled', false);
        }else{
            $('#input_AHxTxQx').attr('disabled', true).val('');
        }
        
    }

    function mc_radio(opc){
        if(opc == 1){
            $('#input_mc').attr('disabled', false);
            $('#div_input_mc_ginecologia').show();
            $('#div_input_mc_obtetrica').hide();
            $('#input_mc_obt_sg').attr('disabled', true).val('');
            $('#input_mc_obt_exa').attr('disabled', true).val('');
            $('#input_mc_obt_notas').attr('disabled', true).val('');
        }else{
            $('#input_mc').attr('disabled', true).val('');
            $('#div_input_mc_ginecologia').hide();
            $('#div_input_mc_obtetrica').show();
            $('#input_mc_obt_sg').attr('disabled', false);
            $('#input_mc_obt_exa').attr('disabled', false);
            $('#input_mc_obt_notas').attr('disabled', false);
        }
        
    }

    //inicia antecedentes prenatales
    function enfer_durante_embarazo_radio(opc){
        if(opc == 1){
            $('#input_enfer_durante_embarazo').attr('disabled', false);
        }else{
            $('#input_enfer_durante_embarazo').attr('disabled', true).val('');
        }
        
    }
    //finaliza antecedentes prenatales

    //inicia desarrollo psicomotor
    function escolaridad_acual_radio(opc){
        if(opc == 1){
            $('#input_escolaridad_actual').attr('disabled', false);
        }else{
            $('#input_escolaridad_actual').attr('disabled', true).val('');
        }
        
    }
    //finaliza desarrollo psicomotor

    //inicia natalicio
    function complicaciones_parto_radio(opc){
        if(opc == 1){
            $('#input_complicaciones_parto').attr('disabled', false);
        }else{
            $('#input_complicaciones_parto').attr('disabled', true).val('');
        }
        
    }
    //finaliza natalicio

    //inicia lactancia
    function lactancia_radio(opc){
        if(opc == 1){
            $('#checkboxMaterna').prop('checked', true);
            $('#checkboxMaterna').attr('disabled', false);
            $('#checkboxArtificial').attr('disabled', false);
            $('#checkboxMixta').attr('disabled', false);
            $('#input_ablactacion').attr('disabled', false);
            //$('#input_alimentacion_actual').attr('disabled', false);
        }else{
            $('#checkboxMaterna').prop('checked', false);
            $('#checkboxArtificial').prop('checked', false);
            $('#checkboxMixta').prop('checked', false);
            $('#checkboxMaterna').attr('disabled', true).val('');
            $('#checkboxArtificial').attr('disabled', true).val('');
            $('#checkboxMixta').attr('disabled', true).val('');
            $('#input_ablactacion').attr('disabled', true).val('');
            //$('#input_alimentacion_actual').attr('disabled', true).val('');
        }
        
    }
    //finaliza lactancia

    function mc_obt_exa_radio(opc){
        if(opc == 1){
            $('#input_mc_obt_exa').attr('disabled', false);
        }else{
            $('#input_mc_obt_exa').attr('disabled', true).val('');
        }
        
    }


    function guardar_expediente() {
        //alert(id_paciente+temperatura+presion_arterial+peso+talla+saturacion+frecuencia_cardiaca+frecuencia_respiratoria+glucometria);
        $.ajax({
            type: "post",
            url: url_guardar_expediente,
            data: {
                "accion": accion,
                "estado_edicion": estado_edicion,
                //inicia sigons vitales
                "id_paciente": id_paciente,
                "temperatura": temperatura,
                "presion_arterial": presion_arterial,
                "peso": peso,
                "talla": talla,
                "saturacion": saturacion,
                "frecuencia_cardiaca": frecuencia_cardiaca,
                "frecuencia_respiratoria": frecuencia_respiratoria,
                "glucometria": glucometria,
                //finaliza sigons vitales
                //inicia consulta
                "historia_enfermedad_actual": historia_enfermedad_actual,
                "motivo_consulta": motivo_consulta,
                "antecedentes_personales_patologicos": antecedentes_personales_patologicos,
                "tratamientos": tratamientos,
                "afp": afp,
                "antecedentes_hospitalarios_quirurgicos": antecedentes_hospitalarios_quirurgicos,
                "inmunizacion": inmunizacion,
                "alergias": alergias,
                //finaliza consulta
                //inicia antecedentes prenatales
                "nombre_madre": nombre_madre,
                "edad_madre": edad_madre,
                "tipo_sangre": tipo_sangre,
                "enfer_durante_embarazo": enfer_durante_embarazo,
                "numero_gestas_previas": numero_gestas_previas,
                "numero_partos": numero_partos,
                "numero_cesareas": numero_cesareas,
                "numero_control_prenatal_utlimo_parto": numero_control_prenatal_utlimo_parto,
                //finaliza antecedentes prenatales
                //inicia natalicio
                "nace_en": nace_en,
                "apgar": apgar,
                "peso_natalicio": peso_natalicio,
                "talla_natalicio": talla_natalicio,
                "perimetro_cefalico": perimetro_cefalico,
                "tipo_parto": tipo_parto,
                "complicaciones_parto": complicaciones_parto,
                //finaliza natalicio
                //inicia desarrollo psicomotor
                "checkboxSonrio": checkboxSonrio,
                "checkboxSostuvoCabeza": checkboxSostuvoCabeza,
                "checkboxSeSento": checkboxSeSento,
                "checkboxSeParo": checkboxSeParo,
                "checkboxCaminoSolo": checkboxCaminoSolo,
                "checkboxHabla": checkboxHabla,
                "checkboxControlEsfinteres": checkboxControlEsfinteres,
                "escolaridad_actual": escolaridad_actual,
                //finaliza desarrollo psicomotor
                //inicia lactancia
                "checkboxMaterna": checkboxMaterna,
                "checkboxArtificial": checkboxArtificial,
                "checkboxMixta": checkboxMixta,
                "ablactacion": ablactacion,
                "alimentacion_actual": alimentacion_actual,
                //finaliza lactancia
                //inicia examen fisico
                "examen_fisico": examen_fisico,
                //finaliza examen fisico
                //inicia examen diagnostico
                "diagnostico": diagnostico,
                //finaliza examen diagnostico
                //inicia examen indicaciones
                "indicaciones": indicaciones,
                //finaliza examen indicaciones
                "receta": receta,
                "id_remision": id_remision
            },
            success: function (data) {
                if (data.msgError != null) {
                    titleMsg = "Error al Guardar";
                    textMsg = data.msgError;
                    typeMsg = "error";
                } else {
                    titleMsg = "Datos Guardados";
                    textMsg = data.msgSuccess;
                    typeMsg = "success";
                    $('#btn_editar_expediente').attr('disabled', false);
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

