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
            <h1>Tentang Kami</h1>
        </div>
        <div class="col-md-12">
            <p>Lapangan futsal kami terbuat dari material terbaik. Kami tidak menginginkan lapangan yang hanya indah dipandang, tetapi juga nyaman untuk bermain. Oleh karena itu, kami memastikan bahwa lapangan kami memiliki ukuran yang tepat sesuai dengan standar internasional. Ini membuat pemain dapat bergerak dengan leluasa dan menikmati permainan dengan maksimal. Selain itu, kami selalu merawat dan menjaga lapangan agar selalu nyaman untuk dimainkan sepanjang waktu. Kami juga memiliki fasilitas pencahayaan yang terbaik, sehingga pemain dapat bermain dengan nyaman pada siang maupun malam hari. Kami benar-benar percaya bahwa lapangan futsal yang nyaman adalah salah satu faktor yang paling penting dalam menikmati permainan sepak bola. Dan kami senang dapat menyediakan lapangan futsal terbaik bagi para pemain kami.</p>
        </div>
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Teuku Umar Barat No.351a, Padangsambian, Denpasar Barat, Denpasar City, Bali 80117</td>
                </tr>
                <tr>
                    <td>No. Telp</td>
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