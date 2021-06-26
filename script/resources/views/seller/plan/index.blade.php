<!-- Subscription Plan - work on order history  list to card view-->
@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Plans'])
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            @if (Session::has('fail'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ Session::get('fail') }}
                    </div>
                </div>
            @endif
            {{-- @if (Auth::user()->status == 2 || Auth::user()->status == 3)
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <p>
                                    {{ __('Dear,') }} <b>{{ Auth::user()->name }}</b>.
                                    {{ __(' Thank you for joining ') }} <b>{{ env('APP_NAME') }}</b>.
                                    {{ __('Your account is sent for an approval. Once approved you will be able to setup your store
            and start selling online.') }}
                                    {{ __('To know more about How to configure your shop in Bechocart click on the chat icon and watch the video.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
            @if (Session::has('success'))

                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

        </div>
        @foreach ($posts as $row)
            <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing @if ($row->featured == 1) pricing-highlight @endif">
                    <div class="pricing-title">
                        {{ $row->name }}
                    </div>
                    <div class="pricing-padding">
                        <div class="pricing-price">
                            <div class="main-offered-price">{{ amount_admin_format($row->price) }}</div>
                            <div>
                                @if ($row->days == 365) {{ __('Yearly') }}
                            @elseif($row->days == 30) Monthly @else {{ $row->days }} Days @endif
                        </div>
                        <p>{{ $row->description }}</p>
                    </div>
                    <div class="pricing-details">
                        <div class="pricing-item">

                            <div class="pricing-item-label">{{ __('Products Limit') }} {{ $row->product_limit }}
                            </div>
                        </div>
                        <div class="pricing-item">

                            <div class="pricing-item-label">{{ __('Storage Limit') }}
                                {{ number_format($row->storage) }}MB</div>
                        </div>
                        @if (env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                            <div class="pricing-item">
                                <div class="pricing-item-label">{{ __('Customer Limit') }}
                                    {{ number_format($row->customer_limit) }}</div>
                            </div>
                        @endif
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Shipping Zone Limit') }}
                                {{ number_format($row->location_limit) }}</div>
                        </div>
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Category Limit') }}
                                {{ number_format($row->category_limit) }}</div>
                        </div>
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Brand Limit') }}
                                {{ number_format($row->brand_limit) }}</div>
                        </div>
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Product Variation Limit') }}
                                {{ number_format($row->variation_limit) }}</div>
                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label text-left">{{ __('Use your own domain') }} &nbsp&nbsp
                            </div>
                            @if ($row->custom_domain == 1)
                                <div class="pricing-item-icon "><i class="fas fa-check"></i></div>
                            @else
                                <div class="pricing-item-icon  bg-danger text-white"><i class="fas fa-times"></i></div>
                            @endif
                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label text-left">{{ __('Google Analytics') }} &nbsp&nbsp</div>

                            <div class="pricing-item-icon "><i class="fas fa-check"></i></div>

                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label text-left">{{ __('Facebook Pixel') }} &nbsp&nbsp</div>

                            <div class="pricing-item-icon "><i class="fas fa-check"></i></div>

                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label text-left">{{ __('Google Tag Manager') }} &nbsp&nbsp</div>

                            <div class="pricing-item-icon "><i class="fas fa-check"></i></div>

                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label text-left">{{ __('Whatsapp Plugin') }} &nbsp&nbsp</div>

                            <div class="pricing-item-icon "><i class="fas fa-check"></i></div>

                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Inventory Management') }}</div>
                        </div>

                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Sitemap') }}</div>
                        </div>
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Multi Language') }}</div>
                        </div>
                        <div class="pricing-item">
                            <div class="pricing-item-label">{{ __('Image Optimization') }}</div>
                        </div>

                    </div>
                </div>
                <div class="pricing-cta">
                    @if (url('/') == env('APP_URL'))
                        <a href="{{ route('merchant.make_payment', $row->id) }}">{{ __('Subscribe') }} <i
                                class="fas fa-arrow-right"></i></a>
                    @else
                        <a href="{{ route('seller.make_payment', $row->id) }}">{{ __('Subscribe') }} <i
                                class="fas fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach


</div>

<div class="card table-card-body history-order-table">
    <div class="card-header">
        <h4>{{ __('Order History') }}</h4>
    </div>
    <div class="card-body">
        @php
            $posts = \App\Models\Userplan::with('plan_info', 'payment_method')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(20);
        @endphp

        <div class="table-responsive  display-desktop-table">
            <table class="table table-hover table-nowrap card-table text-center">
                <thead>
                    <tr>


                        <th class="text-left">{{ __('Order') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Purchase Date') }}</th>
                        <th>{{ __('Expiry date') }}</th>

                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Payment Method') }}</th>
                        <th>{{ __('Payment Status') }}</th>
                        <th>{{ __('Fulfillment') }}</th>

                    </tr>
                </thead>
                <tbody class="list font-size-base rowlink" data-link="row">
                    @foreach ($posts as $row)
                        <tr>

                            <td class="text-left">{{ $row->order_no }}</td>
                            <td>{{ $row->plan_info->name ?? '' }}</td>
                            <td>{{ $row->created_at->format('Y-m-d') }}</td>
                            <td>{{ $row->will_expired }}</td>

                            <td>{{ amount_admin_format($row->amount, 2) }}</td>
                            <td>{{ $row->payment_method->method->name ?? '' }}</td>
                            <td>
                                @if (!empty($row->payment_method))
                                    @if ($row->payment_method->status == 1)
                                        <span class="badge badge-success">{{ __('Paid') }}</span>

                                    @elseif($row->payment_method->status==2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Fail') }}</span>
                                    @endif
                                @endif
                            </td>

                            <td>
                                @if ($row->status == 1) <span
                                    class="badge badge-success">Approved</span> @elseif($row->status == 2) <span
                                    class="badge badge-warning">{{ __('Pending') }}</span>@elseif($row->status ==
                                3) <span class="badge badge-danger">{{ __('Expired') }}</span>@else <span
                                        class="badge badge-danger">{{ __('Cancelled') }}</span> @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <ul class="card-tables display-mobile-table">
            @foreach ($posts as $row)
            <li class="order-history-card">
                <div class="title">
                   <div class="order-number"><b>Order : </b>{{ $row->order_no }}</div>
                   <div class="order-number"><b>Name : </b>{{ $row->plan_info->name ?? '' }}</div>
                   <div class="order-number"><b>Total : </b>{{ amount_admin_format($row->amount, 2) }}</div>
                </div>
                <div class="status-visible">
                    <div class="order-number"><b>Payment Method : </b>{{ $row->payment_method->method->name ?? '' }}</div>
                </div>
                <div class="foot-bottom" >
                    <div class="primary"style="margin-left:0;"><b>Purchase date :</b>{{ $row->created_at->format('Y-m-d') }}</div>
                    <div class="secondary"><b>Expiry date :</b>{{ $row->will_expired }}</div>
                </div>
                <div class="bottom-footer">
                    <div class="primary">
                        <b>Payment Status :</b>
                        @if (!empty($row->payment_method))
                                    @if ($row->payment_method->status == 1)
                                        <span class="badge badge-success">{{ __('Paid') }}</span>

                                    @elseif($row->payment_method->status==2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Fail') }}</span>
                                    @endif
                                @endif
                    </div>
                    <div class="secondary">
                        <b>Fulfilment :</b>
                        @if ($row->status == 1) <span
                            class="badge badge-success">Approved</span> @elseif($row->status == 2) <span
                            class="badge badge-warning">{{ __('Pending') }}</span>@elseif($row->status ==
                        3) <span class="badge badge-danger">{{ __('Expired') }}</span>@else <span
                                class="badge badge-danger">{{ __('Cancelled') }}</span> @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-between">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
</div>
@endsection
