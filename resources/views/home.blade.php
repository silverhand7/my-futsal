@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Jadwal Lapangan</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <a href="{{ route('customer.booking.form') }}" class="btn btn-primary">Booking Lapangan</a>
                    </div>
                    <div id="calendar-app"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection