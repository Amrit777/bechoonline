@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Checkout'])
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">{{ __('Cart Items') }}</span>
                        <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                    </h4>
                    <ul class="list-group mb-3">

                        @foreach (Cart::content() as $row)

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $row->name }} <small class="text-muted"> x
                                            {{ $row->qty }}</small></h6>
                                    @foreach ($row->options->attribute ?? [] as $item)
                                        <small class="text-muted">{{ $item->attribute->name ?? '' }} -
                                            {{ $item->variation->name ?? '' }}</small>
                                    @endforeach

                                    @foreach ($row->options->options ?? [] as $item)
                                        <br>
                                        <small class="text-muted">{{ $item->name ?? '' }}</small>
                                    @endforeach

                                </div>
                                <span class="text-muted">{{ number_format($row->price, 2) }}</span>
                            </li>
                        @endforeach

                        {{-- amit singh --}}

                        <li class="list-group-item d-flex justify-content-between">
                            <span>GST({{ tax() }}%)</span>
                            <strong>{{ number_format(Cart::tax(), 2) }}</strong>
                        </li>
                        {{-- amit singh --}}


                        @if (Cart::weight() > 0)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Weight') }}</span>
                                <strong>{{ Cart::weight() }}g</strong>
                            </li>
                        @endif
                        @if (Cart::discount() > 0)
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">{{ __('Discount') }}</h6>

                                </div>
                                <span class="text-success">-{{ number_format(Cart::discount(), 2) }}</span>
                            </li>
                        @endif
                        @if (Cart::weight() > 0)
                            <li class="list-group-item d-flex justify-content-between total_shipping_area none">
                                <span>{{ __('Shipping') }}</span>
                                <strong id="total_shipping_amount"></strong>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('Total') }}</span>
                            <strong id="total_cart_amount">{{ number_format(Cart::total(), 2) }}</strong>
                        </li>
                    </ul>

                    <form class="card p-2 redeemform" method="post" action="{{ route('seller.orders.apply_coupon') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code" required="" name="code">
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn btn-secondary basicbtnredeem">{{ __('Redeem') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">{{ __('Billing address') }}</h4>
                    <form class="needs-validation basicform" method="post"
                        action="{{ route('seller.orders.make_order') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="required">{{ __('Customer Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required="required">
                            <div class="invalid-feedback">
                                {{ __('Please enter customer name.') }}
                            </div>
                        </div>
                        <input type="hidden" name="customer_id" id="customer_id">
                        <div class="mb-3">
                            <label for="email" id="emaillabel">{{ __('Customer Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="customer@example.com">
                            <div class="invalid-feedback">
                                {{ __('Please enter a valid email address for shipping updates.') }}
                            </div>
                        </div>
                        <div class="mb-3 location">
                            <label for="email" id="phonelabel">{{ __('Customer Phone') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+11223344556">
                            <div class="invalid-feedback">
                                {{ __('Please enter a valid phone number') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Customer Type') }}</label>
                            <select class="form-control customer_type" name="customer_type">
                                @if (env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                                    <option value="1">{{ __('Website Customer') }}</option>
                                @endif
                                <option value="0" selected>{{ __('Guest Customer') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Delivery Type') }}</label>
                            <select class="form-control type delivery_type" name="delivery_type">
                                <option value="1">{{ __('Hand Over Delivery') }}</option>
                                <option value="0">{{ __('Walk In Customer') }}</option>
                            </select>
                        </div>


                        <div class="location">
                            <div class="mb-3">
                                <label for="address" class="" id="addresslabel">{{ __('Address') }}</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="1234 Main St">
                                <div class="invalid-feedback">
                                    {{ __('Please enter your shipping address.') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="" id="locationlabel">{{ __('Location') }}</label>
                                    <select class="custom-select d-block w-100" id="location" name="location">
                                        <option value="">{{ __('Choose...') }}</option>
                                        {{ ConfigCategoryMulti('city') }}
                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="zip" class="" id="ziplabel">{{ __('Zip') }}</label>
                                    <input type="text" name="zip_code" class="form-control" id="zip" placeholder="">
                                    <div class="invalid-feedback">
                                        {{ __('Zip code required.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="mb-3 required">{{ __('Payment Status') }}</h4>

                                <div class="d-block my-3">
                                    <div class="custom-control custom-radio">
                                        <input id="credit" name="payment_status" value="1" type="radio"
                                            class="custom-control-input" checked required>
                                        <label class="custom-control-label" for="credit">{{ __('Complete') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input id="debit" name="payment_status" value="2" type="radio"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="debit">{{ __('Pending') }}</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4 class="mb-3 required">{{ __('Payment Method') }}</h4>
                                <div class="d-block my-3">
                                    @foreach ($posts as $key => $item)
                                        @php
                                            $data = json_decode($item->content);
                                        @endphp

                                        <label for="getway{{ $key }}">
                                            <input type="radio" name="payment_method" id="getway{{ $key }}"
                                                value="{{ $item->category_id }}" required>
                                            {{ $data->title }}</label>
                                        <br>

                                    @endforeach

                                </div>
                            </div>
                            <div class="col-sm-4 location none">
                                <h4 class="mb-3" class="" id="shippinglabel">{{ __('Shipping Method') }}</h4>
                                <div class="d-block my-3" id="method_area"></div>
                            </div>
                            <div class="col-sm-12">
                                <label class="" id="payidlabel">{{ __('Payment Id') }}</label>
                                <input type="text" class="form-control" name="payment_id" id="payment_id">
                            </div>
                            <div class="col-sm-12">
                                <label class="">{{ __('Order Note') }}</label>
                                <textarea class="form-control height-100" name="comment"></textarea>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block submit_btn basicbtn"
                            type="submit">{{ __('Make Order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="shipping" value="{{ url('seller/shipping/') }}">
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="TotalAmount" value="{{ Cart::total() }}">
    <input type="hidden" id="weight" value="{{ Cart::weight() }}">
@endsection
@push('js')

    <script>
        var customer_type = "0";
        var delivery_type = "1";
        checkRequired(customer_type, delivery_type);
        $(document).on("change", ".customer_type", function() {
            // 1 - website
            // 0 - guest
            customer_type = $(this).val();
            checkRequired(customer_type, delivery_type);
        });
        $(document).on("change", ".delivery_type", function() {
            // 1 - hand over
            // 0 - walkin
            delivery_type = $(this).val();
            checkRequired(customer_type, delivery_type);
        });

        $('input[name=payment_status]').change(function() {
            var payment_status = $('input[name=payment_status]:checked').val();
            if (payment_status == '1') {
                $("#payment_id").attr("required", "required");
                $('#payidlabel').addClass("required");
            } else {
                $("#payment_id").removeAttr("required");
                $('#payidlabel').removeClass("required");
            }
        });


        function checkRequired(customer_type, delivery_type) {
            if ((customer_type !== '' && customer_type != 'undefined') && (delivery_type != '' && delivery_type !=
                    'undefined')) {
                // wesbite + walkin name, email, cust type, del type, pay status, pay method
                if (customer_type == '1' && delivery_type == '0') {
                    console.log("website + waking")
                    //name
                    $('#email').attr("required", "required");
                    $('#emaillabel').addClass("required");

                    $("#payment_id").removeAttr("required");
                    $('#payidlabel').removeClass("required");
                }

                if (customer_type == '0' && delivery_type == '0') {
                    console.log("guest + waking")

                    console.log("Guest + walkin case");
                    $('#email').removeAttr("required");
                    $('#emaillabel').removeClass("required");
                    var payment_status = $('input[name=payment_status]:checked').val();
                    if (payment_status == '1') {
                        $("#payment_id").attr("required", "required");
                        $('#payidlabel').addClass("required");
                    } else {
                        $("#payment_id").attr("required", "");
                        $('#payidlabel').removeClass("required");
                    }
                }

                if (delivery_type == '1') {
                    console.log("Guest + walkin case + Hand over");

                    // email, phone, zip, location, address is required
                    $('#email').attr("required", "required");
                    $('#emaillabel').addClass("required");

                    $('#phone').attr("required", "required");
                    $('#phonelabel').addClass("required");

                    $('#address').attr("required", "required");
                    $('#addresslabel').addClass("required");

                    $('#address').attr("required", "required");
                    $('#addresslabel').addClass("required");
                    $('#location').attr("required", "required");
                    $('#locationlabel').addClass("required");
                    $('#zip').attr("required", "required");
                    $('#ziplabel').addClass("required");

                    $('.shippingmethod').attr("required", "required");
                    $('#shippinglabel').addClass("required");

                    var payment_status = $('input[name=payment_status]:checked').val();
                    if (payment_status == '1') {
                        $("#payment_id").attr("required", "required");
                        $('#payidlabel').addClass("required");
                    } else {
                        $("#payment_id").attr("required", "");
                        $('#payidlabel').removeClass("required");
                    }
                }
            }
        }
        $(document).on("keydown", function(event) {
            return event.key != "Enter";
        });

    </script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
    <script src="{{ asset('assets/js/checkout.js') }}"></script>
@endpush
