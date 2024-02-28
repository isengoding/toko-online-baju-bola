@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Stock
                    </div>
                    <h2 class="page-title">
                        Edit Stock
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
            <x-alert-success />
            <x-alert-error />

            <div class="row row-deck row-cards">

                <div class="col-12 col-lg-8">
                    <div class="card card-md">
                        <form action="{{ route('stocks.update', $stock) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <a href="{{ route('stocks.index') }}" class="btn btn-icon">
                                    <i class="ti ti-chevrons-left"></i>

                                </a>
                            </div>
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="ti ti-fountain-filled"></i>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">

                                        <div class="mb-3">
                                            <label class="form-label required">Product</label>
                                            <select name="product_id"
                                                class="form-select @error('product_id') is-invalid @enderror"
                                                id="product_id" value="{{ old('product_id', $stock->product_id) }}">
                                                <option value="">Select Brand</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }}" @selected(old('product_id', $item->id) == $item->id)>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('product_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">size</label>
                                            <input type="text" name="size" value="{{ old('size', $stock->size) }}"
                                                class="form-control @error('size') is-invalid @enderror" placeholder="">
                                            @error('size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Qty</label>
                                            <input type="number" name="size_stock"
                                                value="{{ old('size_stock', $stock->size_stock) }}"
                                                class="form-control @error('size_stock') is-invalid @enderror"
                                                placeholder="">
                                            @error('size_stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary w-25 ">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-3 w-25 ">Save</button>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect(document.getElementById('product_id'))
        });
    </script>
@endpush
