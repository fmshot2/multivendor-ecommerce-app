@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive" id="wishlist_list">
                            @include('frontend.layouts._wishlist')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->
@endsection


@section('scripts')
    {{-- Move to cart --}}
    <script>
        $(document).ready(function() {
            $(document).on("click", '.move-to-cart', function(e) {
                e.preventDefault();
                var rowId = $(this).data("id");
                var token = "{{ csrf_token() }}";
                var path = "{{ route('wishlist.move.cart') }}";
                var button = $(this); // Store a reference to the button clicked

                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: token,
                        rowId: rowId
                    },
                    beforeSend: function() {
                        button.html('<i class="fa fa-spinner fa-spin"></i> Moving to cart ...');
                    },
                    success: function(data) {
                        if (data["status"]) {
                            $('#cart_counter').html(data['cart_count']);
                            $('#wishlist_list').html(data['wishlist_list']);
                            $('#header-ajax').html(data['header']);
                            swal({
                                title: "Good job!",
                                text: data["message"],
                                icon: "success",
                                button: "Ok",
                            });
                        } else {
                            swal({
                                title: "Oops",
                                text: data["message"],
                                icon: "Something went wrong",
                                button: "Ok",
                            });
                        }
                    },
                    error: function(err) {
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Ok",
                        });
                    },
                    complete: function() {
                        // I added this myself because the button is failing after the first click
                        button.html(
                        'Add to Cart'); // Reset button text after request is complete
                    }
                });
            });

            $(document).on("click", '.delete_wishlist', function(e) {
                e.preventDefault();
                var rowId = $(this).data("id");
                var token = "{{ csrf_token() }}";
                var path = "{{ route('wishlist.delete') }}";

                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: token,
                        rowId: rowId
                    },
                    success: function(data) {
                        if (data["status"]) {
                            $('#cart_counter').html(data['cart_count']);
                            $('#wishlist_list').html(data['wishlist_list']);
                            $('#header-ajax').html(data['header']);
                            swal({
                                title: "Good job!",
                                text: data["message"],
                                icon: "success",
                                button: "Ok",
                            });
                        } else {
                            swal({
                                title: "Oops",
                                text: data["message"],
                                icon: "Something went wrong",
                                button: "Ok",
                            });
                        }
                    },
                    error: function(err) {
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            });
        });
    </script>


    // Add to wishlist
    <script>
        // $(document).on("click", ".add_to_wishlist", function(e) {
        //     e.preventDefault();


        //     var product_id = $(this).data("id");
        //     var product_qty = $(this).data("quantity");


        //     var token = "{{ csrf_token() }}";
        //     var path = "{{ route('wishlist.store') }}";

        //     $.ajax({
        //         url: path,
        //         type: "POST",
        //         dataType: "JSON",
        //         data: {
        //             product_id: product_id,
        //             product_qty: product_qty,
        //             _token: token,
        //         },
        //         beforeSend: function() {
        //             $(".add_to_wishlist_" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
        //         },
        //         complete: function() {
        //             $(".add_to_wishlist_" + product_id).html(
        //                 '<i class="fas fa-heart"></i> Add to wishlist');
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             // $('body #header-ajax').html(data['header']);
        //             if (data["status"]) {
        //                 $('body #header-ajax').html(data['header']);
        //                 $('body #wishlist_counter').html(data['wishlist_count']);
        //                 swal({
        //                     title: "Good job!",
        //                     text: data["message"],
        //                     icon: "success",
        //                     button: "Ok",
        //                 });
        //             } else if (data["present"]) {
        //                 $('body #header-ajax').html(data['header']);
        //                 $('body #wishlist_counter').html(data['wishlist_count']);
        //                 swal({
        //                     title: "Oops!",
        //                     text: data["message"],
        //                     icon: "warning",
        //                     button: "Ok",
        //                 });
        //             } else {
        //                 swal({
        //                     title: "Sorry!",
        //                     text: "you can't add that product",
        //                     icon: "error",
        //                     button: "Ok",
        //                 });
        //             }
        //         },
        //         error: function(err) {
        //             console.error();
        //         }
        //     });
        // });
    </script>
@endsection
