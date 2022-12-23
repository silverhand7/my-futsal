@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Form Booking</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customer.booking.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Lapangan</label>
                            <select name="field_id" id="" class="form-control">
                                <option value="">- Pilih Lapangan -</option>
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                            @error('field_id')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="date">
                            @error('date')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Jam Mulai</label>
                            <input type="time" name="starting_hour" class="form-control">
                            @error('starting_hour')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="">Durasi</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="duration">
                                <span class="input-group-text" id="basic-addon2">Jam</span>
                            </div>
                            @error('duration')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group text-end">
                            <input type="submit" value="Proses" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection