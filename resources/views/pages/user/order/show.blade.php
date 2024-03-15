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
                                Invoice
                            </h2>
                            {{-- <div class="text-secondary mt-1">Liverpool season 20254/2023</div> --}}
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

                    <div class="row g-5">
                        <div class="col-lg-7">
                            <div class="card card-lg">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="fw-bold">Nama Penerima</div>
                                            <div class="mb-3">{{ $order->address?->recipient_name }}</div>
                                            <div class="fw-bold">Alamat Pengiriman</div>
                                            <div class="mb-3 text-truncate">
                                                {{ $order->address?->street_address }}
                                                <br>
                                                ({{ $order->address?->notes }})
                                            </div>
                                            <div class="fw-bold">Nomor Telepon</div>
                                            <div class="">{{ $order->address?->phone_number }}</div>
                                        </div>

                                    </div>
                                    <div class="h3">
                                        Order Details
                                    </div>
                                    <table class="table table-transparent table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 1%"></th>
                                                <th>Product</th>
                                                <th class="text-center" style="width: 1%">Qnt</th>
                                                <th class="text-end" style="width: 1%">Unit</th>
                                                <th class="text-end" style="width: 1%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderDetails as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <p class="strong mb-1">
                                                            <a target="blank" class="text-reset"
                                                                href="{{ route('guest.products.show', $item->product->id) }}">
                                                                {{ $item->product->name }}
                                                            </a>

                                                        </p>
                                                        <div class="text-secondary">
                                                            {{ $item->stock->size }} {{ $item->product->type }}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        Rp.
                                                        {{ number_format($item->price) }}
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        Rp. {{ number_format($item->total) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="4" class="strong text-end text-nowrap">Subtotal</td>
                                                <td class="text-end">Rp. {{ number_format($item->order->total) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="strong text-end text-nowrap">Pajak</td>
                                                <td class="text-end">0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="font-weight-bold text-uppercase text-end">
                                                    Grand Total</td>
                                                <td class="font-weight-bold text-end text-nowrap">Rp.
                                                    {{ number_format($item->order->total) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="text-secondary text-center mt-5">Thank you very much for doing business
                                        with us. We look forward to working with
                                        you again!</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card sticky-top">
                                <div class="card-body bg-transparent">
                                    <div class="d-flex justify-content-between  mb-1">
                                        <div>Order ID</div>
                                        <div>{{ $order->no_order }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between   mb-1">
                                        <div>Status Payment</div>
                                        <div>
                                            @if ($order->status_payment == 'PAID')
                                                <span class="badge bg-green text-green-fg">
                                                    {{ $order->status_payment }}
                                                </span>
                                            @endif
                                            @if ($order->status_payment == 'PENDING')
                                                <span class="badge bg-purple text-purple-fg">
                                                    {{ $order->status_payment }}
                                                </span>
                                            @endif
                                            @if ($order->status_payment == 'EXPIRED')
                                                <span class="badge bg-orange text-orange-fg">
                                                    {{ $order->status_payment }}
                                                </span>
                                            @endif


                                        </div>
                                    </div>
                                    @if ($order->status_payment == 'PAID')
                                        <div class="d-flex justify-content-between mb-1">
                                            <div>Payment Method</div>
                                            <div>{{ $order->payment_method }}</div>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom  mb-1 pb-3">
                                            <div>Payment Date</div>
                                            <div>{{ \Carbon\Carbon::parse($order->payment_date)->format('d F Y H:i') }}
                                            </div>
                                        </div>
                                    @endif
                                    @if ($order->status_payment == 'PENDING')
                                        {{-- <div class="d-flex justify-content-between   mb-1">
                                            <div>Pay Before</div>
                                            <div>{{ $expiry_date }}</div>
                                        </div> --}}
                                    @else
                                        {{-- <div class="d-flex justify-content-between   mb-1">
                                            <div>Payment Time</div>
                                            <div>2022-08-25 08:30</div>
                                        </div> --}}
                                        {{-- <div class="d-flex justify-content-between border-bottom  mb-1 pb-3">
                                            <div>Payment Method</div>
                                            <div>{{ $order->payment_method }}</div>
                                        </div> --}}
                                    @endif

                                    <div class="d-flex justify-content-between fw-bold fs-3 mt-3">
                                        <div>Grand Total</div>
                                        <div>Rp. {{ number_format($order->total) }}</div>
                                    </div>
                                    {{-- <div class="mt-4">
                                        <div>Dengan melanjutkan, Anda Menyetujui</div>
                                        <div>
                                            <a href="">Syarat dan Ketentuan Umum</a>
                                        </div>
                                    </div> --}}
                                    @if ($order->status_payment == 'PENDING')
                                        <div class="d-grid mt-4">
                                            <a href="{{ $order->checkout_url }}" class="btn btn-primary btn-block">Bayar
                                                Sekarang</a>
                                        </div>
                                        {{-- <form action="" method="post">
                                        @csrf
                                    </form> --}}
                                        <div class="d-grid mt-3">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger"
                                                class="btn btn-secondary btn-block">Cancel Order</a>
                                        </div>
                                    @else
                                    @endif

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-secondary">Do you really want to cancel this order?</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>
                                <div class="col">
                                    <a href="{{ route('user.orders.cancel', $order) }}" class="btn btn-danger w-100">
                                        Yes, Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
