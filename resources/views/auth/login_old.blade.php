@extends('layouts.app')
@section('content')
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('/images/LOGO Centro Médico Díaz.png')}}" alt="logo">
              </div>
              <h4>¡Hola! Vamos a comenzar</h4>
              <h6 class="fw-light">Inicie sesion para continuar.</h6>              
              <form method="POST" action="{{ route('login') }}" class="pt-3">
                        @csrf
                <div class="form-group">
                  <!-- container-scroller <input type="text" class="form-control form-control-lg" id="login" placeholder="{{ __('Usuario') }}">-->
                  
                  <input id="login" type="text"
                    class="form-control form-control-lg {{ $errors->has('name') || $errors->has('email') ? ' is-invalid' : '' }}"
                    name="login" value="{{ old('username') ?: old('email') }}" required autocomplete="email" autofocus 
                    placeholder="{{ __('Usuario') }}">

                    @if ($errors->has('name') || $errors->has('email'))
                       <span class="invalid-feedback">
                           <strong>{{ $errors->first('name') ?: $errors->first('email') }}</strong>
                       </span>
                   @endif
                </div>
                <div class="form-group">
                  <!-- container-scroller<input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="{{ __('Contraseña') }}">-->
                  
                  <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" 
                         required autocomplete="current-password" placeholder="{{ __('Contraseña') }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                                                                
                </div>
                
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">                                          
                    <!--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Recuerdame') }}
                    </label>-->
                  </div>                  
                </div>  
                  
                  <div class="mt-3">                                    
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    {{ __('Sesion') }}
                  </button>
                </div>
                  
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
 
  <!-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text"
                                    class="form-control{{ $errors->has('name') || $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="login" value="{{ old('username') ?: old('email') }}" required autocomplete="email" autofocus>

                                 @if ($errors->has('name') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuerdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sesion') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  -->
@endsection
