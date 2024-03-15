@extends('layouts.guest')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Profile
                    </div>
                    <h2 class="page-title">
                        Edit Profile
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
                        <form action="{{ route('user-profile-information.update') }}" method="POST"
                            enctype="multipart/form-data">
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
                                            <label class="form-label required">Name</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', auth()->user()->name) }}"
                                                class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                                placeholder="">
                                            @error('name', 'updateProfileInformation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Email</label>
                                            <input type="text" name="email"
                                                value="{{ old('email', auth()->user()->email) }}"
                                                class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                                placeholder="">
                                            @error('email', 'updateProfileInformation')
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
