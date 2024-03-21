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
                        <div class="col-md-6">
                            <img src="{{ asset('assets/img/product/' . $product->image) }}" alt="">
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('guest.cart.store') }}" method="post">
                                @csrf
                                <div class="fs-3">{{ $product->name }}</div>
                                <div class="mb-3 opacity-50">{{ $product->type }} - {{ $product->brand->name }}</div>
                                <div class="fs-1 font-bold mb-3">Rp. {{ number_format($product->price) }}</div>
                                <div class="mb-1">
                                    <label class="form-label">Ukuran</label>
                                    <div class="btn-group" role="group">
                                        @forelse ($product->stocks as $item)
                                            <input type="radio" class="btn-check" name="stock_id"
                                                id="btn-radio-toolbar-{{ $item->id }}" value="{{ $item->id }}"
                                                @if ($item->size_stock == 0) disabled @endif>
                                            <label for="btn-radio-toolbar-{{ $item->id }}"
                                                class="btn btn-icon"><!-- Download SVG icon from http://tabler-icons.io/i/bold -->
                                                {{ $item->size }}
                                            </label>

                                        @empty
                                            <div>Out of Stock</div>
                                        @endforelse

                                        {{-- <input type="radio" class="btn-check" name="btn-radio-toolbar"
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
                                        </label> --}}

                                    </div>

                                    @error('stock_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <a href="" class="fs-5" data-bs-toggle="modal"
                                        data-bs-target="#modal-simple">Panduan Ukuran</a>

                                </div>
                                <div class="d-grid">

                                    <button type="submit" class="btn btn-outline-primary btn-block">Masukkan Ke
                                        Keranjang</button>
                                </div>
                            </form>

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

@push('custom_script')
    @if (session()->has('success'))
        <script>
            toastr["success"]("{{ session()->get('success') }}", "Success")
        </script>
    @endif
@endpush
