@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($booking->status == 'pending')
            <div class="col-md-8">
                <h1>Payment Information</h1>
                <div class="card">
                    <div class="card-body">
                        <p>Please complete the booking process by completing the payment process. If you do not make a payment within <b>15 minutes</b>, your order will be automatically cancelled.</p>
                        <form action="{{ route('customer.booking.payment', $booking->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table table-borderless">
                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>{{ env('BANK_NAME') }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>:</td>
                                    <td>{{ env('NO_REKENING') }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{ env('BANK_ACCOUNT_NAME') }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>{{ number_format($booking->booking_fee) }}</td>
                                </tr>
                                <tr>
                                    <td>Proof of payment</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" name="proof_of_payment" class="form-control">
                                        @error('proof_of_payment')
                                            <p class="text-danger fs-6" role="alert">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <div class="text-end">
                                <input type="submit" class="btn btn-success" value="Upload Payment">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-8">
            <h1 class="mt-4">Booking Detail</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Code</th>
                            <td>:</td>
                            <td>{{ $booking->booking_code }}</td>
                        </tr>
                        <tr>
                            <th>Field</th>
                            <td>:</td>
                            <td>{{ $booking->field->name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td>{{ $booking->date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Start</th>
                            <td>:</td>
                            <td>{{ $booking->starting_hour }}</td>
                        </tr>
                        <tr>
                            <th>End</th>
                            <td>:</td>
                            <td>{{ $booking->ending_hour }}</td>
                        </tr>
                        <tr>
                            <th>Fee</th>
                            <td>:</td>
                            <td>{{ number_format($booking->booking_fee) }}</td>
                        </tr>
                        @if (!empty($booking->proof_of_payment))
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td>:</td>
                                <td><a href="{{ asset('storage/'.$booking->proof_of_payment) }}" target="_blank">Payment Confirmatin Receipt</a></td>
                            </tr>
                        @endif
                        <tr>
                            <th class="border-bottom-0">Status</th>
                            <td class="border-bottom-0">:</td>
                            <td class="border-bottom-0">{{ ucwords($booking->status) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection