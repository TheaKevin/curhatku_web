@extends('layouts.app')

@section('content')
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

    {{ $curhat->links() }}
@endsection