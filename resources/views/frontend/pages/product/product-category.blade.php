@extends('frontend.layouts.master')

@section('content')
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                            quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium
                                            eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1"
                                                min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                            cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $categories->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top"
                                    title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <select id="sortBy" class="small right">
                            <option selected>Default Sort</option>
                            <option value="priceAsc" {{ old('sortBy') == 'priceAsc' ? 'selected' : '' }}>Price - Lower To
                                Higher</option>
                            <option value="priceDesc">Price - Higher To Lower</option>
                            <option value="titleAsc">Alphebetical Ascending</option>
                            <option value="titleDesc">Alphebetical Descending</option>
                            <option value="discAsc">Discount - Lower To Higher</option>
                            <option value="disceDesc">Discount - Higher To Lower</option>
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center" id="product-data">

                            @include('frontend.layouts._single-product')
                            <!-- Single Product -->
                        </div>
                    </div>

                    <!-- Shop Pagination Area -->
                    <div class="ajax-load text-center" style="display: none">
                        {{-- <div class="ajax-load text-center"> --}}
                        <img src="{{ asset('frontend/img/loader.gif') }}" alt="" style="width: 6%;">
                    </div>

                    {{-- // u can use this for normal pagination --}}
                    {{-- <div class="shop_pagination_area mt-30">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-left"
                                            aria-hidden="true"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                                <li class="page-item"><a class="page-link" href="#">9</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        $('#sortBy').change(function() {
            var sort = $("#sortBy").val();
            window.location = "{{ url('' . $route . '') }}/{{ $categories->slug }}?sort=" + sort;
        });
    </script>

    <script>
        function loadmoreData(page, emded) {
            $.ajax({
                    url: "?page=" + page,
                    type: "get",
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                })
                .done(function(data, ended) {
                    console.log('html', data);

                    // let myVariable = JSON.parse("{!! json_encode($products) !!}");

                    // old implementation from tutorial ..works in addition to line 217
                    // if (data.html="") {
                    //     console.log('html2', data);

                    //     $(".ajax-load").html("No more product available");
                    //     return;
                    // }

                    $(".ajax-load").hide();
                    $("#product-data").append(data.html);

                })
                .fail(function() {
                    alert("Something went wrong! please try again");
                });
        };

        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 120 >= $(document).height()) {
                // old implementation from tutorial i.e no if checks, the guy just called the next two lines immediately
                // page++;
                // loadmoreData(page, ended);

                // my implementation..works in conjuction with line 200 if (data.html="") {
                myVariable = <?php echo json_encode($products); ?>

                let ended = false;

                if (page <= myVariable.last_page) {
                    console.log("myVariable", page);
                    ended = true
                    page++;
                    loadmoreData(page, ended);
                }
            }
        });
    </script>

    // Add to cart
    <script>
        $(document).on("click", ".add_to_cart", function(e) {
            e.preventDefault();

            var product_id = $(this).data("product-id");
            var product_qty = $(this).data("quantity");


            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $(".add_to_cart" + product_id).html('<i class="fa fa-spinner fa-spin"></i> Loading ...');
                },
                complete: function() {
                    $(".add_to_cart" + product_id).html('<i class="fa fa-cart-plus"></i> Add to cart');
                },
                success: function(data) {
                    console.log(data);
                    // $('body #header-ajax').html(data['header']);
                    if (data["status"]) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        swal({
                            title: "Good job!",
                            text: data["message"],
                            icon: "success",
                            button: "Ok",
                        });
                    } else {

                    }
                }
            });
        });
    </script>

    // Add to wishlist
    <script>
        $(document).on("click", ".add_to_wishlist", function(e) {
            e.preventDefault();
            console.log("wishlist", "wishlist");


            var product_id = $(this).data("id");
            var product_qty = $(this).data("quantity");


            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.store') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $(".add_to_wishlist_" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    $(".add_to_wishlist_" + product_id).html('<i class="fas fa-heart"></i> Add to wishlist');
                },
                success: function(data) {
                    console.log(data);
                    // $('body #header-ajax').html(data['header']);
                    if (data["status"]) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        swal({
                            title: "Good job!",
                            text: data["message"],
                            icon: "success",
                            button: "Ok",
                        });
                    } else if(data["present"]) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        swal({
                            title: "Oops!",
                            text: data["message"],
                            icon: "warning",
                            button: "Ok",
                        });
                    }
                    else {
                        swal({
                            title: "Sorry!",
                            text: "you can't add that product",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                },
                error:function (err) {
                    console.error();
                }
            });
        });
    </script>
@endsection
