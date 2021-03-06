@php
use App\Models\Userplan;
@endphp

@extends('layouts.app')
@section('content')

{{-- if plan is expired for any plans (domain or subdomain) --}}
@if(Auth::user()->status == 3 && (Auth::user()->user_domain->status == 1))
@php
        $plan = Userplan::where('user_id', Auth::user()->id)->where('status', 3)->orderBy('will_expired', 'DESC')->first();
@endphp
@if(!empty($plan))
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <p>

                    Hello {{Auth::user()->name}}, your subscription plan is expired (Plan Name: {{$plan->plan_info->name}}, Expired on: {{$plan->will_expired}}).
                     To continue using Bechocart service <font size="+1"><u><a href="{{ route('merchant.plan') }}">Click here</a></u></font> to renew or upgrade your subscription plan.
                     Please connect to our support chat if any query.
                </p>
            </div>
        </div>
    </div>
</div>

@endif
@endif
@if(!empty(Auth::user()->user_domain) && (Auth::user()->user_domain->custom_domain) == 1)
    @if (Auth::user()->status == 2 || Auth::user()->status == 3)
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            {{ __('Dear,') }} <b>{{ Auth::user()->name }}</b>.
                            {{ __(' Your account is not active due to any one of the following reasons: ') }}:
                        </p>
                        <br>
                        <p>                        1. First Time Registration (If new to Bechocart): We welcome you to Bechocart. Your account is sent for an approval. To approve your account, connect to our chat support to approve your account instantly. Once your account is approved, you will be notified on your registered email ID.

                        </p>
                        <br>
                        <p>                        2. Subscription Plan Expired: Your subscription plan is expired (Previous Plan Name and Expiry date). To continue Bechocart service please renew/ upgrade your subscription plan <a href="{{ route('seller.settings.show', 'plan') }}">Click here</a>.Please connect to our support chat if any query.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    @endif --}}
