@extends('layouts.guest')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none ">
        <div class="container-xl ">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Address
                    </div>
                    <h2 class="page-title">
                        List Addresses
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <a href="{{ route('user.addresses.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add Address
                        </a>
                        <a href="{{ route('user.addresses.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <!-- Alert -->
            <x-alert-error />

            <div class="row">
                <div class="col-12 col-lg-3">
                    <form action="" method="get">
                        <div class="input-icon mb-3">
                            <input type="search" value="{{ request()->query('keyword') }}" class="form-control w-100"
                                name="keyword" placeholder="Search…">
                            <span class="input-icon-addon">
                                <i class="icon ti ti-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">

                        @forelse ($addresses as $row)
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="row align-items-center">

                                        <div class="col text-truncate">

                                            <div class="mb-2 flex align-items-center">
                                                <span class="text-muted fw-bold fs-3">
                                                    {{ $row->label }}
                                                </span>
                                                @if ($row->is_default)
                                                    <span class="badge bg-green text-green-fg ms-2">Default</span>
                                                @endif

                                            </div>
                                            <a href="#" class="text-reset d-block">{{ $row->recipient_name }}</a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                {{ $row->street_address }}, {{ $row->notes }}
                                            </div>
                                            <div class="d-block text-secondary text-truncate">
                                                {{ $row->phone_number }}
                                            </div>
                                            <div class="d-block mt-2">
                                                <a href="{{ route('user.addresses.edit', $row->id) }}">Edit</a>
                                                <a class="text-danger ms-3" href="#"
                                                    onclick="handleDelete(`{{ route('user.addresses.destroy', $row->id) }}`)">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            @if ($row->is_default)
                                                <a href="#" class="list-group-item-actions text-reset text-success ">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M9 12l2 2l4 -4" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="{{ route('user.addresses.setdefault', $row->id) }}"
                                                    class="list-group-item-actions text-reset text-muted"
                                                    title="Change as default">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M9 12l2 2l4 -4" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @empty
                        @endforelse
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
                        <div class="text-secondary">Do you really want to remove this data? What you've done cannot be
                            undone.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>
                                <div class="col"><button type="submit" class="btn btn-danger w-100"
                                        data-bs-dismiss="modal">
                                        Yes, Delete
                                    </button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom_script')
    <script src="{{ asset('dist/libs/fslightbox/index.js') }}" defer></script>
    @if (session()->has('success'))
        <script>
            toastr["success"]("{{ session()->get('success') }}", "Success")
        </script>
    @endif
    <script>
        function handleDelete(route) {
            let form = document.getElementById('deleteForm')
            form.action = route
            console.log(form.action)
            var modalConfirm = new bootstrap.Modal(document.getElementById('modal-danger'));
            modalConfirm.show();
        }
    </script>
@endpush
