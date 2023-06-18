@extends('layouts.app')

@section('content')

<div class="container-fluid mb-5" style="margin-top: -4rem">
    <div class="row">
        <div class="col-md-12 p-0">
            <img src="{{ asset('img/gallery/lapangan1.jpg') }}" alt="logo" class="img-fluid" style="width:100%; height:350px; object-fit: cover">
        </div>
    </div>
</div>
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>About us</h1>
        </div>
        <div class="col-md-12">
            <p>Our futsal court is made of the best materials. We don't want a court that is only beautiful to look at, but also comfortable to play on. Therefore, we ensure that our pitches are the right size according to international standards. This allows players to move freely and enjoy the game to the fullest. In addition, we always take care of and maintain the field so that it is comfortable to play at all times. We also have the best lighting facilities, so players can play comfortably both day and night. We truly believe that a comfortable futsal field is one of the most important factors in enjoying the game of soccer. And we are happy to provide the best futsal field for our players.</p>
        </div>
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td>Jl. Teuku Umar Barat No.351a, Padangsambian, Denpasar Barat, Denpasar City, Bali 80117</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <td>087743354422</td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15776.494693255056!2d115.1870226!3d-8.6797876!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd247a78647f6bb%3A0xc6010fe3c96c9e5!2sMY%20STADIUM!5e0!3m2!1sen!2sid!4v1680080743531!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan7.jpeg') }}" alt="logo" class="img-fluid">
        </div>
        <div class="col-md-6 mb-3">
            <img src="{{ asset('img/gallery/lapangan8.jpeg') }}" alt="logo" class="img-fluid">
        </div>
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