@endif

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">{{ __('Order Statistics') }} -
                        <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month"
                                id="orders-month">{{ Date('F') }}</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li class="dropdown-title">{{ __('Select Month') }}</li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='January'
                                        ) active @endif"
                                        data-month="January">{{ __('January') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='February'
                                        ) active @endif"
                                        data-month="February">{{ __('February') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='March'
                                        ) active @endif"
                                        data-month="March">{{ __('March') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='April'
                                        ) active @endif"
                                        data-month="April">{{ __('April') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='May' ) active @endif" data-month="May">{{ __('May') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='June' ) active @endif" data-month="June">{{ __('June') }}</a>
                                </li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='July' ) active @endif" data-month="July">{{ __('July') }}</a>
                                </li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='August'
                                        ) active @endif"
                                        data-month="August">{{ __('August') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='September'
                                        ) active @endif"
                                        data-month="September">{{ __('September') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='October'
                                        ) active @endif"
                                        data-month="October">{{ __('October') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='November'
                                        ) active @endif"
                                        data-month="November">{{ __('November') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if (Date('F')=='December'
                                        ) active @endif"
                                        data-month="December">{{ __('December') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-stats-items dashboard-cardination">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="pending_order"></div>
                            <div class="card-stats-item-label">{{ __('Pending') }}</div>
                        </div>

                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="completed_order"></div>
                            <div class="card-stats-item-label">{{ __('Completed') }}</div>
                        </div>

                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="shipping_order"></div>
                            <div class="card-stats-item-label">{{ __('Processing') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Orders') }}</h4>
                    </div>
                    <div class="card-body" id="total_order">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="sales_of_earnings_chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Sales Of Earnings') }} - {{ date('Y') }}</h4>
                    </div>
                    <div class="card-body" id="sales_of_earnings">
                        <img src="{{ asset('uploads/loader.gif') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="total-sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Sales') }} - {{ date('Y') }}</h4>
                    </div>
                    <div class="card-body" id="total_sales">
                        <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-9">

            <div class="row">
                <div class="col-12">

                    <div class="card mt-4">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Earnings performance') }} <img
                                    src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
                            <div class="card-header-action">

                                <select class="form-control" id="perfomace">
                                    <option value="7">{{ __('Last 7 Days') }}</option>
                                    <option value="15">{{ __('Last 15 Days') }}</option>
                                    <option value="30">{{ __('Last 30 Days') }}</option>
                                    <option value="365">{{ __('Last 365 Days') }}</option>
                                </select>

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Total Sales') }}</h6>

                                    <span class="h2 mb-0" id="today_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Orders') }}</h6>

                                    <span class="h2 mb-0" id="today_order"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 card-mobile-full">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Yesterday') }}</h6>

                                    <span class="h2 mb-0" id="yesterday_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 card-mobile-full">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('7 days') }}</h6>

                                    <span class="h2 mb-0" id="last_seven_days_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 card-mobile-full">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('This Month') }}</h6>

                                    <span class="h2 mb-0" id="monthly_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 card-mobile-full">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Last Month') }}</h6>

                                    <span class="h2 mb-0" id="last_month_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-3">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header">

                            <h4 class="card-header-title plan_name"></h4>

                            <span class="badge badge-soft-secondary plan_expire"></span>
                            <img src="{{ asset('uploads/loader.gif') }}" class="plan_load">
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Storage usage') }}</h4>

                            <span class="badge badge-soft-secondary" id="storage_used"><img
                                    src="{{ asset('uploads/loader.gif') }}" class="storrage_used"></span>
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Products') }}</h4>

                            <span class="badge badge-soft-secondary posts_used"><img
                                    src="{{ asset('uploads/loader.gif') }}" class="product_used"></span>
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Pages') }}</h4>

                            <span class="badge badge-soft-secondary pages"> <img src="{{ asset('uploads/loader.gif') }}"
                                    class="product_used"></span>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Products Limit') }} <span><span
                                        class="text-danger posts_created"></span>/<span class="product_capacity">
                                    </span></span></h4>
                        </div>
                        <div class="card-body">

                            <div class="sparkline-pie-product d-inline"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Storage Uses') }} <span><span
                                        class="text-danger storage_used"></span>/<span class="storage_capacity">
                                    </span></span></h4>
                        </div>
                        <div class="card-body">

                            <div class="sparkline-pie-storage d-inline"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Site Analytics') }}</h4>
                    <div class="card-header-action">
                        <select class="form-control" id="days">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="15">{{ __('Last 15 Days') }}</option>
                            <option value="30">{{ __('Last 30 Days') }}</option>
                            <option value="180">{{ __('Last 180 Days') }}</option>
                            <option value="365">{{ __('Last 365 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="google_analytics" height="80"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_visitors"></div>
                            <div class="detail-name">{{ __('Total Vistors') }}</div>
                        </div>
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_page_views"></div>
                            <div class="detail-name">{{ __('Total Page Views') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="new_vistors"></div>
                            <div class="detail-name">{{ __('New Visitor') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="returning_visitor"></div>
                            <div class="detail-name">{{ __('Returning Visitor') }}</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Referral URL') }}</h4>
                        </div>
                        <div class="card-body refs" id="refs">



                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Browser') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" id="browsers"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Most Visit Pages') }}</h4>
                        </div>
                        <div class="card-body tmvp" id="table-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="site_url" value="{{ url('/') }}">
    <input type="hidden" id="dashboard_static" value="{{ route('seller.dashboard.static') }}">
    <input type="hidden" id="dashboard_perfomance" value="{{ url('/seller/dashboard/perfomance') }}">
    <input type="hidden" id="dashboard_order_statics" value="{{ url('/seller/dashboard/order_statics') }}">
    <input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
    <input type="hidden" id="month" value="{{ date('F') }}">
@endsection
@push('js')
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/seller/dashboard.js') }}"></script>
@endpush
