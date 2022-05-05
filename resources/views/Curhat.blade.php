@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center">
        @if ($curhat->user->gender == 'Pria')
            <div class="curhatCardPria my-3 h-auto w-75">
                <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                    @if ($curhat->anonymous == 1)
                        <div class="curhatProfile Pria align-self-center">{{ $curhat->user->gender }}, {{ $curhat->user->age }}</div>
                    @else
                        <div class="curhatProfile Pria align-self-center">{{ $curhat->user->name }}, {{ $curhat->user->age }}</div>
                    @endif

                    <img class="curhatIcon" src="{{ asset('storage/asset/man.png') }}" alt="{{ $curhat->user->gender }}">
                </div>
                <div class="curhatDate Pria mb-3 mx-3">
                    @php
                        $date = date('F j, Y', strtotime($curhat->created_at));
                    @endphp
                    {{ $date }}
                </div>
                <div class="curhatBody Pria mx-3 mb-3">
                    <div class="Pria isiCurhatPria">
                        {{$curhat->curhat}}
                    </div>
                </div>
            </div>
        @else
            <div class="curhatCardWanita my-3 h-auto w-75">
                <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                    @if ($curhat->anonymous == 1)
                        <div class="curhatProfile Wanita align-self-center">{{ $curhat->user->gender }}, {{ $curhat->user->age }}</div>
                    @else
                        <div class="curhatProfile Wanita align-self-center">{{ $curhat->user->name }}, {{ $curhat->user->age }}</div>
                    @endif

                    <img class="curhatIcon" src="{{ asset('storage/asset/woman.png') }}" alt="{{ $curhat->user->gender }}">
                </div>
                <div class="curhatDate Wanita mb-3 mx-3">
                    @php
                        $date = date('F j, Y', strtotime($curhat->created_at));
                    @endphp
                    {{ $date }}
                </div>
                <div class="curhatBody Wanita mx-3 mb-3">
                    <div class="Wanita isiCurhatWanita">
                        {{$curhat->curhat}}
                    </div>
                </div>
            </div>
        @endif

        <div class="w-75 my-3">
            <form action="{{ route('Comment') }}" method="POST"  enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <textarea class="form-control @error('comment') is-invalid @enderror"
                    name="comment"
                    id="comment"
                    placeholder="Tulis komentarmu..."></textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <input class="form-control @error('curhat_id') is-invalid @enderror"
                    type="text"
                    name="curhat_id"
                    id="curhat_id"
                    value="{{$curhat->id}}"
                    hidden>
                </div>

                @guest
                    <button class="btn btn-lg btn-primary" type="submit" disabled>Posting</button>
                @else
                    <button class="btn btn-lg btn-primary" type="submit">Posting</button>
                @endguest

            </form>
        </div>

        <div class="w-75">
            @foreach ($comment as $comments)
                @if ($comments->user->gender == 'Pria')
                    <div class="curhatCardPria h-auto w-100 mb-3">

                        <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                            @if($comments->user_id == $curhat->user_id)

                                @if ($curhat->anonymous == 1)
                                    <div class="curhatProfile Pria align-self-center d-flex flex-row">
                                        {{ $curhat->user->gender }}, {{ $curhat->user->age }}
                                        <div class="ms-2 penulisPria align-self-center">
                                            Penulis
                                        </div>
                                    </div>
                                @else
                                    <div class="curhatProfile Pria align-self-center d-flex flex-row">
                                        {{ $curhat->user->name }}, {{ $curhat->user->age }}
                                        <div class="ms-2 penulisPria align-self-center">
                                            Penulis
                                        </div>
                                    </div>
                                @endif

                            @else

                                @if ($comments->user->anonymous == 1)
                                    <div class="curhatProfile Pria align-self-center">
                                        {{ $comments->user->gender }}, {{ $comments->user->age }}
                                    </div>
                                @else
                                    <div class="curhatProfile Pria align-self-center">
                                        {{ $comments->user->name }}, {{ $comments->user->age }}
                                    </div>
                                @endif

                            @endif
        
                            <img class="curhatIcon" src="{{ asset('storage/asset/man.png') }}" alt="{{ $comments->user->gender }}">
                        </div>

                        <div class="curhatDate Pria mb-3 mx-3">
                            @php
                                $date = date('F j, Y', strtotime($comments->created_at));
                            @endphp
                            {{ $date }}
                        </div>

                        <div class="curhatBody Pria mx-3 mb-3">
                            <div class="Pria isiCurhatPria">
                                {{$comments->comment}}
                            </div>
                        </div>

                    </div>
                @else
                    <div class="curhatCardWanita h-auto w-100 mb-3">

                        <div class="d-flex justify-content-between curhatHeader mt-3 mx-3">
                            @if($comments->user_id == $curhat->user_id)

                                @if ($curhat->anonymous == 1)
                                    <div class="curhatProfile Wanita align-self-center d-flex flex-row">
                                        {{ $curhat->user->gender }}, {{ $curhat->user->age }}
                                        <div class="ms-2 penulisWanita align-self-center">
                                            Penulis
                                        </div>
                                    </div>
                                @else
                                    <div class="curhatProfile Wanita align-self-center d-flex flex-row">
                                        {{ $curhat->user->name }}, {{ $curhat->user->age }}
                                        <div class="ms-2 penulisWanita align-self-center">
                                            Penulis
                                        </div>
                                    </div>
                                @endif

                            @else

                                @if ($comments->user->anonymous == 1)
                                    <div class="curhatProfile Wanita align-self-center">
                                        {{ $comments->user->gender }}, {{ $comments->user->age }}
                                    </div>
                                @else
                                    <div class="curhatProfile Wanita align-self-center">
                                        {{ $comments->user->name }}, {{ $comments->user->age }}
                                    </div>
                                @endif

                            @endif
        
                            <img class="curhatIcon" src="{{ asset('storage/asset/woman.png') }}" alt="{{ $comments->user->gender }}">
                        </div>

                        <div class="curhatDate Wanita mb-3 mx-3">
                            @php
                                $date = date('F j, Y', strtotime($comments->created_at));
                            @endphp
                            {{ $date }}
                        </div>

                        <div class="curhatBody Wanita mx-3 mb-3">
                            <div class="Wanita isiCurhatWanita">
                                {{$comments->comment}}
                            </div>
                        </div>
                        
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection