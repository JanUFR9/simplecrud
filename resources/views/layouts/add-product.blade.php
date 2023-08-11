@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add product</div>

                <h5 class="card-header">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                </h5>

                @if(session()->has('success'))
                        <div class="alert alert-success">
                        {{ session()->get('success') }}
                            <button type="button" class="btn btn-success close" data-bs-dismiss="alert">×</button>
                        </div>
                    @endif

                <div class="card-body">
 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('product.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="pname" class="col-form-label text-md-right">Product</label>

                            <input id="pname" type="pname" class="form-control @error('pname') is-invalid @enderror" name="pname" value="{{ old('email') }}" required autocomplete="pname" autofocus>

                            @error('pname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" autocomplete="description" value="{{ old('description') }}"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-form-label text-md-right">Amount</label>

                            <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('email') }}" required autocomplete="amount">

                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-form-label text-md-right">Price</label>

                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('email') }}" required autocomplete="price" step=".01" >

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="type" name="type" type="submit" value=0 class="btn btn-primary">
                                    Submit
                                </button>
                                <button id="type" name="type" type="submit" value=1 class="btn btn-success">
                                    Submit and return
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
