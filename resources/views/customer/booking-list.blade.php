@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>My Bookings</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Field</th>
                                <th>Date</th>
                                <th>Start Hour</th>
                                <th>End Hour</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>{{ $booking->field->name }}</td>
                                    <td>{{ $booking->date->format('d/m/Y') }}</td>
                                    <td>{{ $booking->starting_hour }}</td>
                                    <td>{{ $booking->ending_hour }}</td>
                                    <td>{{ ucwords($booking->status) }}</td>
                                    <td>
                                        <a href="{{ route('customer.booking.detail', $booking->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection