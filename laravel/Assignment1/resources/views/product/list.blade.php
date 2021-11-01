@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/product-list.css') }}" rel="stylesheet">

<!-- Script -->
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/product-list.js') }}"></script>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('product List') }}</div>
        <div class="card-body">
          <div class="row mb-2 search-bar">
            <label class="p-2 search-lbl">Keyword :</label>
            <input class="search-input mb-2 form-control" type="text" id="search-keyword" />
            <button class="btn btn-primary mb-2 search-btn" id="search-click">Search</button>
            <a class="btn btn-primary header-btn" href="/product/create">{{ __('Create') }}</a>
            <a class="btn btn-primary header-btn" href="/product/upload">{{ __('Upload') }}</a>
          </div>
          <table class="table table-hover" id="product-list">
            <thead>
              <tr>
                <th class="header-cell" scope="col">Product ID</th>
                <th class="header-cell" scope="col">Product Name</th>
                <th class="header-cell" scope="col">Price</th>
                <th class="header-cell" scope="col">Created Date</th>
                <th class="header-cell" scope="col">Updated Date</th>
                <th class="header-cell" scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($productList as $product)
              <tr>
                <td>{{$product->id}}</td>
                <td>
                  <a class="product-name" onclick="showproductDetail({{json_encode($product)}})" data-toggle="modal" data-target="#product-detail-popup">{{$product->productName}}</a>
                </td>
                <td>{{$product->price}}</td>
                <td>{{date('Y/m/d', strtotime($product->created_at))}}</td>
                <td>{{date('Y/m/d', strtotime($product->updated_at))}}</td>
                <td>
                  <a type="button" class="btn btn-primary" href="/product/edit/{{$product->id}}">Edit</a>
                  <button type="button" class="btn btn-danger" onclick="showDeleteConfirm({{json_encode($product)}})" data-toggle="modal" data-target="#delete-confirm">Delete</button>
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
                    <div class="modal-body" id="product-delete">
                      <h4 class="delete-confirm-header">Are you sure to delete product?</h4>
                      <div class="col-md-12">
                      <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('productID') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="product-id"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Product Name') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="product-name"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Price') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="product-price"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="post" action="{{ url('product/list/'.$product->id)}}"> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      <!-- <button onclick="deleteproductById({{json_encode(csrf_token())}})" type="button" class="btn btn-danger">Delete</button> -->
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
          <div class="modal fade" id="product-detail-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{ __('product Detail') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="product-detail">
                  <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-6">
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('productID') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="product-id"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Name') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="product-name"></i>
                        </label>
                      </div>
                      
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('price') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="product-price"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Updated Date') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="product-updated-at"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Updated product') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="product-updated-product"></i>
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

          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection