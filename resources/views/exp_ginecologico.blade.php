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
                            <h4>Ginecología</h4>
                        </center> 
                    </div>
                    <div class="col-md-2 col-sm-2">
                    <a target='_blank' href="{{url('/archivos/paciente/')}}/{{$paciente->id}}" id='btn_historial_paciente' class='btn btn-success btn-sm btn-block' title='Historial de Archivos' ><i class='fas fa-folder-open'></i> Ver Archivos</a>
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
                            @foreach ($medico as $row)
                                <small class="text-muted"><ins>{{$row->nombre}}</ins></small>
                            @endforeach
                            
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">T°</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="C°" id="input_temperatura" aria-label="Username" aria-describedby="basic-addon1" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PA</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="mmHg" id="input_presion_arterial" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PESO</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="kg" id="input_peso" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TALLA</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="m" id="input_talla" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">SAT</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="%" id="input_saturacion" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FC</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="X'" id="input_frecuencia_cardiaca" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FR</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="X'" id="input_frecuencia_respiratoria" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GMT</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="mgdl" id="input_glocometria" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">IMC</span>
                                        </div>
                                        <select class="custom-select" id="input_indice_masa_corporal">
                                            <option selected disabled>Elija una opcion</option>
                                            @foreach($indice_masa_corporal as $row_imc)
                                                <option value="{{$row_imc->id}}">{{$row_imc->descripcion_masa_corporal}} kg/m²</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">ANTECEDENTES GINECO-OBSTÉTRICOS</h3>
                        &nbsp;&nbsp;<input type="radio" name="ets_radio" id="ets_radio" onclick="myFunction(0)"  aria-label="Radio button for following text input"> No
                        &nbsp;&nbsp;<input type="radio" name="ets_radio" id="ets_radio" onclick="myFunction(1)" checked aria-label="Radio button for following text input"> Si
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="card-body" style="display: block;" id="ocultar">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GESTAS (G)</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="¿Cuantas gestas?" id="input_gestas" aria-label="Username" aria-describedby="basic-addon1" required
                                        value="{{$exp_ginecologia->gestas}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PARTOS (P)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_partos" placeholder="¿Cuantos partos?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->partos}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">CESAREAS (C)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_cesareas" placeholder="¿Cuantas cesareas?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->cesareas}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ABORTOS (A)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_abortos" placeholder="¿Cuantos abortos?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->abortos}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">HIJOS VIVOS (HV)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_hijos_vivos" placeholder="¿Cuantos hijos vivos?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->hijos_vivos}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">HIJOS MUERTOS (HM)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_hijos_muertos" placeholder="¿Cuantos hijos muertos?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->hijos_muertos}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FECHA ÚLTIMO PARTO (FUP)</span>
                                        </div>
                                        <input type="date" class="form-control" id="input_fecha_ultimo_parto" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->fecha_parto}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ATENDIDO</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_atendido" placeholder="Describa donde fue atendida" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->atendido}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FUM 
                                                @if($exp_ginecologia->fum_desconoce == 1)
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(1)" aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(2)" aria-label="Radio button for following text input"> No Aplica
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(3)" checked aria-label="Radio button for following text input"> Desconoce
                                                @else
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(2)" aria-label="Radio button for following text input"> No Aplica
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(3)" aria-label="Radio button for following text input"> Desconoce
                                                @endif
                                            </span>
                                        </div>
                                        <input type="date" class="form-control" id="input_fum" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->fecha_ultima_mestruacion}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FPP 
                                                &nbsp;&nbsp;<input type="radio" name="fpp_radio" id="fpp_radio" onclick="fpp_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="fpp_radio" id="fpp_radio" onclick="fpp_radio(0)" aria-label="Radio button for following text input"> No Aplica
                                            </span>
                                        </div>
                                        <input type="date" class="form-control" id="input_fpp" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->fecha_provable_parto}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">CITOLOGÍA</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_citologia" placeholder="Describa citología" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->citologia}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PLANIFICACIÓN FAMILIAR (PF) 
                                                &nbsp;&nbsp;<input type="radio" name="pf_radio" id="pf_radio" onclick="pf_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="pf_radio" id="pf_radio" onclick="pf_radio(0)" aria-label="Radio button for following text input"> No
                                               
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_pf" placeholder="Describa planificación familiar" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->descripcion_planificacion_familiar}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TIPO DE SANGRE</span>
                                        </div>
                                        <select class="custom-select" id="input_tipo_sangre">
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
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">VAGINOSIS 
                                               
                                                &nbsp;&nbsp;<input type="radio" name="vaginosis_radio" id="vaginosis_radio" onclick="vaginosis_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="vaginosis_radio" id="vaginosis_radio" onclick="vaginosis_radio(0)" aria-label="Radio button for following text input"> No
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_vaginosis" placeholder="Describa vaginosis" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->descripcion_vaginosis}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">INFECCIÓN DEL TRACTO URINARIO (ITU) 
                                                &nbsp;&nbsp;<input type="radio" name="itu_radio" id="itu_radio" onclick="itu_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="itu_radio" id="itu_radio" onclick="itu_radio(0)" aria-label="Radio button for following text input"> No
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_itu" placeholder="Describa infección de ITU" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->descripcion_infeccion_tracto_urinario}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PRURITO 
                                                &nbsp;&nbsp;<input type="radio" name="prurito_radio" id="prurito_radio" onclick="prurito_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="prurito_radio" id="prurito_radio" onclick="prurito_radio(0)" aria-label="Radio button for following text input"> No

                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_prurito" placeholder="Describa prurito" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->descripcion_prurito}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">MENARQUIA 
                                                &nbsp;&nbsp;<input type="radio" name="menarquia_radio" id="menarquia_radio" onclick="menarquia_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="menarquia_radio" id="menarquia_radio" onclick="menarquia_radio(0)" aria-label="Radio button for following text input"> No
                                           
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_menarquia" placeholder="Describa menarquía" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->descripcion_menarquia}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">INICIO DE VIDA SEXUAL (IVS) 
                                                &nbsp;&nbsp;<input type="radio" name="ivs_radio" id="ivs_radio" onclick="ivs_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="ivs_radio" id="ivs_radio" onclick="ivs_radio(0)" aria-label="Radio button for following text input"> No
                                               
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" id="input_ivs" placeholder="¿A que edad?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->edad_inicio_vida_sexual}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">NÚMERO DE PAREJAS SEXUALES (NPS)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_numero_parejas_sexuales" placeholder="¿Cuantas parejas sexuales?" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->numero_parejas_sexuales}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            ENFERMEDAD DE TRANSMISION SEXUAL (ETS)
                                            &nbsp;&nbsp;<input type="radio" name="ets_radio" id="ets_radio" onclick="ets_radio(1)" checked aria-label="Radio button for following text input"> Si
                                            &nbsp;&nbsp;<input type="radio" name="ets_radio" id="ets_radio" onclick="ets_radio(0)" aria-label="Radio button for following text input"> No
                                           
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" id="input_ets" rows="3" placeholder="Ingrese la enfermedad de trasnmisión sexual"
                                        >{{$exp_ginecologia->tipo_enfermedades_trasmision_sexual}}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">VIDA SEXUAL ACTIVA (VSA)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_vida_sexual_activa" placeholder="Describa vida sexual activa" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->vida_sexual_activa}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES PERSONALES PATOLOGICOS (APP)
                                                &nbsp;&nbsp;<input type="radio" name="app_radio" id="app_radio" onclick="app_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="app_radio" id="app_radio" onclick="app_radio(0)" aria-label="Radio button for following text input"> No
                                               
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_app" placeholder="Describa APP" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->tipo_antecendestes_personales_patologicos}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">AFP
                                                &nbsp;&nbsp;<input type="radio" name="afp_radio" id="afp_radio" onclick="afp_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="afp_radio" id="afp_radio" onclick="afp_radio(0)" aria-label="Radio button for following text input"> No
                                           
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_afp" placeholder="Describa AFP" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->afp}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES INMUNOALERGICOS (AIA)
                                                &nbsp;&nbsp;<input type="radio" name="aia_radio" id="aia_radio" onclick="aia_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="aia_radio" id="aia_radio" onclick="aia_radio(0)" aria-label="Radio button for following text input"> No
                                               
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_aia" placeholder="Describa AIA" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->tipo_antecedentes_inmunoalergicos}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">HABITOS
                                                &nbsp;&nbsp;<input type="radio" name="habitos_radio" id="habitos_radio" onclick="habitos_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="habitos_radio" id="habitos_radio" onclick="habitos_radio(0)" aria-label="Radio button for following text input"> No
                                               
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_habitos"  placeholder="Describa los hábitos" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->habitos}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES HOSPITALARIOS Y QUIRURGICOS (AHxTxQx)
                                                
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(0)" aria-label="Radio button for following text input"> No
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_AHxTxQx" placeholder="Describa AHxTxQx" aria-label="Username" aria-describedby="basic-addon1"
                                        value="{{$exp_ginecologia->tipos_antecedentes_hospitalarios_quirurgicos}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            MOTIVO DE LA CONSULTA (MC)
                                            &nbsp;&nbsp;<input type="radio" name="mc_radio" id="mc_radio" onclick="mc_radio(1)" checked aria-label="Radio button for following text input"> Ginecología
                                            &nbsp;&nbsp;<input type="radio" name="mc_radio" id="mc_radio" onclick="mc_radio(0)" aria-label="Radio button for following text input"> Obstétrica
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="div_input_mc_ginecologia">
                                            <textarea class="form-control" id="input_mc" rows="3" placeholder="Describa el motivo de la consulta"></textarea>
                                        </div>
                                        <div id="div_input_mc_obtetrica">
                                            <div class="form-group form-group-sm mb3">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Semanas Gestacionales (SG) </label>
                                                        <input type="number" class="form-control" id="input_mc_obt_sg" placeholder="Ingrese semanas gestacionales..." aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label>Exámenes</label>
                                                        &nbsp;&nbsp;<input type="radio" name="mc_obt_exa_radio" id="mc_obt_exa_radio" onclick="mc_obt_exa_radio(1)" checked aria-label="Radio button for following text input"> Si
                                                        &nbsp;&nbsp;<input type="radio" name="mc_obt_exa_radio" id="mc_obt_exa_radio" onclick="mc_obt_exa_radio(0)" aria-label="Radio button for following text input"> No
                                                        <textarea class="form-control" id="input_mc_obt_exa" rows="2" placeholder="Ingrese los exámenes del paciente..."></textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" id="input_mc_obt_notas" rows="3" placeholder="Notas..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">HISTORIA DE ENFERMEDAD ACTUAL (HEA)</span>

                                        </div>
                                        <input type="text" class="form-control" id="input_historia_enfermedad_actual" placeholder="Describa HEA" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">EXÁMEN FÍSICO</h3>
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
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">OTORRINOLARINGOLOGIA (ORL)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_otorrinolaringologia" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">CARDIO PULMONAR (C/P)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_cardio_pulmonar" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ABDOMEN</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_abdomen" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GINECOLOGICO (GO)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_ginecologico" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ESPECULO</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_especulo" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TRANS VAGINAL (TV)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_trans_vaginal" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ULTRASONIDO (USG)</span>
                                        </div>
                                        <input type="text" class="form-control" id="input_ultrasonido" placeholder="Describa" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            DIAGNOSTICOS (IDx)
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" id="input_diagnosticos" placeholder="Ingrese el diagnostico del paciente"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            PLAN
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" rows="3" id="input_plan" placeholder="Ingrese el diagnostico del paciente"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PROXIMA CITA</span>
                                        </div>
                                        <input type="date" class="form-control" id="input_proxima_cita" placeholder="C°" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">RECETA MEDICA</h3>
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
                                    <h1>Centro Medico Diaz</h1>
                                    <ul class="list-unstyled">
                                    @foreach ($medico as $row2)
                                        <li><h4><strong>Dra. {{$row2->nombre}}</strong></h4></li>
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
                            <textarea class="form-control" id="input_receta" rows="5" placeholder="Px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="actions" class="row">
                        <div class="col-lg-12">
                            <div class="btn-group w-100">

                                <button type="submit" class="btn btn-success col start" id="btn_guardar_expediente">
                                    <i class="fas fa-save"></i>
                                    <span>Guardar</span>
                                </button>
                                <button type="submit" class="btn btn-info col start" id="btn_enviar_observacion">
                                    <i class="fas fa-eye"></i>
                                    <span>Enviar a Observación</span>
                                </button>

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
    var url_guardar_expediente = "{{url('/exp/ginecologico/paciente')}}/guardar";
    var validar = 1;
    var id_remision = {{$id_remision}};
    var campo = null;
    var accion = 1;
    var estado_expediente = null;
    var id_paciente = {{$paciente->id}};
    var sub_siguiente = {{$sub_siguiente->existe}};
    var temperatura = null;
    var presion_arteria = null;
    var peso = null;
    var talla = null;
    var saturacion = null;
    var frecuencia_cardiaca = null;
    var frecuencia_respiratoria = null;
    var glucometria = null;
    var indice_masa_corporal = null;
    var gestas = null;
    var partos = null;
    var cesareas = null;
    var abortos = null;
    var hijos_vivos = null;
    var hijos_muertos = null;
    var fecha_ultimo_parto = null;
    var atendido = null;
    var fecha_ultima_menstruacion = null;
    var fum_desconoce = null;
    var fpp = null;
    var citologia = null;
    var planificaion_familiar = null;
    var tipo_sangre = null;
    var vaginosis = null;
    var infeccion_tracto_urinario = null;
    var prurito = null;
    var menarquia = null;
    var inicio_vida_sexual = null;
    var numero_parejas_sexuales = null;
    var enfermedad_transmision_sexual = null;
    var vida_sexual_activa = null;
    var antecedentes_personales_patologicos = null;
    var afp = null;
    var antecedentes_inmunoalergicos = null;
    var habitos = null;
    var antecedentes_hospitalarios_quirurgicos = null;
    var mc_ginecologica = null;
    var mc_semanas_gestacionales = null;
    var mc_examenes = null;
    var mc_notas = null;
    var historia_enfermedad_actual = null;
    var otorrinolaringologia = null;
    var cardio_pulmonar = null;
    var abdomen = null;
    var ginecologico = null;
    var especulo = null;
    var trans_vaginal = null;
    var ultrasonido = null;
    var diagnosticos = null;
    var plan = null;
    var proxima_cita = null;
    var receta = null;

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#div_input_mc_obtetrica").hide();
        $('#input_mc_obt_sg').attr('disabled', true);
        $('#input_mc_obt_exa').attr('disabled', true);
        $('#input_mc_obt_notas').attr('disabled', true);

        $("#btn_guardar_expediente").on( "click", function () {
            estado_expediente = 5; //Finalizó
            campos_datos_validacion();
        });

        $("#btn_enviar_observacion").on( "click", function () {
            estado_expediente = 3; //Observación
            campos_datos_validacion();
        });

        if("{{$sub_siguiente->existe}}" != 0){
             $("#input_tipo_sangre").val("{{$exp_ginecologia->id_tipo_sangre}}");
        }

        
    });

    function campos_datos_validacion(){
        
            //inicia sigons vitales
            temperatura = $("#input_temperatura").val();
            presion_arterial = $("#input_presion_arterial").val();
            peso = $("#input_peso").val();
            talla = $("#input_talla").val();
            saturacion = $("#input_saturacion").val();
            frecuencia_cardiaca = $("#input_frecuencia_cardiaca").val();
            frecuencia_respiratoria = $("#input_frecuencia_respiratoria").val();
            glucometria = $("#input_glocometria").val();
            indice_masa_corporal = $("#input_indice_masa_corporal").val();
            //finaliza sigons vitales
            //inicia antecedentes gineco-obtetricos
            gestas = $("#input_gestas").val();
            partos = $("#input_partos").val();
            cesareas = $("#input_cesareas").val();
            abortos = $("#input_abortos").val();
            hijos_vivos = $("#input_hijos_vivos").val();
            hijos_muertos = $("#input_hijos_muertos").val();
            fecha_ultimo_parto = $("#input_fecha_ultimo_parto").val();
            atendido = $("#input_atendido").val();
            fecha_ultima_menstruacion = $("#input_fum").val();
            fpp = $("#input_fpp").val();
            citologia = $("#input_citologia").val();
            planificacion_familiar = $("#input_pf").val();
            tipo_sangre = $("#input_tipo_sangre").val();
            vaginosis = $("#input_vaginosis").val();
            infeccion_tracto_urinario = $("#input_itu").val();
            prurito = $("#input_prurito").val();
            menarquia = $("#input_menarquia").val();
            inicio_vida_sexual = $("#input_ivs").val();
            numero_parejas_sexuales = $("#input_numero_parejas_sexuales").val();
            enfermedad_transmision_sexual = $("#input_ets").val();
            vida_sexual_activa = $("#input_vida_sexual_activa").val();
            antecedentes_personales_patologicos = $("#input_app").val();
            afp = $("#input_afp").val();
            antecedentes_inmunoalergicos = $("#input_aia").val();
            habitos = $("#input_habitos").val();
            antecedentes_hospitalarios_quirurgicos = $("#input_AHxTxQx").val();
            mc_ginecologica = $("#input_mc").val();
            mc_semanas_gestacionales = $("#input_mc_obt_sg").val();
            mc_examenes = $("#input_mc_obt_exa").val();
            mc_notas = $("#input_mc_obt_notas").val();
            historia_enfermedad_actual = $("#input_historia_enfermedad_actual").val();
            //finaliza antecedentes gineco-obtetricos
            //inicia examen fisico//inicia examen fisico
            otorrinolaringologia = $("#input_otorrinolaringologia").val();
            cardio_pulmonar = $("#input_cardio_pulmonar").val();
            abdomen = $("#input_abdomen").val();
            ginecologico = $("#input_ginecologico").val();
            especulo = $("#input_especulo").val();
            trans_vaginal = $("#input_trans_vaginal").val();
            ultrasonido = $("#input_ultrasonido").val();
            diagnosticos = $("#input_diagnosticos").val();
            plan = $("#input_plan").val();
            proxima_cita = $("#input_proxima_cita").val();
            //finaliza examen fisico    
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

            /*if(glucometria == null || glucometria == ''){
                $('#input_glocometria').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Glucometria";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_glocometria').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }*/

            if(indice_masa_corporal == null || indice_masa_corporal == ''){
                $('#input_indice_masa_corporal').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Indice de Masa Corporal";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_indice_masa_corporal').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            // if(gestas == null || gestas == ''){
            //     $('#input_gestas').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Gestas";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_gestas').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(partos == null || partos == ''){
            //     $('#input_partos').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Partos";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_partos').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(cesareas == null || cesareas == ''){
            //     $('#input_cesareas').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Cesareas";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_cesareas').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }
            

            // if(abortos == null || abortos == ''){
            //     $('#input_abortos').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Abortos";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_abortos').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(hijos_vivos == null || hijos_vivos == ''){
            //     $('#input_hijos_vivos').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Hijos Vivos";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_hijos_vivos').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(hijos_muertos == null || hijos_muertos == ''){
            //     $('#input_hijos_muertos').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Hijos Muertos";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_hijos_muertos').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(fecha_ultimo_parto == null || fecha_ultimo_parto == ''){
            //     $('#input_fecha_ultimo_parto').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Fecha Ultimo Parto";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_fecha_ultimo_parto').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(atendido == null || atendido == ''){
            //     $('#input_atendido').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Atendido";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_atendido').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_fum").prop('disabled') == false && (fecha_ultima_menstruacion == null || fecha_ultima_menstruacion == '')){
            //     $('#input_fum').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Fecha Ultima Menstruacion";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_fum').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_fpp").prop('disabled') == false && (fpp == null || fpp == '')){
            //     $('#input_fpp').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "FPP";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_fpp').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(citologia == null || citologia == ''){
            //     $('#input_citologia').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Citologia";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_citologia').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_pf").prop('disabled') == false && (planificacion_familiar == null || planificacion_familiar == '')){
            //     $('#input_pf').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Planifiacion Familiar";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_pf').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(tipo_sangre == null || tipo_sangre == ''){
            //     $('#input_tipo_sangre').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Tipo de Sangre";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_tipo_sangre').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_vaginosis").prop('disabled') == false && (vaginosis == null || vaginosis == '')){
            //     $('#input_vaginosis').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Vaginosis";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_vaginosis').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_itu").prop('disabled') == false && (infeccion_tracto_urinario == null || infeccion_tracto_urinario == '')){
            //     $('#input_itu').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Infeccion del Tracto Urinario";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_itu').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_prurito").prop('disabled') == false && (prurito == null || prurito == '')){
            //     $('#input_prurito').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Prurito";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_prurito').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_menarquia").prop('disabled') == false && (menarquia == null || menarquia == '')){
            //     $('#input_menarquia').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Menarquia";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_menarquia').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if($("#input_ivs").prop('disabled') == false && (inicio_vida_sexual == null || inicio_vida_sexual == '')){
            //     $('#input_ivs').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Inicio de Vida Sexual";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_ivs').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            // if(numero_parejas_sexuales == null || numero_parejas_sexuales == ''){
            //     $('#input_numero_parejas_sexuales').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Numero de Parejas Sexuales";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_numero_parejas_sexuales').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     validar = validar * 1;
            // }

            if($("#input_ets").prop('disabled') == false && (enfermedad_transmision_sexual == null || enfermedad_transmision_sexual == '')){
                $('#input_ets').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Enfermedad de Transmision Sexual";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_ets').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(vida_sexual_activa == null || vida_sexual_activa == ''){
                $('#input_vida_sexual_activa').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Vida Sexual Activa";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_vida_sexual_activa').removeClass('form-control is-invalid').addClass('form-control is-valid');
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

            if($("#input_afp").prop('disabled') == false && (afp == null || afp == '')){
                $('#input_afp').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "AFP";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_afp').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_aia").prop('disabled') == false && (antecedentes_inmunoalergicos == null || antecedentes_inmunoalergicos == '')){
                $('#input_aia').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Antecedentes Inmunoalergicos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_aia').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_habitos").prop('disabled') == false && (habitos == null || habitos == '')){
                $('#input_habitos').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Habitos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_habitos').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

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

            if($("#input_mc").prop('disabled') == false && (mc_ginecologica == null || mc_ginecologica == '')){
                $('#input_mc').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Motivo de Consulta Ginecologica";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_mc_obt_sg").prop('disabled') == false && (mc_semanas_gestacionales == null || mc_semanas_gestacionales == '')){
                $('#input_mc_obt_sg').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Semanas Gestacionales";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc_obt_sg').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_mc_obt_exa").prop('disabled') == false && (mc_examenes == null || mc_examenes == '')){
                $('#input_mc_obt_exa').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Examenes";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc_obt_exa').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if($("#input_mc_obt_notas").prop('disabled') == false && (mc_notas == null || mc_notas == '')){
                $('#input_mc_obt_notas').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Notas";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc_obt_notas').removeClass('form-control is-invalid').addClass('form-control is-valid');
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

            if(otorrinolaringologia == null || otorrinolaringologia == ''){
                $('#input_otorrinolaringologia').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Otorrinolaringologia";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_otorrinolaringologia').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(cardio_pulmonar == null || cardio_pulmonar == ''){
                $('#input_cardio_pulmonar').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Cardio Pulmonar";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_cardio_pulmonar').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(abdomen == null || abdomen == ''){
                $('#input_abdomen').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Abdomen";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_abdomen').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(ginecologico == null || ginecologico == ''){
                $('#input_ginecologico').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Ginecologico";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_ginecologico').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(especulo == null || especulo == ''){
                $('#input_especulo').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Especulo";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_especulo').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(trans_vaginal == null || trans_vaginal == ''){
                $('#input_trans_vaginal').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Trans Vaginal";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_trans_vaginal').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(ultrasonido == null || ultrasonido == ''){
                $('#input_ultrasonido').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Ultrasonido";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_ultrasonido').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(diagnosticos == null || diagnosticos == ''){
                $('#input_diagnosticos').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Diagnosticos";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_diagnosticos').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            
            if(plan == null || plan == ''){
                $('#input_plan').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Plan";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_plan').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(proxima_cita == null || proxima_cita == ''){
                $('#input_proxima_cita').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Proxima Cita";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_proxima_cita').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }

            if(receta == null || receta == ''){
                $('#input_receta').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Receta";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_receta').removeClass('form-control is-invalid').addClass('form-control is-valid');
                validar = validar * 1;
            }
            
            $('#btn_guardar_expediente').attr('disabled', true);
            $('#btn_enviar_observacion').attr('disabled', true);
            guardar_expediente(); 
    }

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

    function ets_radio(opc){
        if(opc == 1){
            $('#input_ets').attr('disabled', false);
        }else{
            $('#input_ets').attr('disabled', true).val('');
        }
        
    }

    function app_radio(opc){
        if(opc == 1){
            $('#input_app').attr('disabled', false);
        }else{
            $('#input_app').attr('disabled', true).val('');
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

    function mc_obt_exa_radio(opc){
        if(opc == 1){
            $('#input_mc_obt_exa').attr('disabled', false);
        }else{
            $('#input_mc_obt_exa').attr('disabled', true).val('');
        }
        
    }


    function guardar_expediente() {
        //alert(id_paciente+temperatura+presion_arterial+peso+talla+saturacion+frecuencia_cardiaca+frecuencia_respiratoria+glucometria+indice_masa_corporal);
        $.ajax({
            type: "post",
            url: url_guardar_expediente,
            data: {
                "accion": accion,
                "estado_expediente": estado_expediente,
                "sub_siguiente": sub_siguiente,
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
                "indice_masa_corporal": indice_masa_corporal,
                //finaliza sigons vitales
                //inicia antecedentes gineco-obtetricos
                "gestas": gestas,
                "partos": partos,
                "cesareas": cesareas,
                "abortos": abortos,
                "hijos_vivos": hijos_vivos,
                "hijos_muertos": hijos_muertos,
                "fecha_ultimo_parto": fecha_ultimo_parto,
                "atendido": atendido,
                "fecha_ultima_menstruacion": fecha_ultima_menstruacion,
                "fum_desconoce": fum_desconoce,
                "fpp": fpp,
                "citologia": citologia,
                "planificacion_familiar": planificacion_familiar,
                "tipo_sangre": tipo_sangre,
                "vaginosis": vaginosis,
                "infeccion_tracto_urinario": infeccion_tracto_urinario,
                "prurito": prurito,
                "menarquia": menarquia,
                "inicio_vida_sexual": inicio_vida_sexual,
                "numero_parejas_sexuales": numero_parejas_sexuales,
                "enfermedad_transmision_sexual": enfermedad_transmision_sexual,
                "vida_sexual_activa": vida_sexual_activa,
                "antecedentes_personales_patologicos": antecedentes_personales_patologicos,
                "afp": afp,
                "antecedentes_inmunoalergicos": antecedentes_inmunoalergicos,
                "habitos": habitos,
                "antecedentes_hospitalarios_quirurgicos": antecedentes_hospitalarios_quirurgicos,
                "mc_ginecologica": mc_ginecologica,
                "mc_semanas_gestacionales": mc_semanas_gestacionales,
                "mc_examenes": mc_examenes,
                "mc_notas": mc_notas,
                "historia_enfermedad_actual": historia_enfermedad_actual,
                //finaliza antecedentes gineco-obtetricos
                //inicia examen fisico
                "otorrinolaringologia": otorrinolaringologia,
                "cardio_pulmonar": cardio_pulmonar,
                "abdomen": abdomen,
                "ginecologico": ginecologico,
                "especulo": especulo,
                "trans_vaginal": trans_vaginal,
                "ultrasonido": ultrasonido,
                "diagnosticos": diagnosticos,
                "plan": plan,
                "proxima_cita": proxima_cita,
                //finaliza examen fisico 
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
                    window.location.href = "{{url('/medico/sala-espera/remisiones')}}";
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

<script>
    function myFunction() {
      var x = document.getElementById("ocultar");
      if (x.style.display === "none") {
        x.style.display = "block";
        $('#input_gestas').attr('disabled', false);
      } else {
        x.style.display = "none";
        $('#input_gestas').attr('disabled', true).val('');
      }
    }

</script>
@endsection

