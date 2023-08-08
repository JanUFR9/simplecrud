@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{ $product->pname}}</div>

                <h5 class="card-header">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                </h5>

                @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
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

                <form method="POST" action="{{ route('product.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="pname" class="col-form-label text-md-right">Product</label>

                            <input id="pname" type="pname" class="form-control @error('pname') is-invalid @enderror" name="pname" value="{{ $product->pname }}" required autocomplete="pname" autofocus>

                            @error('pname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ $product->description }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-form-label text-md-right">Category</label>

                            <input id="category" type="category" class="form-control @error('category') is-invalid @enderror" name="category" value="" required autocomplete="category">
                            <div id="categoryList"></div>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-form-label text-md-right">Amount</label>

                            <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $product->amount }}" required autocomplete="amount">

                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-form-label text-md-right">Price</label>

                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" step=".01">

                            @error('price')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // References to elements
    const categoryInput = $('#category');
    const categoryContainer = $('#category-container');

    // Function to fetch category suggestions via AJAX
    function fetchCategorySuggestions(input) {
        $.ajax({
            url: "{{ route('product.fetch') }}",
            method: 'GET',
            data: { query: input },
            success: function(response) {
                $('#categoryList').fadeIn();  
                    $('#categoryList').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Handle keyup event on the category input field
    categoryInput.on('keyup', function() {
        const input = categoryInput.val();
        fetchCategorySuggestions(input);
    });

    // Function to add selected category as a box
    function addCategoryBox(categoryName) {
        // Create the box element
        const box = $('<div class="category-box">' + categoryName + '<button class="delete-category">x</button></div>');
        
        // Handle delete button click event
        box.find('.delete-category').on('click', function() {
            // Remove the box when the delete button is clicked
            box.remove();
        });
        
        // Append the box to the container
        categoryContainer.append(box);
    }

    // Handle category suggestion selection
    $(document).on('click', '.category-suggestion', function() {
        const categoryName = $(this).text();
        addCategoryBox(categoryName);

        // Clear the input field after adding the category
        categoryInput.val('');
    });
});
</script>
@endsection
