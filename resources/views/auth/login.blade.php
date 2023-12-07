<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Web Inventaris Perangkat IT</title>
        {{-- css --}}
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-blue.min.css')}}">
        {{-- icon --}}
        <link rel="icon" href="{{asset('storage/img/main/Logo-Universitas-Airlangga-UNAIR-biru.png')}}" type="image/x-icon"/>
    </head>

    <body>
        <div class="auth-layout-wrap" style="background-image: url({{asset('storage/img/main/bg-login.png')}})">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="{{asset('storage/img/main/Logo-Universitas-Airlangga-UNAIR.png')}}" alt="">
                                </div>
                                <h1 class="mb-3 text-18 text-center font-weight-bold">Meta DSID</h1>
                                <form method="POST" action="/login">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nip">Nip</label>
                                        <input id="nip"
                                            class="form-control form-control-rounded @error('nip') is-invalid @enderror"
                                            name="user_nip" value="{{ old('nip') }}" required autocomplete="nip"
                                            autofocus>
                                        @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password"
                                            class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" type="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <div class="">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @if(session()->has('loginError'))
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">    
                                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                        </symbol>
                                    </svg>
                                    
                                    <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                        <svg class="bi flex-shrink-0 me-5" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                        {{ session('loginError') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>                                    
                                    </div>
                                    @endif

                                    <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>

                                </form>
                                @if (Route::has('password.request'))

                                <div class="mt-3 text-center">

                                    <a href="{{ route('password.request') }}" class="text-muted"><u>Forgot
                                            Password?</u></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-center "
                            style="background-size: cover;background-image: url({{asset('storage/img/main/Rektorat-Unair-bg.png')}}">
                            <div class="pr-3 auth-right">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('assets/js/common-bundle-script.js')}}"></script>

        <script src="{{asset('assets/js/script.js')}}"></script>
    </body>

</html>