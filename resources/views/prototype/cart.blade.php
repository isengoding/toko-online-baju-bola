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
                                Keranjang Belanja
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
                        <div class="col-7">
                            @for ($i = 0; $i < 10; $i++)
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <img src="{{ asset('dist/img/products/liverpool-removebg-preview.png') }}"
                                                    alt="" width="150">
                                                <div class="ms-3">
                                                    <span class="fw-bold">Liverpool Season 2024/2025</span>
                                                    <div class="fw-bold">Rp. 100.000</div>
                                                    <table class="text-secondary mt-3">
                                                        <tr>
                                                            <td>Ukuran</td>
                                                            <td class="px-2">:</td>
                                                            <td>S</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tipe</td>
                                                            <td class="px-2">:</td>
                                                            <td>Away</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td class="px-2">:</td>
                                                            <td>Rp. 300.000</td>
                                                        </tr>
                                                    </table>

                                                    <div class="w-50 mt-5">
                                                        <select name="quantity" class="form-select">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="text-danger text-decoration-none text-secondary">
                                                    <i class="ti ti-trash icon"></i>

                                                </a>
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

                                    <div class="d-flex justify-content-between fw-bold mt-3">
                                        <div>Jumlah Pesanan</div>
                                        <div>Rp. 2.000.000</div>
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button class="btn btn-primary btn-block">Lanjutkan Pembayaran</button>
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
