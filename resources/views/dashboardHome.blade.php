@extends('layouts.menu')
@section("scriptsCSS")
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">        
            <section class="content">                
                <!-- Default box -->
                <div class="card">
                  <div class="card-body">
                      <div class="jumbotron jumbotron-fluid" style="padding-bottom: 2%">
                          <div class="container">
                                <h1 class="display-4"><i class="nav-icon fas fa-regular fa-home"></i><b>Inicio</b></h1>                                
                            </div>                           
                      </div>
                      <ol class="breadcrumb float-sm-left">
                      </ol>
                  </div>                    
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
        <!-- /.content -->           
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6">
            <!-- Default box -->
            <div class="card card-primary">                  
              <div class="card-header">
                  <h3 class="card-title">
                      <i class="nav-icon fas fa-user-lock"></i> Registros de Pacientes por mes
                  </h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>                
                </div>
              </div>  

              <div class="card-body">
                  <div style="">
                      <canvas id="canvas_registro_pasientes_mensual"></canvas>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">          
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            
            <!-- Default box -->
            <div class="card card-primary">                  
              <div class="card-header">
                  <h3 class="card-title">
                      <i class="nav-icon fas fa-user-lock"></i> Pacientes Por Genero y Edad
                  </h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>                
                </div>
              </div>  

              <div class="card-body">
                  <div class="">
                      <div class="chart-responsive"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <canvas id="canvas_pacientes_genero_edad" height="99" style="display: block; width: 199px; height: 99px;" width="199" class="chartjs-render-monitor"></canvas>
                      </div>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">          
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <!-- Default box -->
            <div class="card card-primary">                  
              <div class="card-header">
                  <h3 class="card-title">
                      <i class="nav-icon fas fa-user-lock"></i> Atendidos por Area de Clinica
                  </h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>                
                </div>
              </div>  

              <div class="card-body">
                  <div class="">
                      <div class="chart-responsive"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                          <canvas id="canvas_areas_atendidos_historico" height="99" style="display: block; width: 199px; height: 99px;" width="199" class="chartjs-render-monitor"></canvas>
                      </div>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">          
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            
            <!-- Default box -->
            <div class="card card-primary">                  
              <div class="card-header">
                  <h3 class="card-title">
                      <i class="nav-icon fas fa-user-lock"></i> Pacientes por Region de Origen
                  </h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>                
                </div>
              </div>  

                
              <div class="card-body">
                  
                  <div id="vmap" style="height: 425px; width: 100%; position: relative; overflow: hidden; background-color: transparent;">
                      
                    </div>


              </div>
              <!-- /.card-body -->
              <div class="card-footer">          
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
        
    </div>
      

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@section("scripts")
<script type="text/javascript">
    
var solicitud_por_dia = [];
$(document).ready(function () {

    var config_canvas_registro_pasientes_mensual = {
        type: 'line',
        data: {
            labels: [ 0 , @foreach($pacientes_registrados_lista as $rowc1)
                                '{{$rowc1->mes_registro}}',
                            @endforeach],
            datasets: [{
                label: '',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                data: [
                    0 ,
                    @foreach($pacientes_registrados_lista as $rowc1)
                        '{{$rowc1->numero_registros}}',
                    @endforeach

                ],
                fill: true,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Inscripciones por Mes'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Mes'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Pacientes'
                    }
                }]
            }
        }
    };
    
    var config_canvas_areas_atendidos_historico = {
        type: 'doughnut',
        data: {
            labels: [ 'PEDIATRÍA' , 'GINECOLOGÍA', 'MEDICINA GENERAL'],
            datasets: [{
                label: 'Areas',
                data: [

                    @foreach($areas_atendidos_historico as $rowc2)
                        '{{$rowc2->pediatria}}','{{$rowc2->ginecologia}}','{{$rowc2->medicina_general}}',
                    @endforeach

                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4,
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }       
    };
    
    var config_canvas_pacientes_genero_edad = {
        type: 'doughnut',
        data: {
            labels: [ 'Mujeres' , 'Hombres', 'Niñas', 'Niños'],
            datasets: [{
                label: 'Pacientes',
                data: [

                    @foreach($pacientes_genero_edad as $rowc3)
                        '{{$rowc3->adultos_femeninos}}','{{$rowc3->adultos_masculinos}}','{{$rowc3->ninos_femeninos}}','{{$rowc3->ninos_masculinos}}',
                    @endforeach

                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 105, 65)'
                ],
                hoverOffset: 4,
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }       
    };
    
    window.onload = function() {
        var ctx_registro_pasientes_mensual = document.getElementById('canvas_registro_pasientes_mensual').getContext('2d');
        window.myLine = new Chart(ctx_registro_pasientes_mensual, config_canvas_registro_pasientes_mensual);
    
        var ctx_areas_atendidos_historico = document.getElementById('canvas_areas_atendidos_historico').getContext('2d');
        window.myLine = new Chart(ctx_areas_atendidos_historico, config_canvas_areas_atendidos_historico);
        
        var ctx_pacientes_genero_edad = document.getElementById('canvas_pacientes_genero_edad').getContext('2d');
        window.myLine = new Chart(ctx_pacientes_genero_edad, config_canvas_pacientes_genero_edad);
    };
    
    //var gdpData = {"hn-ol":"77", "hn-in":"55","hn-le":"88" ,"hn-oc":"88" , "hn-cm":"11"};
    
    var paciente_procedencia = {
        @foreach($pacientes_region_procedencia as $row1)
            "{{$row1->cod_departamento}}":"{{$row1->pacientes}}",
        @endforeach
    };
    
    jQuery('#vmap').vectorMap({
        map: 'honduras_hn',
        backgroundColor: '#a5bfdd',
        borderColor: '#818181',
        borderOpacity: 0.25,        
        color: '#f4f3f0',
        enableZoom: true,
        hoverColor: '#c9dfaf',
        hoverOpacity: null,
        normalizeFunction: 'linear',
        values: paciente_procedencia,
        scaleColors: ['#b6d6ff', '#005ace'],
        selectedColor: '#c9dfaf',
        selectedRegion: null,
        showTooltip: true,
        borderWidth: 1,        
        onRegionOver: function(element, code, region){
            
            jQuery('#vmap').bind('labelShow.jqvmap',
                function(event, label, code)
                {
                    if( paciente_procedencia[code] > 0 ){
                        label.text(region+': '+paciente_procedencia[code]+' Pacientes');
                    }
                }
            );
    
        }
    });
        
        
});

</script>
@endsection