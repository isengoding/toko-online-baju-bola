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
                        @if ($carts->count() > 0)
                            <div class="col-6">
                                <div class="row mt-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="fw-bold">Nama Penerima</div>
                                        <div class="mb-3">{{ $address->recipient_name }}</div>
                                        <div class="fw-bold">Alamat Pengiriman</div>
                                        <div class="mb-3">
                                            {{ $address->street_address }}

                                        </div>
                                        <div class="fw-bold">Nomor Telepon</div>
                                        <div class="">{{ $address->phone_number }}</div>



                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="{{ route('user.addresses.edit', $address->id) }}" target="_blank"
                                            class="text-decoration-none">
                                            <i class="ti ti-edit icon text-secondary me-2"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="fw-bold">Detail Pesanan</div>
                                @forelse ($carts as $item)
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <img src="{{ asset($item->attributes[0]['img_url']) }}" alt=""
                                                        width="80" height="80">
                                                    <div class="ms-3">
                                                        <span class="">{{ $item->name }}</span>
                                                        <div class="">Rp. {{ number_format($item->price) }}</div>
                                                        <div class="text-secondary fs-5">
                                                            Type : {{ ucfirst($item->attributes[0]['type']) }},
                                                            Size : {{ $item->attributes[0]['size'] }}
                                                        </div>
                                                        <div class="text-secondary fs-5">{{ $item->quantity }} pcs</div>
                                                    </div>
                                                </div>
                                                <div class="text-end fw-bold">
                                                    <div>Rp. {{ number_format($item->quantity * $item->price) }}</div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                @empty
                                @endforelse
                            </div>
                            <div class="col-4">
                                <div class="card sticky-top border-0">
                                    <div class="card-body bg-transparent">
                                        <div class="d-flex justify-content-between text-secondary mb-1">
                                            <div>Jumlah Pesanan</div>
                                            <div>Rp. {{ number_format(Cart::session(100)->getTotal()) }}</div>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom text-secondary pb-3">
                                            <div>Pajak</div>
                                            <div>Rp. 0</div>
                                        </div>

                                        <div class="d-flex justify-content-between fw-bold fs-3 mt-3">
                                            <div>Total</div>
                                            <div>Rp. {{ number_format(Cart::session(100)->getTotal()) }}</div>
                                        </div>
                                        <div class="mt-4">
                                            <div>Dengan melanjutkan, Anda Menyetujui</div>
                                            <div>
                                                <a href="">Syarat dan Ketentuan Umum</a>
                                            </div>
                                        </div>
                                        <form action="{{ route('user.orders.store') }}" method="post">
                                            @csrf
                                            <div class="d-grid mt-4">
                                                <button type="submit" class="btn btn-primary btn-block">Selesaikan
                                                    Pembelian</button>
                                            </div>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        @else
                            <div class="container-tight py-4">
                                <div class="empty">
                                    <div class="empty-header"><img
                                            src="./dist/static/illustrations/undraw_add_to_cart_re_wrdo.svg" height="200"
                                            class="d-block mx-auto" alt=""></div>
                                    <p class="empty-title text-secondary">Add Product to Cart to Checkout</p>
                                    {{-- <p class="empty-subtitle text-secondary">
                                    We are sorry but the page you are looking for was not found
                                </p> --}}
                                    <div class="empty-action">
                                        <a href="{{ route('guest.products.index') }}" class="btn btn-primary">

                                            See All Product
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
