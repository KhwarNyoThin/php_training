@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/sale-list.css') }}" rel="stylesheet">

<!-- Script -->
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/sale-list.js') }}"></script>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('sale List') }}</div>
        <div class="card-body">
          <div class="row mb-2 search-bar">
            <label class="p-2 search-lbl">Keyword :</label>
            <input class="search-input mb-2 form-control" type="text" id="search-keyword" />
            <button class="btn btn-primary mb-2 search-btn" id="search-click">Search</button>
            <a class="btn btn-primary header-btn" href="/sale/create">{{ __('Create') }}</a>
            <a class="btn btn-primary header-btn" href="/sale/upload">{{ __('Upload') }}</a>
            <a class="btn btn-primary header-btn" href="/sale/download">{{ __('Download') }}</a>
          </div>
          <table class="table table-hover" id="sale-list">
            <thead>
              <tr>
                <th class="header-cell" scope="col">Sale ID</th>
                <th class="header-cell" scope="col">Customer ID</th>
                <th class="header-cell" scope="col">Product ID</th>
                <th class="header-cell" scope="col">Ordered Date</th>
                <th class="header-cell" scope="col">Created Date</th>
                <th class="header-cell" scope="col">Updated Date</th>
                <th class="header-cell" scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($saleList as $sale)
              
              <tr>
                <td>{{$sale->id}}</td>
                <td>{{$sale->customerID}}</td>
                <td>{{$sale->productID}}</td>
                <td>{{$sale->ordered_date}}</td>
                <td>{{date('Y/m/d', strtotime($sale->created_at))}}</td>
                <td>{{date('Y/m/d', strtotime($sale->updated_at))}}</td>
                <td>
                  <a type="button" class="btn btn-primary" href="/sale/edit/{{$sale->id}}">Edit</a>
                  <button type="button" class="btn btn-danger" onclick="showDeleteConfirm({{json_encode($sale)}})" data-toggle="modal" data-target="#delete-confirm">Delete</button>
                </td>
              </tr>
              <div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Confirm</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="sale-delete">
                      <h4 class="delete-confirm-header">Are you sure to delete sale?</h4>
                      <div class="col-md-12">
                      <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('saleID') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="sale-id"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Customer ID') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="sale-customer-id"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Product ID') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="sale-product-id"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Ordered Date') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="sale-ordered-date"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="post" action="{{ url('sale/list/'.$sale->id)}}"> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      <!-- <button onclick="deletesaleById({{json_encode(csrf_token())}})" type="button" class="btn btn-danger">Delete</button> -->
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
          <div class="modal fade" id="sale-detail-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{ __('Sale Detail') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="sale-detail">
                  <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-6">
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('sale ID') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="sale-id"></i>
                        </label>
                      </div>
                      
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Customer ID') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="customer-id"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Product ID') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="product-id"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Ordered Dc ate') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="ordered-date"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Created Date') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="created-date"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Updated sale') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="sale-updated-sale"></i>
                      </label>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Confirm</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="sale-delete">
                  <h4 class="delete-confirm-header">Are you sure to delete sale?</h4>
                  <div class="col-md-12">
                  <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('saleID') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="sale-id"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Customer ID') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="customer-id"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Product ID') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="product-id"></i>
                      </label>
                    </div>
                    <div class="row">
                      <label class="col-md-3 text-md-left">{{ __('Ordered Date') }}</label>
                      <label class="col-md-9 text-md-left">
                        <i class="profile-text" id="ordered-date"></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button onclick="deletesaleById({{json_encode(csrf_token())}})" type="button" class="btn btn-danger">Delete</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection