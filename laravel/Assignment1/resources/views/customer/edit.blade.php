@extends('layouts.app')

@section('content')
<!-- Styles -->
<link href="{{ asset('css/customer-edit.css') }}" rel="stylesheet">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Customer Edit') }}</div>

        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="customerName" class="col-md-4 col-form-label text-md-right required">{{ __('Customer Name') }}</label>

              <div class="col-md-6">
                <input id="customerName" type="text" class="form-control @error('customerName') is-invalid @enderror" name="customerName" value="{{ $customer->customerName }}" required autocomplete="customerName" autofocus>

                @error('customerName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="address" class="col-md-4 col-form-label text-md-right required">{{ __('Address') }}</label>

              <div class="col-md-6">
                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">{{ $customer->address }}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-md-4 col-form-label text-md-right required">{{ __('Phone') }}</label>

              <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $customer->phone }}" required autocomplete="phone" autofocus>

                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right required">{{ __('Email') }}</label>

              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customer->email }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Edit') }}
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