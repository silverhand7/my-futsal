@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Detail Event</h1>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <img src="{{ asset('storage/'.$event->image) }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <div>
                <h2>{{ $event->name }}</h2>
                <div>
                    {!! nl2br($event->description) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection