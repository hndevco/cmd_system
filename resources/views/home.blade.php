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

      <!-- Default box -->
      <div class="card card-primary">                  
        <div class="card-header">
            <h3 class="card-title">
                <i class="nav-icon fas fa-user-lock"></i> Sesión
            </h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>                
          </div>
        </div>  
          
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            {{ __('Has iniciado sesión!') }}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
