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
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <form action="" method="get">
                                        <div class="input-icon mb-3">
                                            <input type="search" value="{{ request()->query('keyword') }}"
                                                class="form-control w-100" name="keyword" placeholder="Search…">
                                            <span class="input-icon-addon">
                                                <i class="icon ti ti-search"></i>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="text-secondary fw-bold mb-2">Filter</div> --}}
                                <div class="accordion" id="accordion-example">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-1"
                                                aria-expanded="false">
                                                Filter
                                            </button>
                                        </h2>
                                        <div id="collapse-1" class="accordion-collapse collapse"
                                            data-bs-parent="#accordion-example" style="">
                                            <div class="accordion-body pt-0">
                                                <form action="" method="get">


                                                    <div class="subheader mb-2">Type</div>
                                                    <div class="mb-3">
                                                        <select name="type" class="form-select">
                                                            <option value="">All</option>
                                                            <option value="home" @selected(request()->query('type') == 'home')>Home
                                                            </option>
                                                            <option value="away" @selected(request()->query('type') == 'away')>Away
                                                            </option>
                                                            <option value="third" @selected(request()->query('type') == 'third')>Third
                                                            </option>
                                                            <option value="gk" @selected(request()->query('type') == 'gk')>GK</option>
                                                        </select>
                                                    </div>
                                                    <div class="subheader mb-2">Brand</div>
                                                    <div class="mb-3">
                                                        <select name="brand_id" class="form-select">
                                                            <option value="">All</option>
                                                            @foreach ($brands as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @selected(request()->query('brand_id') == $item->id)>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="subheader mb-2">Team</div>
                                                    <div>
                                                        <select name="team_id" class="form-select">
                                                            <option value="">All</option>
                                                            @foreach ($teams as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @selected(request()->query('team_id') == $item->id)>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mt-5">
                                                        <button class="btn btn-primary w-100">
                                                            Submit
                                                        </button>
                                                        <a href="{{ route('guest.products.index') }}"
                                                            class="btn btn-link w-100">
                                                            Reset
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="col-md-9">

                            <div class="row row-cards">
                                @forelse ($products as $row)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card card-sm">
                                            <a href="{{ route('guest.products.show', $row->id) }}" class="d-block"><img
                                                    height="350" src="{{ asset('assets/img/product/' . $row->image) }}"
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
                                    <div class="empty">
                                        <div class="empty-header"><img
                                                src="./dist/static/illustrations/undraw_not_found_re_bh2e.svg"
                                                height="200" class="d-block mx-auto" alt=""></div>
                                        <p class="empty-title">Item Not Found.</p>
                                    </div>
                                @endforelse



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
