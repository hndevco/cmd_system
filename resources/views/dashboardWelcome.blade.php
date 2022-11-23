@extends('layouts.menu')
@section("scriptsCSS")
@endsection
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
            <div class="col-12 text-center d-flex align-items-center justify-content-center">
                <div class="">
                    <img src="{{asset('/images/LOGO_Centro_Medico_Diaz.png')}}" alt="AdminLTELogo" height="430" width="430">
                    <h2><i class='fas fa-user'></i> {{ Auth::user()->name }} | <small>{{ Auth::user()->username }}</small></h2>
                    <hr>
                    <h2><strong>CENTRO MÉDICO DÍAZ</strong></h2>
                    <p class="lead mb-5">
                        Barrio El Campo, contiguo a Banco de Occidente, Catacamas, Honduras<br />
                        Teléfono: 9513-6684
                    </p>
                </div>
            </div>
            <!-- <div class="col-7">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" id="inputName" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="inputEmail">E-Mail</label>
                    <input type="email" id="inputEmail" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="inputSubject">Subject</label>
                    <input type="text" id="inputSubject" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="inputMessage">Message</label>
                    <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Send message" />
                </div>
            </div> -->
       
</section>



@endsection