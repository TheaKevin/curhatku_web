<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="registerModal">{{ __('DAFTAR') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if (session('registerError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('registerError') }}
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <label
                     class="daftar">
                        Daftar
                    </label>
                    
                    <div class="form-group">

                        {{-- NAMA USER --}}
                        <input class="mb-3 form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        {{-- GENDER USER --}}
                        <label for="">Gender</label>
                        <div class="gender mb-3" style="flex-direction: row;">

                            <input type="radio" value="Pria" name="gender" checked>
                            <label class="kelamin" for="gender" style="margin-right: 10px;">Pria</label>

                            <input type="radio" value="Wanita" name="gender">
                            <label class="kelamin" for="gender">Wanita</label>

                        </div>

                        {{-- TANGGAL LAHIR USER --}}
                        <label for="dob">Tanggal Lahir</label>
                        <input class="mb-3 form-control @error('dob') is-invalid @enderror"
                            type="date"
                            name="dob"
                            id="dob">
                        @error('dob')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        {{-- EMAIL --}}
                        <input class="mb-3 form-control @error('email_register') is-invalid @enderror"
                            type="text"
                            name="email_register"
                            id="email_register"
                            placeholder="Email">
                        @error('email_register')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        {{-- PASSWORD --}}
                        <input class="mb-3 form-control @error('password_register') is-invalid @enderror"
                            type="password"
                            name="password_register"
                            id="password_register"
                            placeholder="Kata sandi">
                        @error('password_register')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        {{-- CONFIRM PASSWORD --}}
                        <input class="mb-3 form-control @error('password_register_confirmation') is-invalid @enderror"
                            type="password"
                            name="password_register_confirmation"
                            id="password_register_confirmation"
                            placeholder="Konfirmasi kata sandi">
                        @error('password_register_confirmation')
                            <div class="invalid-feedback mb-3">{{ $message }}</div>
                        @enderror

                        <input type="checkbox" style="margin-left: 5%;margin-top: 10px;" onchange="SdkOnchange()" id="sdkvalue">
                        <a href="#" onclick=""> Syarat dan Ketentuan </a>
                        <br>
                        <br>
                        <button id="submitButton" class="btn btn-lg btn-primary" type="submit" >Daftar Akun</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("submitButton").disabled = true;
    
    function SdkOnchange()
    {
        if(document.getElementById("sdkvalue").checked){
            document.getElementById("submitButton").disabled = false;
        }else{
            document.getElementById("submitButton").disabled = true;
        }
    }

</script>

<style>
    .daftar{
        margin-bottom: 21px;
        font-family: Inter;
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        line-height: 29px;
        color: #000000;
    }
</style>

<script type="text/javascript">
    @if( ($errors->has('name') == 1 ||
            $errors->has('alamat') == 1 ||
            $errors->has('telp') == 1 ||
            $errors->has('email_register') == 1 ||
            $errors->has('password_register') == 1 ||
            $errors->has('password_register_confirmation') == 1)
          || Session::has('registerError') )

        @if($errors->has('name') == 1)
            document.getElementById('name').classList.remove('mb-3');
        @endif
        
        @if($errors->has('dob') == 1)
            document.getElementById('dob').classList.remove('mb-3');
        @endif

        @if($errors->has('email_register') == 1)
            document.getElementById('email_register').classList.remove('mb-3');
        @endif

        @if($errors->has('password_register') == 1)
            document.getElementById('password_register').classList.remove('mb-3');
        @endif

        @if($errors->has('password_register_confirmation') == 1)
            document.getElementById('password_register_confirmation').classList.remove('mb-3');
        @endif
        
        $(window).on('load', function() {
            $('#registerModal').modal('show');
        });
    @endif
</script>