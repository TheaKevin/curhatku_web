@extends('layouts.app')

@section('content')

<div class="container-large">
    <div class="kartu">
        <div class="image">
            @php $path = Storage::url(Auth::user()->userImage); @endphp
            <img style="border-radius: 20px " src="{{ url($path) }}"/>
        </div>

        <div class="content-title">

            <div class="content-title-userName">
                {{Auth::user()->name}}
            </div>
            
            <a href="{{ route('EditProfile') }}" class="edit-button">Edit Profile</a>

        </div>

        <div class="content-body">
            <div class="content-status">
                @if(Auth::user()->status == NULL)
                    Tidak ada status
                @else
                    {{Auth::user()->status}}
                @endif
            </div>
        </div>

        <div class="curhat">

            <div class="totalCurhat">
                Curhat : {{ $totalCurhat }}
            </div>

        </div>
    </div>

    <div class="container d-flex flex-row flex-wrap justify-content-evenly">
        @foreach ($curhat as $curhats)
            @if ($curhats->user->gender == 'Pria')
                <div class="curhatCardPria my-3 h-350px">
                    <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                        @if ($curhats->anonymous == 1)
                            <div class="curhatProfile Pria align-self-center">{{ $curhats->user->gender }}, {{ $curhats->user->age }}</div>
                        @else
                            <div class="curhatProfile Pria align-self-center">{{ $curhats->user->name }}, {{ $curhats->user->age }}</div>
                        @endif

                        <img class="curhatIcon" src="{{ asset('storage/asset/man.png') }}" alt="{{ $curhats->user->gender }}">
                    </div>
                    <div class="curhatDate Pria mb-3 mx-3">
                        @php
                            $date = date('F j, Y', strtotime($curhats->created_at));
                        @endphp
                        {{ $date }}
                    </div>
                    <div class="curhatBody Pria mx-3">
                        <a href="{{ route('Curhat', $curhats->id) }}" class="Pria isiCurhatPria">
                            {{ Str::limit(strip_tags($curhats->curhat), 185) }}
                            @if(strlen(strip_tags($curhats->curhat)) > 185)
                                <a href="{{ route('Curhat', $curhats->id) }}" class="readMorePria">Read More</a>
                            @endif
                        </a>
                    </div>
                </div>
            @else
                <div class="curhatCardWanita my-3 h-350px">
                    <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                        @if ($curhats->anonymous == 1)
                            <div class="curhatProfile Wanita align-self-center">{{ $curhats->user->gender }}, {{ $curhats->user->age }}</div>
                        @else
                            <div class="curhatProfile Wanita align-self-center">{{ $curhats->user->name }}, {{ $curhats->user->age }}</div>
                        @endif

                        <img class="curhatIcon" src="{{ asset('storage/asset/woman.png') }}" alt="{{ $curhats->user->gender }}">
                    </div>
                    <div class="curhatDate Wanita mb-3 mx-3">
                        @php
                            $date = date('F j, Y', strtotime($curhats->created_at));
                        @endphp
                        {{ $date }}
                    </div>
                    <div class="curhatBody Wanita mx-3">
                        <a href="{{ route('Curhat', $curhats->id) }}" class="Wanita isiCurhatWanita">
                            {{ Str::limit(strip_tags($curhats->curhat), 185) }}
                            @if(strlen(strip_tags($curhats->curhat)) > 185)
                                <a href="{{ route('Curhat', $curhats->id) }}" class="readMoreWanita">Read More</a>
                            @endif
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    
</div>

@endsection

<style>

    .container-large{
        margin-left: 2%;
        margin-right: 2%;
        width: 96%
    }

    .kartu {
        position: relative;
        display: grid;
        grid-template-columns: 25% 75%;
        grid-template-rows: 48px 100px 25px;
        grid-gap: 10px;
        padding-left: 20px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    .image{
        grid-row: 1 / 4;
        width: 100%;
        margin: auto;
    }

    .image img{
        height: 173px;
    }

    .content-title{
        display: flex;
        justify-content: space-between;
        margin-right: 5%;
        grid-row: 1 / 2;
        margin-left: 2%;
    }

    .content-title-userName{
        font-family: Inter;
        font-style: normal;
        font-weight: bold;
        font-size: 48px;
        line-height: 58px;
        color: #000000;
    }

    .content-body{
        grid-row: 2 / 3;
        margin-left: 2%;
        width: 100%;
    }

    .content-status{
        margin-right: 5%;
    }

    .content-saldo{
        margin-top: 10px;
    }

    .edit-button{
        color: blue;
        align-items: center;
        width: 198px;
        height: 43.79px;
        background: #1FCC79;
        border-radius: 10px;
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        font-size: 18px;
        line-height: 22px;
        color: #FFFFFF;
        text-align: center;
        margin-top: auto;
        padding: 10px 32px;
        margin-bottom: auto;
        text-decoration: none;
    }

    .curhat{
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-evenly;
    }

    .follower,
    .follower:hover,
    .following,
    .following:hover,
    .totalCurhat{
        font-family: Inter;
        font-style: normal;
        font-size: 18px;
        line-height: 22px;
        color: #000000;
    }

    @media screen and (max-width: 575px) {
        .content-title-userName{
            font-size: 24px;
            line-height: 25px;
        }
    }

    @media screen and (min-width: 576px) and (max-width: 735px) {
        .content-title-userName{
            font-size: 30px;
            line-height: 35px;
        }
    }

    @media screen and (min-width: 736px) and (max-width: 930px) {
        .kartu{
            padding-left: 0;
            grid-template-rows: 65px 100px 25px;
        }

        .content-title-userName{
            font-size: 35px;
            line-height: 40px;
        }

        .content-title{
            grid-row: 1 / 2;
            flex-direction: column
        }

        .edit-button{
            width: 100%;
            font-size: 12px;
            line-height: 18px;
            height: 30px;
            padding: auto;
        }

        .content-body{
            grid-row: 2 / 3;
        }
    }

    @media screen and (max-width: 735px) {
        .kartu{
            padding-left: 0;
            grid-template-rows: 75px 75px 25px;
            grid-template-columns: 100px auto;
        }

        .image{
            grid-row: 1 / 2;
        }
        
        .image img{
            height: 100%;
            padding-left: 10px;
        }

        .content-title{
            grid-row: 1 / 2;
            flex-direction: column
        }

        .edit-button{
            width: 100%;
            font-size: 12px;
            line-height: 18px;
            height: 30px;
            padding: auto;
        }

        .content-body{
            grid-row: 2 / 3;
            grid-column: 1 / 3;
        }
    }

    @media screen and (min-width: 930px) and (max-width: 1198px) {
        .content-title-userName{
            font-size: 35px;
            line-height: 40px;
        }
    }

    @media screen and (min-width: 1199px) {
        .container-large{
            width: 1140px;
            margin: auto;
        }
    }

</style>