@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('css/product-edit-confirm.css') }}" rel="stylesheet">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Product Edit') }}</div>

        <div class="card-body">
          <form method="product" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="productName" class="col-md-4 col-form-label text-md-right required">{{ __('Product Name') }}</label>

              <div class="col-md-6">
                <input id="productName" type="text" class="form-control @error('productName') is-invalid @enderror" name="productName" value="{{ old('productName') }}" required autocomplete="productName" autofocus readonly="readonly">

                @error('productName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="price" class="col-md-4 col-form-label text-md-right required">{{ __('Price') }}</label>

              <div class="col-md-6">
                <textarea id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" autocomplete="price" readonly="readonly">{{ old('price') }}</textarea>
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
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection