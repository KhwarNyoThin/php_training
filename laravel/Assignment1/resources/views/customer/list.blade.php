@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/customer-list.css') }}" rel="stylesheet">

<!-- Script -->
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/customer-list.js') }}"></script>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('customer List') }}</div>
        <div class="card-body">
          <div class="row mb-2 search-bar">
            <label class="p-2 search-lbl">Keyword :</label>
            <input class="search-input mb-2 form-control" type="text" id="search-keyword" />
            <button class="btn btn-primary mb-2 search-btn" id="search-click">Search</button>
            <a class="btn btn-primary header-btn" href="/customer/create">{{ __('Create') }}</a>
            <a class="btn btn-primary header-btn" href="/customer/upload">{{ __('Upload') }}</a>
            <a class="btn btn-primary header-btn" href="/customer/download">{{ __('Download') }}</a>
          </div>
          <table class="table table-hover" id="customer-list">
            <thead>
              <tr>
                <th class="header-cell" scope="col">Customer ID</th>
                <th class="header-cell" scope="col">Customer Name</th>
                <th class="header-cell" scope="col">Phone</th>
                <th class="header-cell" scope="col">Address</th>
                <th class="header-cell" scope="col">Email</th>
                <th class="header-cell" scope="col">Created Date</th>
                <th class="header-cell" scope="col">Updated Date</th>
                <th class="header-cell" scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customerList as $customer)
              <tr>
                <td>{{$customer->id}}</td>
                <td>
                  <a class="customer-name" onclick="showcustomerDetail({{json_encode($customer)}})" data-toggle="modal" data-target="#customer-detail-popup">{{$customer->customerName}}</a>
                </td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->email}}</td>
                <td>{{date('Y/m/d', strtotime($customer->created_at))}}</td>
                <td>{{date('Y/m/d', strtotime($customer->updated_at))}}</td>
                <td>
                <a type="button" class="btn btn-primary" href="/customer/edit/{{$customer->id}}">Edit</a>
                  <button type="button" class="btn btn-danger" onclick="showDeleteConfirm({{json_encode($customer)}})" data-toggle="modal" data-target="#delete-confirm">Delete</button>
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
                    <div class="modal-body" id="customer-delete">
                      <h4 class="delete-confirm-header">Are you sure to delete customer?</h4>
                      <div class="col-md-12">
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('CustomerID') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="customer-id"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Customer Name') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="customer-name"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Address') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="customer-address"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Phone') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="customer-phone"></i>
                          </label>
                        </div>
                        <div class="row">
                          <label class="col-md-3 text-md-left">{{ __('Email') }}</label>
                          <label class="col-md-9 text-md-left">
                            <i class="profile-text" id="customer-email"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="post" action="{{ url('customer/list/'.$customer->id)}}"> 
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      <!-- <button onclick="deletecustomerById({{json_encode(csrf_token())}})" type="button" class="btn btn-danger">Delete</button> -->
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
          <div class="modal fade" id="customer-detail-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{ __('customer Detail') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="customer-detail">
                  <div class="row">
                    
                    <div class="col-lg-8 col-md-12 col-sm-6">
                      
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('CustomerID') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-id"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Customer Name') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-name"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Address') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-address"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Phone') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-phone"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Email') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-email"></i>
                        </label>
                      </div>
                      
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Created Date') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-created-at"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Created customer') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-created-customer"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Updated Date') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-updated-at"></i>
                        </label>
                      </div>
                      <div class="row">
                        <label class="col-md-3 text-md-left">{{ __('Updated customer') }}</label>
                        <label class="col-md-9 text-md-left">
                          <i class="profile-text" id="customer-updated-customer"></i>
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