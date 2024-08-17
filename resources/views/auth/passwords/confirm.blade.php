@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div> <!-- Encabezado de la tarjeta que solicita la confirmación de la contraseña -->

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }} <!-- Mensaje solicitando la confirmación de la contraseña -->

                    <!-- Formulario para la confirmación de la contraseña -->
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf <!-- Directiva Blade para incluir un token CSRF en el formulario -->

                        <!-- Campo para ingresar la contraseña -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <!-- Campo de entrada para la contraseña con clases de validación -->

                                @error('password') <!-- Directiva Blade para mostrar mensajes de error si los hay -->
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de envío y enlace para recuperar contraseña -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request')) <!-- Verifica si existe la ruta de recuperación de contraseña -->
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
