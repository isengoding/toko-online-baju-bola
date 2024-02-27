@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Product
                    </div>
                    <h2 class="page-title">
                        Edit Product
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    {{-- <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                New view
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Save
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div> --}}
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
                        <form action="{{ route('products.update', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <a href="{{ route('products.index') }}" class="btn btn-icon">
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
                                            <label class="form-label required">Product Name</label>
                                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                                class="form-control @error('name') is-invalid @enderror" placeholder=""
                                                autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">SKU</label>
                                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                                                class="form-control @error('sku') is-invalid @enderror" placeholder="">
                                            @error('sku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Price</label>
                                            <input type="text" name="price" value="{{ old('price', $product->price) }}"
                                                class="form-control @error('price') is-invalid @enderror" placeholder="">
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Brand</label>
                                            <select name="brand_id"
                                                class="form-select @error('brand_id') is-invalid @enderror" id="brand_id"
                                                value="{{ old('brand_id') }}">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}" @selected(old('brand_id', $product->brand_id) == $item->id)>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required">Team</label>
                                            <select name="team_id"
                                                class="form-select @error('team_id') is-invalid @enderror" id="team_id"
                                                value="{{ old('team_id') }}" placeholder="Select Team">
                                                <option value="">Select team</option>
                                                @foreach ($teams as $item)
                                                    <option value="{{ $item->id }}" @selected(old('team_id', $product->team_id) == $item->id)>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('team_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-label">Type</div>
                                            <div>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        value="away" @checked(old('type', $product->type) == 'away')>
                                                    <span class="form-check-label">Away</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        value="home" @checked(old('type', $product->type) == 'home')>
                                                    <span class="form-check-label">Home</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        value="third" @checked(old('type', $product->type) == 'third')>
                                                    <span class="form-check-label">Third</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        value="gk" @checked(old('type', $product->type) == 'gk')>
                                                    <span class="form-check-label">GK</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label ">Image</label>
                                            <input type="file" name="image" value="{{ old('image') }}"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Description
                                            </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                                placeholder="Product Description">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Size guide
                                            </label>
                                            <textarea class="form-control @error('size_guide') is-invalid @enderror" name="size_guide" rows="4"
                                                placeholder="use tiny mce">{{ old('size_guide', $product->size_guide) }}</textarea>
                                            @error('size_guide')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('brands.index') }}" class="btn btn-outline-secondary w-25 ">Cancel</a>
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
            new TomSelect(document.getElementById('brand_id'))
            new TomSelect(document.getElementById('team_id'))
        });
    </script>
@endpush
