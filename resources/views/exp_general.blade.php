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
                            <h4>General</h4>
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
                                        <input type="number" class="form-control" placeholder="C°" id="input_temperatura" aria-label="Username" aria-describedby="basic-addon1" title="TEMPERATURA" min="0" step="0.001">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PA</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="mmHg" id="input_presion_arterial" aria-label="Username" aria-describedby="basic-addon1" title="PRESIÓN ARTERIAL">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">PESO</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="kg" id="input_peso" aria-label="Username" aria-describedby="basic-addon1" title="PESO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">TALLA</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="m" id="input_talla" aria-label="Username" aria-describedby="basic-addon1" title="TALLA">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">SAT</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="%" id="input_saturacion" aria-label="Username" aria-describedby="basic-addon1" title="SATURACIÓN">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FC</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="X'" id="input_frecuencia_cardiaca" aria-label="Username" aria-describedby="basic-addon1" title="FRECUENCIA CARDIACA">
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
                                        <input type="number" class="form-control" placeholder="X'" id="input_frecuencia_respiratoria" aria-label="Username" aria-describedby="basic-addon1" title="FRECUENCIA RESPIRATORIA">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GMT</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="mgdl" id="input_glocometria" aria-label="Username" aria-describedby="basic-addon1" title="GLUCOMETRIA">
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">ANTECEDENTES GENERALES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>                            
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">GLASGOW</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_glasgow" placeholder="#" aria-label="Username" aria-describedby="basic-addon1" title="GLASGOW"
                                          
                                                 value="{{$glasgow->glasgow}}"
                                            
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ACTIVIDAD OCULAR (AO)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_actividad_ocular" placeholder="#" aria-label="Username" aria-describedby="basic-addon1" title="ACTIVIDAD OCULAR (AO)"
                                        
                                                 value="{{$glasgow->actividad_ocular}}"
                                        
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">RESPUESTA VERBAL (RV)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_respuesta_verval" placeholder="#" aria-label="Username" aria-describedby="basic-addon1" title="RESPUESTA VERBAL (RV)"
                                        
                                                value="{{$glasgow->respuesta_verval}}"
                                        
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">RESPUESTA MOTORA (RM)</span>
                                        </div>
                                        <input type="number" class="form-control" id="input_respuesta_motora" placeholder="#" aria-label="Username" aria-describedby="basic-addon1" title="RESPUESTA MOTORA (RM)"
                                        
                                                 value="{{$glasgow->respuesta_motora}}"
                                        
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
                                            ESTADO DE CONCIENCIA                                           
                                        </h5>
                                    </div>  
                                   <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text checkbox-inline" id="basic-addon1"  aria-describedby="basic-addon1">
                                                        ALERTA &nbsp;&nbsp;<input type="checkbox" name="alerta_radio_si" id="alerta_radio_si" aria-describedby="basic-addon1">
                                                        
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" id="basic-addon1">SOMNOLIENTO
                                                            &nbsp;&nbsp;<input type="checkbox" name="somnoliento_radio" id="somnoliento_radio"  > 
                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" id="basic-addon1">ESTUPOR
                                                            &nbsp;&nbsp;<input type="checkbox" name="estupor_radio" id="estupor_radio" >
                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" id="basic-addon1">COMA
                                                            &nbsp;&nbsp;<input type="checkbox" name="coma_radio" id="coma_radio" >

                                                        </label>
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
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">
                                            ANTECEDENTES                         
                                        </h5>
                                    </div>  <br>
                                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES PATOLÓGICOS PERSONALES (APP)
                                                
                                                &nbsp;&nbsp;<input type="radio" name="APP_radio" id="APP_radio" onclick="APP_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                &nbsp;&nbsp;<input type="radio" name="APP_radio" id="APP_radio" onclick="APP_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_APP" placeholder="TRATAMIENTO APP" aria-label="Username" aria-describedby="basic-addon1" title="ANTECEDENTES PATOLÓGICOS PERSONALES (APP)"
                                        
                                                value="{{$consulta_general->tratamiento_antecedentes_patologicos_personales}}"
                                        
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
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES FAMILIARES PATOLÓGICOS (AFP)
                                                
                                                    &nbsp;&nbsp;<input type="radio" name="AFP_radio" id="AFP_radio" onclick="AFP_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                    &nbsp;&nbsp;<input type="radio" name="AFP_radio" id="AFP_radio" onclick="AFP_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_AFP" placeholder="ENFERMEDADES AFP" aria-label="Username" aria-describedby="basic-addon1" title="ANTECEDENTES FAMILIARES PATOLÓGICOS (AFP)"
                                       
                                                value="{{$consulta_general->antecendetes_familiares_patologicos}}"
                                        
                                        >
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
                                            ANTECENDETES GINECOLÓGICOS (AGO)
                                            &nbsp;&nbsp;<input type="radio" name="ago_radios" id="ago_radios" onclick="ago_radios(1)"  aria-label="Radio button for following text input" title="SI"> SI
                                            &nbsp;&nbsp;<input type="radio" name="ago_radios" id="ago_radios" onclick="ago_radios(0)" aria-label="Radio button for following text input" title="NO"> NO

                                        </h5>
                                    </div>
                                    <div class="card-body">                                        
                                        <div id="div_input_ago">                                           
                                            <div class="row">                        
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">GESTAS (G)
                                                                    
                                                                        &nbsp;&nbsp;<input type="radio" name="gestas_radio" id="gestas_radio" onclick="gestas_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                                        &nbsp;&nbsp;<input type="radio" name="gestas_radio" id="gestas_radio" onclick="gestas_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                                    
                                                                    
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="input_gestas" placeholder="GESTAS (G)" aria-label="Username" aria-describedby="basic-addon1" title="GESTAS (G)"
                                                            
                                                                    value="{{$consulta_general->gestas}}"
                                                           
                                                            >
                                                        </div>
                                                    </div>                                                        
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">PARTO (P)
                                                                   
                                                                    &nbsp;&nbsp;<input type="radio" name="parto_radio" id="parto_radio" onclick="parto_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                                    &nbsp;&nbsp;<input type="radio" name="parto_radio" id="parto_radio" onclick="parto_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                                    
                                                                   
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="input_parto" placeholder="PARTOS (P)" aria-label="Username" aria-describedby="basic-addon1" title="PARTO (P)"
                                                            
                                                                    value="{{$consulta_general->partos}}"
                                                           
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">CESAREA (C)
                                                                    
                                                                    &nbsp;&nbsp;<input type="radio" name="cesarea_radio" id="cesarea_radio" onclick="cesarea_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                                    &nbsp;&nbsp;<input type="radio" name="cesarea_radio" id="cesarea_radio" onclick="cesarea_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                                    
                                                                    
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="input_cesarea" placeholder="CESAREA (C)" aria-label="Username" aria-describedby="basic-addon1" title="CESAREA (C)"
                                                           
                                                                    value="{{$consulta_general->cesareas}}"
                                                            
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-sm mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">ABORTOS (A)
                                                                   
                                                                    &nbsp;&nbsp;<input type="radio" name="aborto_radio" id="aborto_radio" onclick="aborto_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                                    &nbsp;&nbsp;<input type="radio" name="aborto_radio" id="aborto_radio" onclick="aborto_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                                  
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" id="input_aborto" placeholder="ABORTOS (A)" aria-label="Username" aria-describedby="basic-addon1"  title="ABORTOS (A)"
                                                            
                                                                   value="{{$consulta_general->abortos}}"
                                                            
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">FECHA ULTIMA MENSTRUACIÓN (FUM) 
                                               
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(1)" checked aria-label="Radio button for following text input"  title="SI"> Si
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(2)" aria-label="Radio button for following text input"  title="No Aplica"> No Aplica
                                                &nbsp;&nbsp;<input type="radio" name="fum_radio" id="fum_radio" onclick="fum_radio(3)" aria-label="Radio button for following text input"  title="Desconoce"> Desconoce
                                                
                                            </span>
                                        </div>
                                        <input type="date" class="form-control" id="input_fum" placeholder="" aria-label="Username" aria-describedby="basic-addon1"  title="FECHA ULTIMA MENSTRUACIÓN (FUM)"
                                        
                                            value="{{$consulta_general->fecha_ultima_menstruacion}}"
                                        
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
                                               
                                                &nbsp;&nbsp;<input type="radio" name="aia_radio" id="aia_radio" onclick="aia_radio(1)" checked aria-label="Radio button for following text input"  title="SI"> Si
                                                &nbsp;&nbsp;<input type="radio" name="aia_radio" id="aia_radio" onclick="aia_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                                
                                                
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_aia" placeholder="AIA" aria-label="Username" aria-describedby="basic-addon1" title="ANTECEDENTES INMUNO ALERGICOS (AIA)"
                                       
                                            value="{{$consulta_general->cuales_alergias}}"
                                       
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
                                            <span class="input-group-text" id="basic-addon1">HÁBITOS 
                                               
                                                &nbsp;&nbsp;<input type="radio" name="habitos_radio" id="habitos_radio" onclick="habitos_radio(1)" checked aria-label="Radio button for following text input"  title="SI"> Si
                                                &nbsp;&nbsp;<input type="radio" name="habitos_radio" id="habitos_radio" onclick="habitos_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                             
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_habitos" placeholder="HABITOS" aria-label="Username" aria-describedby="basic-addon1" title="HABITOS"
                                       
                                             value="{{$consulta_general->tipo_habitos}}"
                                        
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
                                            <span class="input-group-text" id="basic-addon1">ANTECEDENTES HOSPITALARIOS Y QUIRÚRGICOS (AHxTxQx)  
                                               
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(1)" checked aria-label="Radio button for following text input" title="SI"> Si
                                                &nbsp;&nbsp;<input type="radio" name="AHxTxQx_radio" id="AHxTxQx_radio" onclick="AHxTxQx_radio(0)" aria-label="Radio button for following text input" title="NO"> No
                                               
                                               
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input_AHxTxQx" placeholder="AHxTxQx" aria-label="Username" aria-describedby="basic-addon1" title="ANTECEDENTES HOSPITALARIOS Y QUIRURGICOS (AHxTxQx)"
                                       
                                           value="{{$consulta_general->antecendetes_hospitalarios_quirurgicos}}"
                                       
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
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="div_input_mc_ginecologia">
                                            <textarea class="form-control" id="input_mc" rows="3" placeholder="Ingrese el motivo de la consulta del paciente" title="MOTIVO DE LA CONSULTA (MC)"></textarea>
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
                                        <div id="">
                                         <textarea class="form-control" id="input_hea" placeholder="HEA" aria-label="Username" aria-describedby="basic-addon1" title="HISTORIA DE ENFERMEDAD ACTUAL (HEA)"></textarea>
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
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">                        
                        <div class="row">                            
                            <textarea class="form-control" id="input_examen_fisico" rows="3" placeholder="Ingrese el examen fisico del paciente" title="EXAMEN FISICO"></textarea>
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
                                    <textarea class="form-control" id="input_diagnostico" rows="3" placeholder="Ingrese el diagnostico del paciente" title="DIAGNOSTICOS (IDx)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title">
                                        INDICACIONES Y TRATAMIENTO
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <textarea class="form-control" id="input_indicaciones_tratamiento" rows="3" placeholder="Ingrese las indicaciones y tratamiento del paciente" title="INDICACIONES Y TRATAMIENTO"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">PRÓXIMA CITA</span>
                                    </div>
                                    <input type="date" class="form-control" required id="input_proxima_cita" placeholder="C°" aria-label="Username" aria-describedby="basic-addon1" title="PROXIMA CITA">
                                </div>
                            </div>
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
                                        <li><h4><strong>Dr(a). {{$row2->nombre}}</strong></h4></li>
                                        <li>{{$row2->cargo}}</li>
                                        <li>Cel.: {{$row2->celular}}
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
                        <textarea class="form-control" id="input_receta" rows="5" placeholder="Px" title="RECETA"></textarea>
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
@endsection
@section("scripts")

<script type="text/javascript">
    var url_guardar_expediente = "{{url('/exp/general/paciente')}}/guardar";
    var validar = 1;
    var id_remision = {{$id_remision}};
    var campo = null;
    var accion = 1;
    var estado_expediente = null;
    var id_paciente = {{$paciente->id}};
    var sub_siguiente = {{$sub_siguiente->existe}};
    //inicio signos vitales
    var temperatura = null;
    var presion_arteria = null;
    var peso = null;
    var talla = null;
    var saturacion = null;
    var frecuencia_cardiaca = null;
    var frecuencia_respiratoria = null;
    var glucometria = null;
    //fin signos vitales
    //inicio glasgow
    var glasgow = null;
    var actividad_ocular = null;
    var respuesta_verval = null;
    var respuesta_motora = null;
    //fin glasgow
    //inicio estado conciencia
    var alerta = null;
    var somnoliento = null;
    var estupor = null;
    var coma = null;
    //fin estado conciencia
    //inicio medicina genral
    //var antecedentes_patologicos_personales = null;
    var tratamiento_antecedentes_patologicos_personales = null;
    var antecendetes_familiares_patologicos = null;
    var gestas = null;
    var partos = null;
    var cesareas = null;
    var abortos = null;
    var fecha_ultima_menstruacion = null;
    var cuales_alergias = null;
    var tipo_habitos = null;
    var antecendetes_hospitalarios_quirurgicos = null;
    var motivo_consulta = null;
    var historia_enfermedad_actual = null;
    var examen_fisico = null;
    var diagnostico = null;
    var indicaciones_tratamiento = null;
    var proxima_cita = null;
    //fin medicina general
    var receta = null;

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn_guardar_expediente").on( "click", function () {
            estado_expediente = 5; //Finalizó
            campos_datos_validacion();
        });

        $("#btn_enviar_observacion").on( "click", function () {
            estado_expediente = 3; //Observación
            campos_datos_validacion();
        })        
    
    });

    function campos_datos_validacion(){
        $("#div_input_mc_obtetrica").hide();

        $("#div_input_ago").hide();

        
            //inicio signos vitales
            temperatura = $("#input_temperatura").val();
            presion_arterial = $("#input_presion_arterial").val();
            peso = $("#input_peso").val();
            talla = $("#input_talla").val();
            saturacion = $("#input_saturacion").val();
            frecuencia_cardiaca = $("#input_frecuencia_cardiaca").val();
            frecuencia_respiratoria = $("#input_frecuencia_respiratoria").val();
            glucometria = $("#input_glocometria").val();
            //fin signos vitales
            //incio glasgow
            glasgow = $("#input_glasgow").val();
            actividad_ocular = $("#input_actividad_ocular").val();
            respuesta_verval = $("#input_respuesta_verval").val();
            respuesta_motora = $("#input_respuesta_motora").val();
            //fin glasgow
            //inicio estado conciencia         
            if( $('#alerta_radio_si').is(':checked') ){
                        // Hacer algo si el checkbox ha sido seleccionado
                    // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
                    alerta = 1;
                    } else {
                        // Hacer algo si el checkbox ha sido deseleccionado
                    // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
                    alerta = 0;
                    }

           if( $('#somnoliento_radio').is(':checked') ){
                    // Hacer algo si el checkbox ha sido seleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
                   somnoliento = 1;
                } else {
                    // Hacer algo si el checkbox ha sido deseleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
                   somnoliento = 0;
                }

            if( $('#estupor_radio').is(':checked') ){
                    // Hacer algo si el checkbox ha sido seleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
                   estupor = 1;
                } else {
                    // Hacer algo si el checkbox ha sido deseleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
                   estupor = 0;
                }
            
            if( $('#coma_radio').is(':checked') ){
                    // Hacer algo si el checkbox ha sido seleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
                   coma = 1;
                } else {
                    // Hacer algo si el checkbox ha sido deseleccionado
                   // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
                   coma = 0;
                }
            //fin estado conciencia

            //inicio medicina genral
            tratamiento_antecedentes_patologicos_personales = $("#input_APP").val();
            antecendetes_familiares_patologicos = $("#input_AFP").val();
            gestas = $("#input_gestas").val();
            partos = $("#input_parto").val();
            cesareas = $("#input_cesarea").val();
            abortos = $("#input_aborto").val();
            fecha_ultima_menstruacion = $("#input_fum").val();
            cuales_alergias = $("#input_aia").val();
            tipo_habitos = $("#input_habitos").val();
            antecendetes_hospitalarios_quirurgicos = $("#input_AHxTxQx").val();
            motivo_consulta = $("#input_mc").val();
            historia_enfermedad_actual = $("#input_hea").val();
            examen_fisico = $('#input_examen_fisico').val();
            diagnostico = $('#input_diagnostico').val();
            indicaciones_tratamiento = $('#input_indicaciones_tratamiento').val();
            proxima_cita = $('#input_proxima_cita').val();
            //fin medicina general
            //inicio receta            
            receta = $("#input_receta").val();
            //fin receta

        //validar incio signos vitales
            if(temperatura == null || temperatura == ''){
                $('#input_temperatura').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Temperatura";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_temperatura').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(presion_arterial == null || presion_arterial == ''){
                $('#input_presion_arterial').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Presion Arterial";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_presion_arterial').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(peso == null || peso == ''){
                $('#input_peso').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Peso";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_peso').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(talla == null || talla == ''){
                $('#input_talla').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Talla";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_talla').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(saturacion == null || saturacion == ''){
                $('#input_saturacion').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Saturacion";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_saturacion').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(frecuencia_cardiaca == null || frecuencia_cardiaca == ''){
                $('#input_frecuencia_cardiaca').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Frecuencia Cardiaca";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_frecuencia_cardiaca').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            /* if(frecuencia_respiratoria == null || frecuencia_respiratoria == ''){
                $('#input_frecuencia_respiratoria').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Frecuencia Respiratoria";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_frecuencia_respiratoria').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            } */

            /* if(glucometria == null || glucometria == ''){
                $('#input_glocometria').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Glucometria";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_glocometria').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            } */
        //validar fin signos vitales

        //validar inicio glasgow
            if(glasgow == null || glasgow == ''){
                $('#input_glasgow').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Glasgow";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_glasgow').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(actividad_ocular == null || actividad_ocular == ''){
                $('#input_actividad_ocular').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Actividad Ocular";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_actividad_ocular').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(respuesta_verval == null || respuesta_verval == ''){
                $('#input_respuesta_verval').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Respuesta Verval";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_respuesta_verval').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(respuesta_motora == null || respuesta_motora == ''){
                $('#input_respuesta_motora').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Respuesta Motora";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_respuesta_motora').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }
        //validar fin glasgow
        /* //Validar inicio estado de conciencia
            if(alerta == null || alerta == ''){
                $('#alerta_radio_si').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Alerta";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#alerta_radio_si').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

             if(somnoliento == null || somnoliento == ''){
                $('#somnoliento_radio').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Somnoliento";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#somnoliento_radio').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

             if(estupor == null || estupor == ''){
                $('#estupor_radio').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Estupor";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#estupor_radio').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(coma == null || coma == ''){
                $('#coma_radio').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Coma";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#coma_radio').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }
        //validar fin estado de conciencia */
        //validar inicio medicina general
            if(motivo_consulta == null || motivo_consulta == ''){
                $('#input_mc').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Motivo de la Consulta";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_mc').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(historia_enfermedad_actual == null || historia_enfermedad_actual == ''){
                $('#input_hea').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Historia Enfermedad Actual";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_hea').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(examen_fisico == null || examen_fisico == ''){
                $('#input_examen_fisico').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Examen Fisico";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_examen_fisico').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(diagnostico == null || diagnostico == ''){
                $('#input_diagnostico').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Diagnostico";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_diagnostico').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            if(indicaciones_tratamiento == null || indicaciones_tratamiento == ''){
                $('#input_indicaciones_tratamiento').removeClass('form-control').addClass('form-control is-invalid');
                //validar = validar * 0;
                campo = "Indicaciones y Tratamiento";
                notificacion_validar_campos(campo);
                return false;
            }else{
                $('#input_indicaciones_tratamiento').removeClass('form-control is-invalid').addClass('form-control is-valid');
                //validar = validar * 1;
            }

            // if(proxima_cita == null || proxima_cita == ''){
            //     $('#input_proxima_cita').removeClass('form-control').addClass('form-control is-invalid');
            //     //validar = validar * 0;
            //     campo = "Proxima Cita";
            //     notificacion_validar_campos(campo);
            //     return false;
            // }else{
            //     $('#input_proxima_cita').removeClass('form-control is-invalid').addClass('form-control is-valid');
            //     //validar = validar * 1;
            // }
            //validar fin medicina general
            /* //validar inicio receta
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
            //validar fin receta */
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
            $('#input_fum').attr('disabled', true);
        }else{
            $('#input_fum').attr('disabled', true);
        }        
    }


    function habitos_radio(opc){
        if(opc == 1){
            $('#input_habitos').attr('disabled', false);
        }else{
            $('#input_habitos').attr('disabled', true);
        }        
    }
    

    function AHxTxQx_radio(opc){
        if(opc == 1){
            $('#input_AHxTxQx').attr('disabled', false);
        }else{
            $('#input_AHxTxQx').attr('disabled', true);
        }        
    }

     
    function AFP_radio(opc){
        if(opc == 1){
            $('#input_AFP').attr('disabled', false);
        }else{
            $('#input_AFP').attr('disabled', true);
        }        
    }


    function APP_radio(opc){
        if(opc == 1){
            $('#input_APP').attr('disabled', false);
        }else{
            $('#input_APP').attr('disabled', true);
        }        
    }

    function afp_radio(opc){
        if(opc == 1){
            $('#input_afp').attr('disabled', false);
        }else{
            $('#input_afp').attr('disabled', true);
        }        
    }   


    function aia_radio(opc){
        if(opc == 1){
            $('#input_aia').attr('disabled', false);
        }else{
            $('#input_aia').attr('disabled', true);
        }        
    }


    function AHxTxQx_radio(opc){
        if(opc == 1){
            $('#input_AHxTxQx').attr('disabled', false);
        }else{
            $('#input_AHxTxQx').attr('disabled', true);
        }        
    }


    function gestas_radio(opc){
        if(opc == 1){
            $('#input_gestas').attr('disabled', false);
        }else{
            $('#input_gestas').attr('disabled', true);
        }        
    }


    function parto_radio(opc){
        if(opc == 1){
            $('#input_parto').attr('disabled', false);
        }else{
            $('#input_parto').attr('disabled', true);
        }        
    }


    function cesarea_radio(opc){
        if(opc == 1){
            $('#input_cesarea').attr('disabled', false);
        }else{
            $('#input_cesarea').attr('disabled', true);
        }        
    }

    
    function aborto_radio(opc){
        if(opc == 1){
            $('#input_aborto').attr('disabled', false);
        }else{
            $('#input_aborto').attr('disabled', true);
        }
        
    }


    function aia_radio(opc){
        if(opc == 1){
            $('#input_aia').attr('disabled', false);
        }else{
            $('#input_aia').attr('disabled', true);
        }        
    }


    function ago_radios(opc){
        if(opc == 1){
            $('#ago_radios').attr('disabled', true);   
            $('#div_input_ago').hide();         
            $('#div_input_ago').show();            
            
        }else{
            $('#ago_radios').attr('disabled', false);
            $('#div_input_ago').show();
            $('#div_input_ago').hide();            
        }        
    }


    function guardar_expediente() {
        $.ajax({
            type: "post",
            url: url_guardar_expediente,
            data: {
                "accion": accion,
                "estado_expediente": estado_expediente,
                "id_paciente": id_paciente,    
                "sub_siguiente": sub_siguiente,          
                //incio signos vitales
                "temperatura": temperatura,
                "presion_arterial": presion_arterial,
                "peso": peso,
                "talla": talla,
                "saturacion": saturacion,
                "frecuencia_cardiaca": frecuencia_cardiaca,
                "frecuencia_respiratoria": frecuencia_respiratoria,
                "glucometria": glucometria,
                //fin signos vitales
                //incio glasgow
                "glasgow": glasgow,
                "actividad_ocular": actividad_ocular,
                "respuesta_verval": respuesta_verval,
                "respuesta_motora": respuesta_motora,
                //fin glasgow
                //inicio estado conciencia
                "alerta": alerta,
                "somnoliento": somnoliento,
                "estupor": estupor,
                "coma": coma,
                //fin estado conciencia
                //inicio medicina genereal
                "tratamiento_antecedentes_patologicos_personales": tratamiento_antecedentes_patologicos_personales,
                "antecendetes_familiares_patologicos": antecendetes_familiares_patologicos,
                "gestas": gestas,
                "partos": partos,
                "cesareas": cesareas,
                "abortos": abortos,
                "fecha_ultima_menstruacion": fecha_ultima_menstruacion,
                "cuales_alergias": cuales_alergias,
                "tipo_habitos": tipo_habitos,
                "antecendetes_hospitalarios_quirurgicos": antecendetes_hospitalarios_quirurgicos,
                "motivo_consulta": motivo_consulta,
                "historia_enfermedad_actual": historia_enfermedad_actual,
                "examen_fisico": examen_fisico,
                "diagnostico": diagnostico,
                "indicaciones_tratamiento": indicaciones_tratamiento,
                "proxima_cita": proxima_cita,
                //fin medicina general
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
@endsection

