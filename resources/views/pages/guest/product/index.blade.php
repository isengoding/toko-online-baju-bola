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
                                Products
                            </h2>
                            {{-- <div class="text-secondary mt-1">About 2,410 result (0.19 seconds)</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row g-4">
                        <div class="col-3">
                            <form action="./" method="get" autocomplete="off" novalidate>

                                <div class="subheader mb-2">Harga</div>
                                <div class="row g-2 align-items-center mb-3">
                                    <div class="col">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                $
                                            </span>
                                            <input type="text" class="form-control" placeholder="from" value="3"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-auto">—</div>
                                    <div class="col">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                $
                                            </span>
                                            <input type="text" class="form-control" placeholder="to" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="subheader mb-2">Tipe</div>
                                <div class="mb-3">
                                    <select name="" class="form-select">
                                        <option>Home</option>
                                        <option>Away</option>

                                    </select>
                                </div>
                                <div class="subheader mb-2">Liga</div>
                                <div class="mb-3">
                                    <select name="" class="form-select">
                                        <option>United Kingdom</option>
                                        <option>USA</option>
                                        <option>Germany</option>
                                        <option>Poland</option>
                                        <option>Other…</option>
                                    </select>
                                </div>
                                <div class="subheader mb-2">Tim</div>
                                <div>
                                    <select name="" class="form-select">
                                        <option>United Kingdom</option>
                                        <option>USA</option>
                                        <option>Germany</option>
                                        <option>Poland</option>
                                        <option>Other…</option>
                                    </select>
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-primary w-100">
                                        Confirm changes
                                    </button>
                                    <a href="#" class="btn btn-link w-100">
                                        Reset to defaults
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="col-9">
                            <div class="row row-cards">
                                @forelse ($products as $row)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card card-sm">
                                            <a href="#" class="d-block"><img height="350"
                                                    src="{{ asset('assets/img/product/' . $row->image) }}"
                                                    class="card-img-top"></a>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    {{-- <span class="avatar me-3 rounded"
                                                style="background-image: url(./static/avatars/000m.jpg)"></span> --}}
                                                    <div>
                                                        <a href="{{ route('guest.products.show', $row->id) }}"
                                                            class="text-reset">
                                                            {{ $row->name }} - {{ $row->type }}
                                                        </a>
                                                        <div class="text-secondary">
                                                            Rp.{{ number_format($row->price) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div>Not Found</div>
                                @endforelse



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
