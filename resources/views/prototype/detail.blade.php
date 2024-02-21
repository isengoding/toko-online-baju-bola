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
                                Produk Detail
                            </h2>
                            {{-- <div class="text-secondary mt-1">Liverpool season 20254/2023</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="{{ asset('dist/img/products/liverpool-removebg-preview.png') }}" alt="">
                        </div>
                        <div class="col-4">
                            <div class="fs-3">Liverpool Season 2024/2025</div>
                            <div class="mb-3 opacity-50">Away</div>
                            <div class="fs-1 font-bold mb-3">Rp. 100.000</div>
                            <div class="mb-1">
                                <label class="form-label">Ukuran</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="btn-radio-toolbar"
                                        id="btn-radio-toolbar-1" autocomplete="off" checked="">
                                    <label for="btn-radio-toolbar-1"
                                        class="btn btn-icon"><!-- Download SVG icon from http://tabler-icons.io/i/bold -->
                                        S
                                    </label>
                                    <input type="radio" class="btn-check" name="btn-radio-toolbar"
                                        id="btn-radio-toolbar-2" autocomplete="off">
                                    <label for="btn-radio-toolbar-2"
                                        class="btn btn-icon"><!-- Download SVG icon from http://tabler-icons.io/i/italic -->
                                        M
                                    </label>
                                    <input type="radio" class="btn-check" name="btn-radio-toolbar"
                                        id="btn-radio-toolbar-3" autocomplete="off">
                                    <label for="btn-radio-toolbar-3"
                                        class="btn btn-icon"><!-- Download SVG icon from http://tabler-icons.io/i/underline -->
                                        L
                                    </label>
                                    <input type="radio" class="btn-check" name="btn-radio-toolbar"
                                        id="btn-radio-toolbar-4" autocomplete="off">
                                    <label for="btn-radio-toolbar-4"
                                        class="btn btn-icon"><!-- Download SVG icon from http://tabler-icons.io/i/copy -->
                                        XL
                                    </label>

                                </div>
                            </div>
                            <div class="mb-5">
                                <a href="" class="fs-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-simple">Panduan Ukuran</a>

                            </div>
                            <div class="d-grid">
                                <button class="btn btn-outline-primary btn-block">Masukkan Ke Keranjang</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Panduan Ukuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    Ukuran S
                    <br>
                    Lebar Bahu : 48 cm
                    <br>
                    Lingkar Dada : 104 cm
                    <br>
                    Panjang Tangan : 60 cm
                    <br>
                    Lingkar Lengan : 40 cm
                    <br>
                    Lingkar Pinggang : 104 cm
                    <br>
                    Panjang : 64 cm

                    {{-- Ukuran M
                    Lebar Bahu : 50 cm
                    Lingkar Dada : 108 cm
                    Panjang Tangan : 62 cm
                    Lingkar Lengan : 42 cm
                    Lingkar Pinggang : 108 cm
                    Panjang : 67 cm

                    Ukuran L
                    Lebar Bahu : 51 cm
                    Lingkar Dada : 114 cm
                    Panjang Tangan : 62 cm
                    Lingkar Lengan : 44 cm
                    Lingkar Pinggang : 114 cm
                    Panjang : 67 cm

                    Model pakai ukuran : M

                    Tinggi Model : 173 cm --}}

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
