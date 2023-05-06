<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <label for="email" 
                                                       class="small mb-1">{{ __('Email') }}
                                                </label>

                                                <input id="email" 
                                                       type="email" 
                                                       class="form-control py-4 @error('email') is-invalid @enderror" 
                                                       name="email" 
                                                       value="{{ old('email') }}" 
                                                       required 
                                                       autocomplete="email" 
                                                       autofocus 
                                                       placeholder="Enter email address">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password" 
                                                       class="small mb-1">{{ __('Password') }}
                                                </label>
                                                
                                                <input id="password" 
                                                       type="password" 
                                                       class="form-control py-4 @error('password') is-invalid @enderror" 
                                                       name="password" 
                                                       required 
                                                       autocomplete="current-password"
                                                       placeholder="Enter password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" 
                                                           type="checkbox" 
                                                           name="remember" 
                                                           id="remember" 
                                                           {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="custom-control-label" for="remember">
                                                        {{ __('Remember password') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                @if (Route::has('password.request'))
                                                    <a class="small" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Password?') }}
                                                    </a>
                                                @endif

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Login') }}
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="card-footer text-center">                                        
                                        <div class="small">
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}">{{ __('Need an account? Sign up!') }}</a><br>
                                            @endif
                                            <a href="javascript:void(0);">Need an account? Sign up!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
    </body>
</html>
