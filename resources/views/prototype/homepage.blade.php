@extends('layouts.guest')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row row-deck row-cards">
                <div class="col-3">
                    <div id="carousel-indicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="0"
                                class=" active"></button>
                            <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="1"
                                class=""></button>
                            <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="2"
                                class=""></button>
                            <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="3"
                                class=""></button>
                            <button type="button" data-bs-target="#carousel-indicators" data-bs-slide-to="4"
                                class=""></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" alt="asd" height="400"
                                    src="{{ asset('dist/img/products/acmilan-removebg-preview.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt="" height="400"
                                    src="{{ asset('dist/img/products/psg-removebg-preview.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt="" height="400"
                                    src="{{ asset('dist/img/products/bayern-removebg-preview.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt="" height="400"
                                    src="{{ asset('dist/img/products/liverpool-removebg-preview.png') }}">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" alt="" height="400"
                                    src="{{ asset('dist/img/products/acmilan2-removebg.png') }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-9">
                    <div class="card card-md">
                        {{-- <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                    </path>
                                    <path d="M10 10l.01 0"></path>
                                    <path d="M14 10l.01 0"></path>
                                    <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                                </svg>
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <h3 class="h1 d-flex justify-content-center text-center">New season 2024-2025</h3>
                            <div class="markdown text-secondary d-flex justify-content-center text-center">
                                <div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula
                                        semper purus, sit amet volutpat </p>

                                </div>
                            </div>
                            <div class="mt-5 d-flex justify-content-center text-center">
                                <a href="https://tabler-icons.io" class="btn btn-primary w-25" target="_blank"
                                    rel="noopener">SHOP NOW</a>
                            </div>
                            <div class="mt-5 d-flex justify-content-center text-center">
                                {{-- @for ($i = 0; $i < 4; $i++) --}}
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Champions League.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Champion League</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Europa League.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Europa League</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Bundesliga.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Bundesliga</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/La Liga.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>La Liga</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Ligue 1.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Ligue 1</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Premier League.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Premier League</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/Serie A.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>Serie A</span>
                                </div>
                                <div class="d-flex flex-column align-items-center m-2">
                                    <img src="{{ asset('dist/img/products/league/World Cup.png') }}" width="50"
                                        class=" m-2" alt="...">
                                    <span>World Cup</span>
                                </div>
                                {{-- @endfor --}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row py-5 mt-5">
                <div class="col-12 text-center">
                    <h1>Favorite Teams</h1>
                    <div class="row mt-4">
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/acmilan.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/barca.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/mancity.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/psg.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/realmadird.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="" class="">
                                <img src="{{ asset('dist/img/products/teams/liverpool.png') }}" alt="">
                            </a>
                        </div>
                    </div>

                    {{-- <a href="" class="">
                        <img src="{{ asset('dist/img/products/teams/barca.png') }}" alt="">
                    </a>
                    <a href="" class="mx-2">
                        <img src="{{ asset('dist/img/products/teams/liverpool.png') }}" alt="">
                    </a>
                    <a href="" class="mx-2">
                        <img src="{{ asset('dist/img/products/teams/realmadird.png') }}" alt="">
                    </a> --}}

                </div>
            </div>

            <div class="row mt-5 row-deck">
                <h2>New Jersey</h2>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <a href="#" class="d-block"><img alt="jersey" height="350"
                                src="{{ asset('dist/img/products/acmilan2-removebg.png') }}" class="card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- <span class="avatar me-3 rounded"
                                    style="background-image: url({{ asset('dist/img/products/acmilan.jpg') }})"></span> --}}
                                <div>
                                    <div>
                                        <a href="" class="text-reset">Ac Milan season 23-34</a>
                                    </div>
                                    <div class="text-secondary">Rp. 230.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <a href="#" class="d-block"><img height="350"
                                src="{{ asset('dist/img/products/acmilan-removebg-preview.png') }}"
                                class="card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- <span class="avatar me-3 rounded"
                                    style="background-image: url({{ asset('dist/img/products/acmilan.jpg') }})"></span> --}}
                                <div>
                                    <div>
                                        <a href="" class="text-reset">Ac Milan season 23-34</a>
                                    </div>
                                    <div class="text-secondary">Rp. 230.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <a href="#" class="d-block"><img height="350"
                                src="{{ asset('dist/img/products/bayern-removebg-preview.png') }}"
                                class="card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- <span class="avatar me-3 rounded"
                                    style="background-image: url({{ asset('dist/img/products/acmilan.jpg') }})"></span> --}}
                                <div>
                                    <div>
                                        <a href="" class="text-reset">Ac Milan season 23-34</a>
                                    </div>
                                    <div class="text-secondary">Rp. 230.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <a href="#" class="d-block"><img height="350"
                                src="{{ asset('dist/img/products/liverpool-removebg-preview.png') }}"
                                class="card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- <span class="avatar me-3 rounded"
                                    style="background-image: url({{ asset('dist/img/products/acmilan.jpg') }})"></span> --}}
                                <div>
                                    <div>
                                        <a href="" class="text-reset">Ac Milan season 23-34</a>
                                    </div>
                                    <div class="text-secondary">Rp. 230.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
