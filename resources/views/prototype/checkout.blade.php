@extends('layouts.guest')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="page page-center">
        <div class="container container-normal py-4">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Checkout
                            </h2>
                            {{-- <div class="text-secondary mt-1">Liverpool season 20254/2023</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-5">
                        <div class="col-6">
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="fs-3 mb-3">Informasi Saya</div>
                                    <div class="fw-bold">Alamat Pengiriman</div>
                                    <div class="mb-3">
                                        Jhon Doe <br>
                                        Jl. Merdeka Selatan No 11
                                        <br>
                                        Jakarta Selatan
                                        <br>
                                        123456
                                        <br>
                                        Indonesia
                                    </div>
                                    <div class="fw-bold">Nomor Telepon</div>
                                    <div class="">081999288388</div>



                                </div>
                            </div>
                            <div class="fw-bold">Detail Pesanan</div>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <img src="{{ asset('dist/img/products/liverpool-removebg-preview.png') }}"
                                                    alt="" width="80" height="80">
                                                <div class="ms-3">
                                                    <span class="">Liverpool Season 2024/2025</span>
                                                    <div class="">Rp. 100.000</div>
                                                    <div class="text-secondary fs-5">Away XL Nike</div>
                                                    <div class="text-secondary fs-5">1 pcs</div>
                                                </div>
                                            </div>
                                            <div class="text-end fw-bold">
                                                <div>Rp. 300.000</div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="col-4">
                            <div class="card sticky-top border-0">
                                <div class="card-body bg-transparent">
                                    <div class="d-flex justify-content-between text-secondary mb-1">
                                        <div>Jumlah Pesanan</div>
                                        <div>Rp. 2.000.000</div>
                                    </div>
                                    <div class="d-flex justify-content-between border-bottom text-secondary pb-3">
                                        <div>Pajak</div>
                                        <div>Rp. 20.000</div>
                                    </div>

                                    <div class="d-flex justify-content-between fw-bold fs-3 mt-3">
                                        <div>Total</div>
                                        <div>Rp. 2.000.000</div>
                                    </div>
                                    <div class="mt-4">
                                        <div>Dengan melanjutkan, Anda Menyetujui</div>
                                        <div>
                                            <a href="">Syarat dan Ketentuan Umum</a>
                                        </div>
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button class="btn btn-primary btn-block">Selesaikan Pembelian</button>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
