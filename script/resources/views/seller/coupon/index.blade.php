<!-- Coupon -->

@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Coupons'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card table-card-body">
      <div class="card-body">
          <form method="post" action="{{ route('seller.coupons.destroy') }}" class="basicform_with_reload">
            @csrf
            <div class="float-left mb-1 select-category">
              
              <div class="input-group">
                <select class="form-control" name="method">
                  <option value="" >{{ __('Select Action') }}</option>
                  <option value="delete" >{{ __('Delete Permanently') }}</option>

                </select>
                <div class="input-group-append">                                            
                  <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                </div>
              </div>
             
            </div>
              <div class="float-right mb-1 category-creation">
              
              <a href="{{ route('seller.coupon.create') }}" class="btn btn-primary">{{ __('Create Coupon') }}</a>
             
            </div>
        
          <div class="table-responsive display-desktop-table">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Code') }}</th>
                  <th>{{ __('Expired Date') }}</th>
                  <th>{{ __('Percentage') }}</th>
                
                  <th>{{ __('Last Update') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>

                  <td>{{ $row->name  }}</td>
                  <td>{{ $row->slug  }}</td>
                  <td>{{ $row->featured  }}%</td>
                  
                  <td>{{ $row->updated_at->diffforHumans()  }}</td>
                  <td>
                    <a href="{{ route('seller.coupon.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
             
           </table>
         </div>
         <ul class="card-tables display-mobile-table">
           @foreach($posts as $row)
            <li class="coupon-table">
              <div class="custom-control custom-checkbox checkbox-non-custom">
                  <input type="checkbox" name="ids[]" value="{{ $row->id }}">
              </div>
              <div class="table-image">
                  <img src="{{ asset($row->preview->content ?? 'uploads/default.png') }}" height="50">
              </div>

              <div class="title">
                  <h6><b>Code : </b>{{ $row->name  }}</h6>
                  <div class="precentage">
                     <b>Percentage : </b>{{ $row->featured  }}%
                  </div>
              </div>
              <div class="status-visible">
                <span class="category-edit">
                 <a href="{{ route('seller.category.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a></span>
              </div>

              <div class="foot-bottom">
                <div class="primary"><b>Last Update : </b>{{ __('Last Update') }}</div>
                <div class="secondary"><b>Expired Date : </b>{{ __('Expired Date') }}</div>
              </div>
            </li>
            @endforeach
          </ul>
           {{ $posts->links('vendor.pagination.bootstrap-4') }}
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush