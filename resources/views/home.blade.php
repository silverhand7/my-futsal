@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Field Schedule</h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="mb-4">
                        <a href="{{ route('customer.booking.form') }}" class="btn btn-primary">Booking Lapangan</a>
                    </div> --}}
                    {{-- <div id="calendar-app"></div> --}}
                    <div id="booking-schedule-app"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection