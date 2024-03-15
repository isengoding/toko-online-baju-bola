@extends('layouts.guest')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Password
                    </div>
                    <h2 class="page-title">
                        Change Password
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
            {{-- <x-alert-success /> --}}
            <x-alert-error />

            <div class="row row-deck row-cards">

                <div class="col-12 col-lg-8">
                    <div class="card card-md">
                        <form action="{{ route('user-password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="ti ti-fountain-filled"></i>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">


                                        <div class="mb-3">
                                            <label class="form-label required">Current Password</label>
                                            <input type="password" name="current_password"
                                                value="{{ old('current_password') }}"
                                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                                placeholder="">
                                            @error('current_password', 'updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">New Password</label>
                                            <input type="password" name="password" value="{{ old('password') }}"
                                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                                placeholder="">
                                            @error('password', 'updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">{{ __('Repeat Password') }}</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control form-control-user @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                                placeholder="">
                                            @error('password_confirmation', 'updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary w-25 ">Save</button>
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
    @if (session()->has('success'))
        <script>
            toastr["success"]("{{ session()->get('success') }}", "Success")
        </script>
    @endif

@endpush
