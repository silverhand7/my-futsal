@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Lapangan</h1>
        </div>
        <div class="col-md-12">
            <p>Lapangan futsal kami terbuat dari material terbaik. Kami tidak menginginkan lapangan yang hanya indah dipandang, tetapi juga nyaman untuk bermain. Oleh karena itu, kami memastikan bahwa lapangan kami memiliki ukuran yang tepat sesuai dengan standar internasional. Ini membuat pemain dapat bergerak dengan leluasa dan menikmati permainan dengan maksimal. Selain itu, kami selalu merawat dan menjaga lapangan agar selalu nyaman untuk dimainkan sepanjang waktu. Kami juga memiliki fasilitas pencahayaan yang terbaik, sehingga pemain dapat bermain dengan nyaman pada siang maupun malam hari. Kami benar-benar percaya bahwa lapangan futsal yang nyaman adalah salah satu faktor yang paling penting dalam menikmati permainan sepak bola. Dan kami senang dapat menyediakan lapangan futsal terbaik bagi para pemain kami.</p>
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