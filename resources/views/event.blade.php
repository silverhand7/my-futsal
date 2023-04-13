@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Informasi Event / Turnamen</h1>
        </div>

    </div>
    <div class="row mt-3">
        @foreach ($events as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="w-100">
                    <div class="event-image-container">
                        <a href="{{ route('event.detail', $event->id) }}">
                            <img src="{{ asset('storage/'.$event->image) }}" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection