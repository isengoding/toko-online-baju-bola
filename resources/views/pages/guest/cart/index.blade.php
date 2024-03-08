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

                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-5">
                        @forelse ($carts as $item)
                            <div class="col-7">
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <img src="{{ asset($item->attributes[0]['img_url']) }}" alt=""
                                                    width="150">
                                                <div class="ms-3">
                                                    <span class="fw-bold">
                                                        <a href="{{ route('guest.products.show', $item->id) }}"
                                                            class="text-reset">{{ $item->name }}</a>
                                                    </span>
                                                    <div class="fw-bold">Rp. {{ number_format($item->price) }}</div>
                                                    <table class="text-secondary mt-3">
                                                        <tr>
                                                            <td>Ukuran</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $item->attributes[0]['size'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tipe</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $item->attributes[0]['type'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ number_format($item->quantity * $item->price) }}</td>
                                                        </tr>
                                                    </table>

                                                    <div class="w-50 mt-5">
                                                        {{-- <select name="quantity" class="form-select">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select> --}}
                                                        <form action="{{ route('guest.cart.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $item->id }}" name="id">
                                                            <input type="number" min="1" class="form-control"
                                                                name="quantity" value="{{ $item->quantity }}">
                                                            <button type="submit" class="btn btn-primary mt-3 d-none">
                                                                Update
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('guest.cart.destroy', $item->id) }}"
                                                    class="text-danger text-decoration-none text-secondary">
                                                    <i class="ti ti-trash icon"></i>

                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
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

                                        <div class="d-flex justify-content-between fw-bold mt-3">
                                            <div>Total</div>
                                            <div>Rp. {{ number_format(Cart::session(100)->getTotal()) }}</div>
                                        </div>
                                        <div class="d-grid mt-4">
                                            <a href="{{ route('user.checkout.index') }}"
                                                class="btn btn-primary btn-block">Checkout</a>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <a href="{{ route('guest.products.index') }}"
                                                class="btn btn-secondary btn-block">Lanjut Belanja</a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        @empty

                            <div class="container-tight py-4">
                                <div class="empty">
                                    <div class="empty-header"><img
                                            src="./dist/static/illustrations/undraw_empty_cart_co35.svg" height="200"
                                            class="d-block mx-auto" alt=""></div>
                                    <p class="empty-title">Oops… Your cart still empty.</p>
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
                        @endforelse


                    </div>
                </div>
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
