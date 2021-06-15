<!-- Shipping Price -->

@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Shipping'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card table-card-body">
      <div class="card-body">
          <form method="post" action="{{ route('seller.shippings.destroy') }}" class="basicform_with_reload">
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
              
              <a href="{{ route('seller.shipping.create') }}" class="btn btn-primary">{{ __('Create Method') }}</a>
             
            </div>
        
          <div class="table-responsive display-desktop-table">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Price') }}</th>
                
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
                  
                  <td>{{ $row->updated_at->diffforHumans()  }}</td>
                  <td>
                    <a href="{{ route('seller.shipping.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
             
           </table>
         </div>

         <ul class="card-tables display-mobile-table">
          @foreach($posts as $row)
            <li class="location-table">
              <div class="custom-control custom-checkbox checkbox-non-custom">
                  <input type="checkbox" name="ids[]" value="{{ $row->id }}">
              </div>
              <div class="title">
                  <div class="name"><b>Name </b>{{ $row->name  }}</div>
                  <div class="price"><b>Price </b>{{ $row->slug  }}</div>
              </div>
              <div class="status-visible">
                <span class="category-edit">
                  <a href="{{ route('seller.shipping.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                </span>
              </div>
              <div class="foot-bottom">
                <div class="primary"><b>Created at </b>{{ $row->updated_at->diffforHumans()  }}</div>
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