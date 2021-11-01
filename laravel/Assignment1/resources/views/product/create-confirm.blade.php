@extends('layouts.app')
@section('content')
<!-- Styles -->
<link href="{{ asset('css/product-create-confirm.css') }}" rel="stylesheet">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create product</div>
        <div class="card-body">
          <form method="post" action="{{ route('product.create.confirm') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="productName" class="col-md-4 col-form-label text-md-right required">{{ __('productName') }}</label>

              <div class="col-md-6">
                <input id="productName" type="text" class="form-control @error('productName') is-invalid @enderror" readonly="readonly" name="productName" value="{{ old('productName') }}" autocomplete="name" autofocus>

                @error('productName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('price') }}</label>

              <div class="col-md-6">
                <textarea id="price" type="text" class="form-control @error('price') is-invalid @enderror" readonly="readonly" name="price" autocomplete="price">{{ old('price') }}</textarea>
                  @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Confirm') }}
                </button>
                <a class="cancel-btn btn btn-secondary" onClick="window.history.back()">{{ __('Cancel') }}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection