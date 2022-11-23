@extends('layouts.user_type.guest')

@section('content')

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                    <div class="mb-4 shadow-none text-center">
                        <img class=""
                        style="width:auto; height:100px;
                                "
                        src="{{asset('/images/LOGO.png')}}" >
                  
                    </div>
                    <h3 class="font-weight-bolder text-info text-gradient">¡Bienvenidos!</h3>
                  <p class="mb-0">Solicita tu usuario en administración<br></p>
                  <p class="mb-0">O Inicia sesión con tus credenciales:</p>
                  {{-- <p class="mb-0">Usuario <b>oacosta</b></p>
                  <p class="mb-0">Contraseña <b>reservada</b></p> --}}
                    @if (session('error'))
                       <div class="alert alert-danger" style="color: white ;">
                           {{ session('error') }}
                       </div>
                    @endif
                    
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>Usuario</label>
                    <div class="mb-3">
                      <input type="text" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" 
                      name="login" value="{{ old('username') ?: old('email') }}" placeholder="Usuario"  
                      aria-label="Email" aria-describedby="email-info" autofocus required>
                      
                      @if ($errors->has('username') || $errors->has('email'))
                       <p class="text-danger text-xs mt-2">
                           {{ $errors->first('username') ?: $errors->first('email') }}
                       </p>
                      @endif
                      
                    </div>
                    <label>Contraseña</label>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" 
                      name="password"  required id="password" 
                      placeholder="Contraseña" aria-label="Password" aria-describedby="password-info">
                      
                      @error('password')
                        <p class="text-danger text-xs mt-2" role="alert">
                            {{ $message }}
                        </p>
                      @enderror

                      
                    </div>
                    {{-- <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Recuerame</label>
                    </div> --}}
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Iniciar sesión</button>
                    </div>
                  </form>
                </div>
                {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Forgot you password? Reset you password 
                  <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">here</a>
                </small>
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div> --}}
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{asset('/images/curved-images/fondo_cmd4.jpg')}}')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
