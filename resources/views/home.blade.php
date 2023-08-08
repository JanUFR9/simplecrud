@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-secondary"><b>{{ __('Table') }}</b></div>

                <h5 class="card-header bg-secondary">
                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-success btn-outline-light">Add Product</a>


                </h5>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover table-striped table-borderless table-responsive">
                        <thead>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>

                            @forelse ($products as $product)

                            <tr>
                                <td>{{ $product->pname}}</td>
                                <td>{{ $product->description}}</td>
                                <td>
                                    <ul>
                                        @foreach ($product->categories as $category)
                                        <li>{{ $category->category_name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $product->amount}}</td>
                                <td>{{ $product->price}}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No Items!</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
