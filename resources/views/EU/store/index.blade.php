@extends('layout-landing2.body')
@section('title', 'Store')
@section('content')

    <!-- hero section -->
    <div id="store" class="row" data-aos="fade-right" data-aos-duration="1000">
        <div id="thumbnail" class="text-start">
            <img src="{{ asset('illustration/store-illustration.png') }}" class="img-fluid" alt="">
            <div id="caption">
                <h3 class="text-white text-wrap">wawasdwa</h3>
                <p class="text-white text-wrap">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus
                    fugit
                    pariatur, magnam aliquam et qui hic corporis odio neque nobis doloribus quidem delectus saepe commodi
                    illum minima blanditiis nostrum quod.</p>
            </div>
        </div>
    </div>


    <!-- tombol kategori jasa -->
    <div class="container mb-5 mt-3">
        <div class="d-flex flex-row text-center gap-3">
            {{-- <a href="" class="btn yms-outline-blue rounded-5z">All</a>
            @foreach ($layanan as $l)
            <a href="{{ route('store.showtype', $l->layanan) }}" class="btn yms-outline-blue rounded-5">{{ $l->layanan }}</a>
            @endforeach --}}
            <a href="{{ route('store.index') }}" class="text-capitalize my-3 active">All</a>
            @foreach ($layanan as $l)
                <a href="{{ route('store.showtype', $l->layanan) }}"
                    class=" my-3 text-capitalize active">{{ $l->layanan }}</a>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="d-flex row mb-2">
            <p class="h2 fw-bold text-left">
                Paling Diminati
            </p>
        </div>


        <!-- paling diminati -->
        <div class="row rows-cols-lg-5 justify-content-between justify-content-md-center gx-3 my-3">
            @foreach ($populer as $p)
                <div class="col-lg col-md-4 col-6 my-2">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('produk/'.$p->foto) }}" class="card-img-top " alt="..." style="width: 15.3rem; height: 15.3rem">
                        <div class="card-body">
                            <p class="card-title text-capitalize fw-bold">{{ $p->nama_produk }}</p>
                            {{-- <p class="card-title text-secondary">{{ $p->services->judul }}</p> --}}
                            <p class="card-text">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                            @guest
                                <a href="{{ route('authcheck') }}" class="btn yms-blue w-100 rounded-5">
                                    <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                </a>
                            @endguest

                            @auth
                                @if (empty($member))
                                    <div class="row">
                                        <a href="{{ route('user.show', $user) }}" class="btn yms-blue w-100 rounded-5 px-lg-3">
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </a>
                                    </div>
                                @else
                                    @if (auth()->user()->hasIncompleteProfile())
                                        <a type="submit" href="{{ route('user.show', auth()->user()->id) }}"
                                            class="btn yms-blue w-100 rounded-5 px-5" disabled>
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </a>
                                    @elseif ($cart->contains('produk_id', $p->id))
                                        <div class="row rows-cols-2 gx-2 gy-2">
                                            <div class="col-lg-9 col-12">
                                                <!-- Quantity -->
                                                <div class="d-flex gap-0">
                                                    <button class="btn btn-sm yms-blue rounded-5 px-3 me-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>

                                                    <div class="form-outline">
                                                        <input id="form1" min="1" name="quantity" value="1"
                                                            type="number" class="form-control" readonly/>
                                                    </div>

                                                    <button class="btn btn-sm yms-blue rounded-5 px-3 ms-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- Quantity -->
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <a href="" class="btn btn-outline-danger w-100 rounded-5" disabled>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            @foreach ($member as $m)
                                                <input type="hidden" name="member_id" value="{{ $m->id }}">
                                            @endforeach
                                            <input type="hidden" class="form-control" name="quantity" value="1">
                                            <input type="hidden" value="{{ $p->id }}" name="produk_id">
                                            <div class="row px-0 px-lg-3">
                                                <button type="submit" class="btn yms-blue w-100 rounded-5">
                                                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach

        </div>





        {{-- @foreach ($populer as $p)
            <div class="row">
                <div class="my-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="{{ asset('illustration/bmw.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title">{{ $p->nama_produk }}</h4>
                            <p class="card-title text-secondary">{{ $p->services->judul }}</p>
                            <h3 class="card-text">Rp {{ number_format($p->harga, 0, ',', '.') }}</h3>
                            @guest
                                <a href="{{ route('authcheck') }}" class="btn yms-blue">
                                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                </a>
                            @endguest

                            @auth
                                @if (empty($member))
                                    <a href="{{ route('user.show', $user) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                    </a>
                                @else
                                    @if (auth()->user()->hasIncompleteProfile())
                                        <a type="submit" href="{{ route('user.show', auth()->user()->id) }}"
                                            class="btn btn-primary" disabled>
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </a>
                                    @elseif ($cart->contains('produk_id', $p->id))
                                        <button type="submit" class="btn btn-danger" disabled>
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </button>
                                    @else
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            @foreach ($member as $m)
                                                <input type="hidden" name="member_id" value="{{ $m->id }}">
                                            @endforeach
                                            <input type="hidden" class="form-control" name="quantity" value="1">
                                            <input type="hidden" value="{{ $p->id }}" name="produk_id">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach --}}

        <div class="row">
            @foreach ($layanan as $l)
                <p class="h2 fw-bold mt-5">{{ $l->layanan }}</p>
                @foreach ($l->services as $ls)
                    @foreach ($ls->produk as $p)
                        <div class="my-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card card-hover border-0 shadow">
                                <img src="{{ asset('produk/'.$p->foto) }}" class="card-img-top " alt="..." style="width: 19rem; height: 19rem">
                                <div class="card-body">
                                    <p class="card-title text-capitalize fw-bold">{{ $p->nama_produk }}</p>
                                    <p class="card-title text-secondary">{{ $ls->judul }}</p>
                                    <p class="card-text">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                                    @guest
                                        <a href="{{ route('authcheck') }}" class="btn yms-blue w-100 rounded-5 px-0 px-lg-3">
                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                        </a>
                                    @endguest

                                    @auth
                                        @if (empty($member))
                                            <div class="row">
                                                <a href="{{ route('user.show', $user) }}"
                                                    class="btn w-100 rounded-5 px-0 px-lg-3">
                                                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                                </a>
                                            </div>
                                        @else
                                            @if (auth()->user()->hasIncompleteProfile())
                                                <a type="submit" href="{{ route('user.show', auth()->user()->id) }}"
                                                    class="btn yms-blue w-100 rounded-5 px-0 px-lg-3" disabled>
                                                    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                                </a>
                                            @elseif ($cart->contains('produk_id', $p->id))
                                                <div class="row rows-cols-2 gx-2 gy-2 bg-light">
                                                    <div class="col-lg-9 col-12">
                                                        <div class="d-flex gap-0">
                                                            <button class="btn btn-sm yms-blue rounded-5 px-3 me-2"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
        
                                                            <div class="form-outline">
                                                                <input id="form1" min="1" name="quantity" value="1"
                                                                    type="number" class="form-control" readonly/>
                                                            </div>
        
                                                            <button class="btn btn-sm yms-blue rounded-5 px-3 ms-2"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- Quantity -->
                                                    </div>
                                                    <div class="col-lg-3 col-12">
                                                        <a href="" class="btn btn-outline-danger w-100 rounded-5"
                                                            disabled>
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf
                                                    @foreach ($member as $m)
                                                        <input type="hidden" name="member_id" value="{{ $m->id }}">
                                                    @endforeach
                                                    <input type="hidden" class="form-control" name="quantity"
                                                        value="1">
                                                    <input type="hidden" value="{{ $p->id }}" name="produk_id">
                                                    <div class="row px-0 px-lg-3">
                                                        <button type="submit" class="btn yms-blue rounded-5">
                                                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>


    <script>
        window.onload = function() {
            let scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
                sessionStorage.removeItem('scrollPosition');
            }
        };

        window.onbeforeunload = function() {
            sessionStorage.setItem('scrollPosition', window.pageYOffset);
        };
    </script>

@endsection
