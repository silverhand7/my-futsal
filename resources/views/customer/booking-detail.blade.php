@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Informasi Pembayaran</h1>
            <div class="card">
                <div class="card-body">
                    <p>Silahkan selesaikan proses booking dengan melengkapi pembayaran. Jika anda tidak melakukan pembayaran dalam satu jam, maka pesanan anda akan otomatis dibatalkan.</p>
                    <form action="{{ route('customer.booking.payment', $booking->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-borderless">
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td>{{ env('BANK_NAME') }}</td>
                            </tr>
                            <tr>
                                <td>No. Rekening</td>
                                <td>:</td>
                                <td>{{ env('NO_REKENING') }}</td>
                            </tr>
                            <tr>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>{{ env('BANK_ACCOUNT_NAME') }}</td>
                            </tr>
                            <tr>
                                <td>Total Biaya</td>
                                <td>:</td>
                                <td>{{ number_format($booking->booking_fee) }}</td>
                            </tr>
                            <tr>
                                <td>Bukti Pembayaran</td>
                                <td>:</td>
                                <td><input type="file" name="proof_of_payment" class="form-control"></td>
                            </tr>
                        </table>
                        <div class="text-end">
                            <input type="submit" class="btn btn-success" value="Upload Bukti Pembayaran">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="mt-4">Booking Detail</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td>{{ $booking->booking_code }}</td>
                        </tr>
                        <tr>
                            <th>Lapangan</th>
                            <td>:</td>
                            <td>{{ $booking->field->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td>{{ $booking->date->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jam Mulai</th>
                            <td>:</td>
                            <td>{{ $booking->starting_hour }}</td>
                        </tr>
                        <tr>
                            <th>Jam Selesai</th>
                            <td>:</td>
                            <td>{{ $booking->ending_hour }}</td>
                        </tr>
                        <tr>
                            <th>Biaya</th>
                            <td>:</td>
                            <td>{{ number_format($booking->booking_fee) }}</td>
                        </tr>
                        <tr>
                            <th class="border-bottom-0">Status</th>
                            <th class="border-bottom-0">:</th>
                            <td class="border-bottom-0">{{ ucwords($booking->status) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection