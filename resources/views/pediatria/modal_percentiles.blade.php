<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl" role="document">
        <div class="modal-content card-outline card-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-chart-bar"></i> 
                    <b> Curva de Crecimiento </b>
                    <small class="badge badge-primary text-wrap">Calculadora de percentiles infatiles</small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <form id="formu" action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="genero">
                                            Género:
                                        </label>
                                        @if ($paciente->sexo == 'Masculino')
                                        <div class="form-check">
                                            <input id="nino" class="form-check-input" checked="checked" name="sexo" type="radio" value="nino">
                                            <label class="form-check-label" for="radioNino">Niño</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="nina" class="form-check-input" name="sexo" type="radio" value="nina">
                                            <label class="form-check-label" for="radioNina">Niña</label> 
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input id="nino" class="form-check-input"  name="sexo" type="radio" value="nino">
                                            <label class="form-check-label" for="radioNino">Niño</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="nina" class="form-check-input" checked="checked" name="sexo" type="radio" value="nina">
                                            <label class="form-check-label" for="radioNina">Niña</label> 
                                        </div>
                                        @endif
                                        
                                        
                                        <small id="helpId" class="text-muted">Selecciona el género del infante</small>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="peso">
                                            Peso (en Kg):
                                        </label>
                                        <input id="peso" class="form-control" max="24" maxlength="4" min="1" name="peso" required="required" size="5" step="0.1" type="number" value="{{$historial_percentil->peso ?? 0}}">
                                        
                                        <small id="helpId" class="text-muted">Ingrese el de peso (kg) del infante</small>
                                        {{-- <div id="divMensajesP" class="alert alert-danger"></div> --}}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edad">
                                            Edad (en meses):
                                        </label>
                                        <input id="edad" class="form-control" max="60" maxlength="2" min="0" name="edad" required="required" size="5" type="number" value="{{$historial_percentil->edad ?? $paciente->meses}}">
                                        
                                        <small id="helpId" class="text-muted">Ingrese el de edad (meses) del infante</small>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="altura">
                                            Altura (en cm):
                                        </label>
                                        <input id="altura" class="form-control" max="120" maxlength="3" min="45" name="altura" required="required" size="5" type="number" value="{{$historial_percentil->altura ?? 0}}">
                                        
                                        <small id="helpId" class="text-muted">Ingrese la altura (cm) del infante</small>
                                    </div>
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" onclick="mispercentiles();return false;" value="CALCULAR" style="margin-top: 10px; margin-bottom:10px;"> 
                                Calcular
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 for=""><i class="bi bi-eye-fill"></i> Observaciones:</h4>
                                <div id="divMensajesC"></div> 
                            </div>
                            
                        </div>
                    </div>
                    <div id="divGraficos">
                        <div class="row">
                        
                            <div class="col-md-6">
                                <h3>Gráfico de altura en cm</h3>
                                <div id="divGraficoAltura"
                                    style="background-image: url('http://www.calculadoraconversor.com/wp-content/uploads/2015/12/img_altura.png'); background-repeat: no-repeat; background-size: 100% auto; position: relative; height: 664px; width: 490px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Gráfico de peso en kg</h3>
                                <div id="divGraficoPeso"
                                    style="background-image: url('http://www.calculadoraconversor.com/wp-content/uploads/2015/12/img_peso.png'); background-repeat: no-repeat; background-size: 100% auto; position: relative; height: 600px; width: 490px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div id="divMensajesA"></div>--}}
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                {{-- <button type="button" class="btn btn-primary" id="btn_guardar_percentiles">Guardar</button> --}}
            </div>
        </div>
    </div>
</div>