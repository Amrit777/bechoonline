<!-- Attribute Setting -->

@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Variations'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card table-card-body">
      <div class="card-body">
        <form method="post" action="{{ route('seller.attributes-terms.destroy') }}" class="basicform_with_reload">
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

            <a href="{{ route('seller.attribute-term.show',$id) }}" class="btn btn-primary">{{ __('Create variation') }}</a>

          </div>

          <div class="table-responsive display-desktop-table">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Product Count') }}</th>
                  <th>{{ __('Attribute') }}</th>
                  <th>{{ __('Featured') }}</th>
                  <th>{{ __('Created at') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td><input type="checkbox"  name="ids[]" value="{{ $row->id }}"></td>

                  <td>{{ $row->name }}</td>
                  <td>{{ $row->variations_count }}</td>
                   <td>{{ $row->parent->name ?? '' }}</td>
                  <td>@if($row->featured==1) <span class="badge badge-success">{{ __('Yes') }}</span> @else <span class="badge badge-danger">{{ __('No') }}</span> @endif</td>
                  <td>{{ $row->created_at->diffForHumans() }}</td>
                  <td><a href="{{ route('seller.attribute-term.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a></td>

                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Name') }}</th>
                  <th>{{ __('Product Count') }}</th>
                 <th>{{ __('Attribute') }}</th>
                 <th>{{ __('Featured') }}</th>
                 <th>{{ __('Created at') }}</th>
                 <th>{{ __('Action') }}</th>
               </tfoot>
             </table>
           </div>

           <ul class="card-tables display-mobile-table">
           @foreach($posts as $row)
            <li class="attribute-listing">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox"  name="ids[]" value="{{ $row->id }}">
              </div>
              <div class="title">
                  <h6><b>Name : </b>{{ $row->name }}</h6>
                  <div class="product-listing">
                     <b>Product Count : </b>{{ $row->variations_count }}
                  </div>
                  <div class="product-listing">
                     <b>Attribute : </b>{{ $row->parent->name ?? '' }}
                  </div>
              </div>
              <div class="status-visible attribute-status">
                <div class="features">
                    <b>Featured : </b>
                   @if($row->featured==1) <span class="badge badge-success">{{ __('Yes') }}</span> @else <span class="badge badge-danger">{{ __('No') }}</span> @endif
                 </div>
              </div>

              <div class="foot-bottom">
                <div class="primary"><b>Created at : </b>{{ $row->created_at->diffForHumans() }}</div>
                <div class="secondary category-edit"><a href="{{ route('seller.attribute-term.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a></div>
              </div>
            </li>
            @endforeach
          </ul>

             <span class="text-danger text-center attribute-setting"><span class="text-dark">Note:</span> {{ __('Before Delete Any Item Please Make Sure Product Count Must Be "0" Otherwise Product Will Not Append On Your Site') }} </span>
         </form>
       </div>
     </div>
   </div>
 </div>
 @endsection

 @push('js')
 <script src="{{ asset('assets/js/form.js') }}"></script>
@endpush