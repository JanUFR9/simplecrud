@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header text-white bg-secondary"><b>{{ __('CategoryList') }}</b></div>

                    <h5 class="card-header bg-secondary">
                    <a href="{{ route('Category.create') }}" class="btn btn-sm btn-success btn-outline-light">Add Category</a>


                </h5>



                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-striped table-borderless table-responsive">
                        <thead>
                            <th scope="col">Category</th>
                            <th scope="col">Products</th>
                            <th scope="col">ProductsAmount</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>

                            @forelse ($categories as $category)

                            <tr>
                                <td>{{ $category->category_name}}</td>
                                <td>
                                    <ul>
                                        @foreach ($category->products as $product)
                                        <li>{{ $product->pname }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $category->products_count}}</td>
                                <td>
                                    <a href="{{ route('Category.edit', $category->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('Category.show', $category->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
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
