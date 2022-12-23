@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Lapangan</h1>
        </div>
        <div class="col-md-12">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla enim tempora amet consectetur quo ratione error consequuntur suscipit et ipsam architecto perferendis, magni odio a incidunt deleniti nesciunt praesentium voluptate! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla enim tempora amet consectetur quo ratione error consequuntur.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan2.jpg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan1.jpg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan4.jpg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan3.jpg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan5.jpg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan6.jpg') }}" alt="logo" class="img-fluid">
        </div>
    </div>
</div>
@endsection