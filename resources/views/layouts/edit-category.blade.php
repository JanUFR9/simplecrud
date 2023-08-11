@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{ $category->category_name}}</div>

                <h5 class="card-header">
                    <a href="{{ route('categories') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                </h5>

                @if(session()->has('success'))
                        <div class="alert alert-success">
                        {{ session()->get('success') }}
                            <button type="button" class="btn btn-success close" data-dismiss="alert">×</button>
                            
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

                <form method="POST" action="{{ route('Category.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="category_name" class="col-form-label text-md-right">Category</label>

                            <input id="category_name" type="category_name" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ $category->category_name }}" required autocomplete="category_name" autofocus>

                            @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Submit
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
