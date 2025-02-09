@extends('layout-landing2.body')
@section('content')
    {{-- <script>
        var qty = document.getelementbyid("quantity");
    </script>  --}}

    <section class="h-100">
        <div class="container py-5">
            <a href="{{ route('store.index') }}" class="btn">
                <i class="fas fa-arrow-left"></i> Store
            </a>
            <div class="row d-flex justify-content-center my-4">

                @if ($cart->isEmpty())
                    <div class="col-12">
                    @else
                        <div class="col-md-8">
                @endif


                <div class="card mb-4">
                    <div class="card-header py-3" style="background-color: #406cab">
                        <h5 class="mb-0 text-white" style="font-family: Poppins">Cart</h5>
                    </div>

                    @if ($cart->isEmpty())
                        <h2 class="p-3 text-center fw-bold">Belum ada barang</h2>
                    @endif

                    <div class="card-body">
                        @foreach ($cart as $c)
                            <!-- Single item -->
                            <div class="row my-3">
                                <div class="col-lg-3 col-md-12 col-4 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                        data-mdb-ripple-color="light">
                                        <img src="{{ asset('produk/' . $c->produk->foto) }}" class="w-100"
                                            alt="Blue Jeans Jacket" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 col-8 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p class="text-capitalize text-start"><strong>{{ $c->produk->nama_produk }}</strong></p>
                                    <form action="{{ route('cart.destroy', $c->produk_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger me-2" data-mdb-toggle="tooltip"
                                            title="Remove item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <!-- Data -->

                                    <!-- Quantity -->
                                    <div class="d-flex mb-4 my-lg-5 my-3" style="max-width: 150px">
                                        <button class="btn btn-outline-primary me-2" onclick="decreaseQuantity(this);">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <div class="form-outline">
                                            <input id="quantity_{{ $c->id }}" min="1" name="quantity"
                                                value="{{ $c->quantity }}" type="number" class="form-control"
                                                onchange="updateQuantity(this)" readonly />
                                        </div>

                                        <button class="btn btn-outline-primary ms-2" id="plus"
                                            onclick="increaseQuantity(this)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- Quantity -->
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">

                                    <!-- Price -->
                                    <p class="text-end text-lg-end">
                                        <strong>Rp. {{ number_format($c->produk->harga, 0, ',', '.') }} </strong>
                                    </p>
                                    <!-- Price -->
                                </div>
                            </div>
                            <!-- Single item -->
                            <hr>
                        @endforeach
                        {{-- @foreach ($cart as $c)
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-6 mb-4 mb-lg-0">
                                    <p class="text-capitalize"><strong>{{ $c->produk->nama_produk }}</strong></p>
                                </div>

                                <div class="col-lg-4 col-md-6 col-8 mb-4 mb-lg-0">
                                    <div class="d-flex mb-4" style="max-width: 300px">
                                        <form action="{{ route('cart.destroy', $c->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn text-danger me-2" data-mdb-toggle="tooltip"
                                                title="Remove item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-outline-primary me-2" onclick="decreaseQuantity(this);">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <div class="form-outline">
                                            <input id="quantity_{{ $c->id }}" min="1" name="quantity"
                                                value="{{ $c->quantity }}" type="number" class="form-control"
                                                onchange="updateQuantity(this)" readonly />
                                        </div>

                                        <button class="btn btn-outline-primary ms-2" id="plus"
                                            onclick="increaseQuantity(this)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-end">
                                    <strong>Rp. {{ number_format($c->produk->harga, 0, ',', '.') }} </strong>
                                </p>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            </div>
                            <hr class="my-4" />
                        @endforeach --}}
                    </div>
                </div>
            </div><!-- end cart -->


            <!-- Summary -->
            @if ($cart->isEmpty())
                <div class="col-md-4" style="display: none">
                @else
                    <div class="col-md-4">
            @endif


            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($cart as $c)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center px-0 text-capitalize">
                                {{ $c->produk->nama_produk }}
                                <span id="qty_{{ $c->id }}">{{ $c->quantity }}x</span>
                                <span id="total-price_{{ $c->id }}">Rp.
                                    {{ number_format($c->quantity * $c->produk->harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-end align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong> <span id="total-transaksi-b">Total : Rp.
                                        {{ number_format($totalTransaksi, 0, ',', '.') }}</span></strong>
                                <strong><span id="total-transaksi" style="display: none;">Total : Rp.
                                    </span></strong>
                            </div>
                            <span><strong></strong></span>
                        </li>
                    </ul>
                    <form id="checkout-form" action="{{ route('transaksi.create') }}" method="put">
                        @csrf
                        @method('put')
                        <input type="hidden" name="member_id" value="{{ $member }}">
                        <input type="hidden" name="total" id="total" value="{{ $totalTransaksi }}">
                        @foreach ($cart as $c)
                            <input type="hidden" name="produk_id[]" value="{{ $c->produk->id }}">
                        @endforeach
                        <button type="submit" id="checkout" class="btn btn-success btn-lg btn-block" style="display: ">
                            Go to checkout
                        </button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
        {{-- </form> --}}

    </section>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function updateQuantity(input) {
            var cartId = $(input).attr('id').split('_')[1];
            var newQuantity = $(input).val();

            // Kirim permintaan Ajax untuk memperbarui kuantitas
            $.ajax({
                url: '{{ route('api.cart.update') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: cartId,
                    quantity: newQuantity
                },
                success: function(response) {
                    var formattedPrice = response.item_total_price.toLocaleString('id-ID');
                    formattedPrice = formattedPrice.replace(".", ",");
                    $('#total-price_' + cartId).text("Rp. " + formattedPrice);
                    $('#qty_' + cartId).text(newQuantity + "x");
                }
            });

            // harga total
            $.ajax({
                url: '{{ route('api.transaksi.total') }}',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var totalTransaksi = response.totalTransaksi;
                        var formattedTotal = formatCurrency(totalTransaksi);
                        $('#total').val(totalTransaksi);
                        $('#total-transaksi-b').hide();
                        $('#total-transaksi').text("Total : " + formattedTotal).show();
                    }
                }
            });

        }


        // format currency
        function formatCurrency(number) {
            var formatted = new Intl.NumberFormat('id-ID').format(number);
            // formatted = formatted.replace(".", );
            return "Rp. " + formatted;
        }

        function increaseQuantity(button) {
            var input = $(button).siblings('.form-outline').find('input');
            var quantity = parseInt($(input).val());
            $(input).val(quantity + 1).trigger('change');

            // var qty = document.getElementById("qty");
            // qty.innerHTML = quantity;
        }

        function decreaseQuantity(button) {
            var input = $(button).siblings('.form-outline').find('input');
            var quantity = parseInt($(input).val());
            if (quantity > 1) {
                $(input).val(quantity - 1).trigger('change');

            }
            // var qty = document.getElementById("qty");
            // qty.innerHTML = quantity;

        }
    </script>
@endsection
