@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="judul">
            EDIT PROFILE
        </div>

        <form id="form" action="{{ route('EditProfilePost') }}" method="POST"  enctype="multipart/form-data" style="width: 1008px; margin-top: 32px;">
            @csrf

            <div class="image" style="margin-right: 10%">
                @php $path = Storage::url(Auth::user()->userImage); @endphp
                <img src="{{ url($path) }}"
                    style="height: 280px; width: 280px; margin-left: auto; margin-right: auto;"
                    class="mb-3">

                <input class="form-control @error('profPic') is-invalid @enderror"
                    id="profPic"
                    type="file"
                    name="profPic"
                    accept="image/png, image/jpeg" onchange="form.submit()">
                @error('profPic')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="width: 50%;">

            <!-- Profile Name -->
            <label for="nama">Nama</label>
            <input class="form-control @error('nama') is-invalid @enderror"
            type="text"
            name="nama"
            id="nama"
            value="{{Auth::user()->name}}"
            style="margin-bottom: 20px;"
            readonly>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Profile DOB -->
            @if(Auth::user()->dob == NULL)
                <label for="dob">Tanggal Lahir</label>
                <input class="form-control @error('dob') is-invalid @enderror"
                type="date"
                name="dob"
                id="dob"
                style="margin-bottom: 20px;">
            @else
                <label for="dob">Tanggal Lahir</label>
                <input class="form-control @error('dob') is-invalid @enderror"
                type="date"
                name="dob"
                id="dob"
                value="{{Auth::user()->dob}}"
                style="margin-bottom: 20px;">
            @endif

            @error('dob')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Profile Gender -->
            <label for="">Gender</label>
            <div class="gender" style="flex-direction: row; margin-bottom: 20px;">

                @if(Auth::user()->gender == 'Pria')
                <input type="radio" value="Pria" name="gender" checked>
                @else
                <input type="radio" value="Pria" name="gender">
                @endif

                <label class="kelamin" for="gender" style="margin-right: 10px;">Pria</label>

                @if(Auth::user()->gender == 'Wanita')
                <input type="radio" value="Wanita" name="gender" checked>
                @else
                <input type="radio" value="Wanita" name="gender">
                @endif

                <label class="kelamin" for="gender">Wanita</label>

            </div>
            
            <!-- Profile status -->
            <label for="status">Bio:</label>
            @if(Auth::user()->status == NULL)
                <textarea class="form-control @error('comment') is-invalid @enderror"
                name="status"
                id="status"
                placeholder="statusmu..."
                style="margin-bottom: 20px;"></textarea>
            @else
                <textarea class="form-control @error('comment') is-invalid @enderror"
                name="status"
                id="status"
                placeholder="statusmu..."
                style="margin-bottom: 20px;">
                    {{Auth::user()->status}}
                </textarea>
            @endif
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-check form-switch">
                <label class="form-check-label" for="anonymous">{{ __('Anonymous') }}</label>
                @if (Auth::user()->anonymous == 1)
                    <input class="form-check-input" type="checkbox" name="anonymous" id="anonymous" checked>
                @else
                    <input class="form-check-input" type="checkbox" name="anonymous" id="anonymous">
                @endif
            </div>

            <button class="submitButton" type="submit">Submit</button>

            </div>

        </form>
    </div>
    
@endsection

<style>
    .wrapper{
        display: flex;
        flex-direction: column;
        width: 1008px;
        flex-direction: column;
        margin-left: auto;
        margin-right: auto;
    }

    .judul{
        border: 1px solid black;
        border-left: none;
        border-top: none;
        border-right: none;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 36px;
        line-height: 42px;
        color: #000000;
    }

    #form{
        display: flex;
        flex-direction: row;
        width: 1008px;
    }

    .image
    {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    #profPic{
        margin-left: auto;
        margin-right: auto;
    }

    .form-group{
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    label{
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        line-height: 28px;
        color: #000000;
    }

    .kelamin{
        font-size: 18px;
    }

    .submitButton{
        background: #1FCC79;
        color: #FFFFFF;
        border-radius: 10px;
        width: 165.77px;
        margin-top: 37px;
        margin-left: auto;
        margin-right: auto;
    }

    @media screen and (max-width: 800px){
            
        #form{
            flex-direction: column;
        }

    }
</style>