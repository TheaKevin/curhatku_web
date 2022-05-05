<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="loginModal">{{ __('Login') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="masuk">
                        Masuk
                    </label>
                    
                    <div class="form-group">

                        <input class="mb-3 form-control @error('email') is-invalid @enderror"
                            type="text"
                            name="email"
                            id="email"
                            placeholder="email">
                        @error('email')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        <input class="mb-3 form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="password">
                        @error('password')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="mb-3" for="remember">Remember me?</label>

                        <button
                            class="btn btn-lg btn-primary mb-3"
                            type="submit"
                            style="width: 100%; height: 36px;">
                                Login
                        </button>

                    </div>

                </form>

                <a class="forgotpassword"
                    style="cursor: pointer"
                    data-bs-dismiss="modal"
                    data-bs-toggle="modal"
                    data-bs-target="#forgetPassword">
                        Lupa password?
                </a>
                
                <h5>
                    <span>
                        OR
                    </span>
                </h5>

                <a
                    class="btn btn-lg btn-primary"
                    style="width: 100%; height: 36px; cursor: pointer;"
                    data-bs-dismiss="modal"
                    data-bs-toggle="modal"
                    href="#registerModal">
                        Daftar Akun
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .masuk{
        margin-bottom: 21px;
        font-family: Inter;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 29px;
        color: #000000;
    }

    .forgotpassword{
        font-family: Inter;
        font-style: normal;
        font-weight: bold;
        font-size: 22px;
        line-height: 29px;
        color: #000000;
        text-decoration: none;
    }

    .forgotpassword:hover{
        text-decoration: none;
    }

    h5{
        width: 100%; 
        text-align: center; 
        border-bottom: 1px solid #000; 
        line-height: 0.1em;
        margin: 10px 0 20px;
        font-family: Inter;
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        color: #000000;
        margin-top: 21px;
    }

    h5 span{
        background:#fff; 
        padding:0 10px;
    }
</style>

<script type="text/javascript">
    @if( ($errors->has('email') == 1 || $errors->has('password') == 1) || Session::has('loginError'))

        @if($errors->has('email') == 1)
            document.getElementById('email').classList.remove('mb-3');
        @endif

        @if($errors->has('password') == 1)
            document.getElementById('password').classList.remove('mb-3');
        @endif

        $(window).on('load', function() {
            $('#loginModal').modal('show');
        });
    @endif
</script>