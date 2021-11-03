@extends('layouts.app')
@section('content')
<!-- Styles -->
<link href="{{ asset('css/sale-create.css') }}" rel="stylesheet">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create sale</div>
        <div class="card-body">
          <form method="POST" action="{{ route('create.sale') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group row">
              <label for="customerID" class="col-md-4 col-form-label text-md-right required">{{ __('Customer ID') }}</label>

              <div class="col-md-6">
                <textarea id="customerID" type="text" class="form-control @error('customerID') is-invalid @enderror" name="customerID" autocomplete="customerID">{{ old('customerID') }}</textarea>
                @error('customerID')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="productID" class="col-md-4 col-form-label text-md-right required">{{ __('Product ID') }}</label>

              <div class="col-md-6">
                <input id="productID" type="text" class="form-control @error('productID') is-invalid @enderror" name="productID" 
                value="{{ old('productID') }}" autocomplete="productID" autofocus>

                @error('productID')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="ordered_date" class="col-md-4 col-form-label text-md-right required">{{ __('Ordered Date') }}</label>

              <div class="col-md-6">
                <input id="ordered_date" type="text" class="form-control @error('ordered_date') is-invalid @enderror" name="ordered_date" 
                value="{{ old('ordered_date') }}" autocomplete="ordered_date" autofocus>

                @error('ordered_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Create') }}
                </button>
                <button type="reset" class="btn btn-secondary">
                  {{ __('Clear') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection