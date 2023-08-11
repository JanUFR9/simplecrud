@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add category</div>

                <h5 class="card-header">
                    <a href="{{ route('categories') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
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

                <form method="POST" action="{{ route('Category.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="category_name" class="col-form-label text-md-right">Category</label>

                            <input id="category_name" type="category_name" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('email') }}" required autocomplete="category_name" autofocus>

                            @error('category_name')
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
