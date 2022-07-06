@extends('layout.home')
@section('content')
    <div class="privacy">
        <div class="container" style="width:90%" >
            <h3 class="tittle-w3l">Giao hàng
                <span class="heading-style">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </h3>
            <div class="row">
                <div class="col-sm-8" id="cart_item">
                    @include('public.cart.cart_ajax')
                </div>
                <div class="col-sm-4">
                    <div class="address_form_agile">
                        <h4>Thêm địa chỉ mua hàng</h4>
                        <form id="pay_by_cash" class="creditly-card-form agileinfo_form">
                            <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div class="information-wrapper">
                                    <div class="first-row">
                                        <div class="controls">
                                            <input class="billing-address-name" type="text" name="name" id="receiver"
                                                placeholder="Tên Người nhận" value="{{ $customer->name }}" required="">
                                        </div>
                                        <div class="w3_agileits_card_number_grids">
                                            <div class="w3_agileits_card_number_grid_left">
                                                <div class="controls">
                                                    <input type="text" placeholder="Số điện thoại" id="phone_format"
                                                        name="number" required="" maxlength="11" minlength="10">
                                                </div>
                                            </div>
                                            <div class="w3_agileits_card_number_grid_right">
                                                <div class="controls">
                                                    <select placeholder="Thành phố" id="delivery" name="delivery" required>
                                                        <option value="" selected>Chọn thành phố</option>
                                                        @foreach ($delivery as $key => $val)
                                                            <option value="{{ $val->city }}">{{ $val->city }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w3_agileits_card_number_grid_right">
                                                <div class="controls">
                                                    <input type="text" placeholder="Địa chỉ" id="location" name="landmark"
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="clear"> </div>
                                        </div>
                                        <div class="controls">
                                            <textarea style="
                                border-style:none;
                                border-bottom: 1px solid #FF5722;
                                -webkit-box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);
                                -moz-box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.31);
                                box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);
                                width:100%;
                            " rows="5" placeholder="Ghi chú" id="note"></textarea>
                                        </div>
                                    </div>
                                    {{-- <button class="submit check_out">Delivery to this Address</button> --}}

                                </div>
                            </div>

                            <div class="checkout-right-basket">
                                <input class="btn btn-primary" type="submit" value="Đặt hàng" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function delete_cart_item(id) {
            var rowid = $(".cart_rowId" + id).val();
            $.ajax({
                url: "{{ url('/cart/delete') }}" + "/" + rowid,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#cart_item").html(data);
                }
            });
        }
    </script>
    <script>
        function cart_minus_item(id) {
            var rowid = $(".cart_rowId" + id).val();
            var number = -1;
            $.ajax({
                url: "{{ url('/cart/update') }}" + "/" + rowid,
                method: "POST",
                data: {
                    number: number
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#cart_item").html(data);
                }
            });
        }
    </script>
    <script>
        function cart_push_item(id) {
            var rowid = $(".cart_rowId" + id).val();
            var number = 1;
            $.ajax({
                url: "{{ url('/cart/update') }}" + "/" + rowid,
                method: "POST",
                data: {
                    number: number
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#cart_item").html(data);
                }
            });
        }
    </script>
    <script>
        $("#phone_format").keyup(function() {
            //Filter only numbers from the input
            let cleaned = ('' + $(this).val()).replace(/\D/g, '');
            $(this).val(cleaned);
            //Check if the input is of correct length
            let match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
            let phone = '' + match[1] + '-' + match[2] + '-' + match[3];
            $(this).val(phone);
        });
    </script>
    <script>
        $("#delivery").change(function() {
            var city=$(this).val();
            $.ajax({
                url:"{{ url('/delivery') }}",
                method:"POST",
                data:{city:city},
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success:function(data){
                    $("#cart_item").html(data);
                }
            });
        });
    </script>
    <script>
        $("#pay_by_cash").submit(function(e) {
            e.preventDefault();
            var item = "{{ Cart::count() }}";
            if (item <= 0) {
                Swal.fire({
                    title: "",
                    text: "Bạn chưa có sản phẩm trong giỏ hàng",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "<a style='color:white' href='{{ url('/') }}'><i class='la la-headphones'></i>Mua ngay</a>",
                    showCancelButton: true,
                    // cancelButtonText: "<i class='la la-thumbs-down'></i> Mua tiếp",
                    customClass: {
                        confirmButton: "btn btn-success",
                        // cancelButton: "btn btn-default"
                    }
                });
            } else {
                var receiver = $("#receiver").val();
                var phone = $("#phone_format").val();
                var city = $("#delivery").val();
                var location = $("#location").val();
                var note = $("#note").val();
                $.ajax({
                    url:"{{ url('/order/store') }}",
                    method:"POST",
                    data:{receiver:receiver,phone:phone,city:city,location:location,note:note},
                    headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success:function(data){
                    Swal.fire({
                    title: "Đặt hàng thành công",
                    text: "Đơn hàng của bạn sẽ được cập nhật sau giây lát",
                    icon: "success",
                });
                    window.location.href="{{ url('/') }}";
                }
                });
            }
        });
    </script>
@endsection
