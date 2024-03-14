@extends('layouts.guest')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Address
                    </div>
                    <h2 class="page-title">
                        Create Address
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">

                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <!-- Alert -->
            <x-alert-success />
            <x-alert-error />

            <div class="row row-deck row-cards">

                <div class="col-12 col-lg-8">
                    <div class="card card-md">
                        <form action="{{ route('user.addresses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <a href="{{ route('user.addresses.index') }}" class="btn btn-icon">
                                    <i class="ti ti-chevrons-left"></i>

                                </a>
                            </div>
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="ti ti-fountain-filled"></i>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">


                                        <div class="mb-3">
                                            <label class="form-label required">Label</label>
                                            <input type="text" name="label" value="{{ old('label') }}"
                                                class="form-control @error('label') is-invalid @enderror" placeholder="">
                                            <small class="form-hint">Home, Office, etc.</small>
                                            @error('label')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Recipient Name</label>
                                            <input type="text" name="recipient_name" value="{{ old('recipient_name') }}"
                                                class="form-control @error('recipient_name') is-invalid @enderror"
                                                placeholder="">
                                            @error('recipient_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">No HP</label>
                                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="">
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Complete Address
                                            </label>
                                            <textarea class="form-control @error('street_address') is-invalid @enderror" name="street_address" rows="4"
                                                placeholder="">{{ old('street_address') }}</textarea>
                                            @error('street_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Note</label>
                                            <input type="text" name="notes" value="{{ old('notes') }}"
                                                class="form-control @error('notes') is-invalid @enderror" placeholder="">
                                            <small class="form-hint">Warna rumah, patokan, pesan khusus, dll.</small>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="is_default" @checked(old('is_default'))>
                                                <span class="form-check-label">Make it Default</span>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('user.addresses.index') }}"
                                    class="btn btn-outline-secondary w-25 ">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-3 w-25 ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('custom_script')
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect(document.getElementById('product_id'))
        });
    </script>
@endpush
