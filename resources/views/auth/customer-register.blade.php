@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Register
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.register.action') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <p class="text-danger fs-6" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-group d-grid gap-2">

                            <input type="submit" value="Daftar" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection