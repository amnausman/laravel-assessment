@extends('nav_scripts.navbar')

@section('content')
    <div class="container mt-3">
        <h1>Product Edit Form</h1>
        <div class="col-6">
            <form class="pb-3" action="{{ route('updateProduct', $product->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="edititle" class="form-label">Title</label>
                    <input type="text" value="{{ $product->title }}" name="title" class="form-control" id="editTitle">
                </div>
                <div class="mb-3">
                    <label for="editDescrpition" class="form-label">Description</label>
                    <input type="text" value="{{ $product->description }}" name="description" class="form-control" id="editDescrpition">
                </div>
                <div class="mb-3">
                    <label for="editPrice" class="form-label">Price</label>
                    <input type="text" value="{{ $product->price }}" name="price" class="form-control" id="editPrice">
                </div>
                <div class="mb-3">
                    <label for="editQuantity" class="form-label">Quantity</label>
                    <input type="text" value="{{ $product->quantity }}" name="quantity" class="form-control" id="editQuantity">
                </div>
                <div class="mb-3">
                    <img src="{{ asset('public/images/product/'. $product->image )}}" alt="img" width="50">
                    <input class="form-control form-control-sm" name="image" type="file" id="editImage" value="{{ asset('public/images/product/'. $product->image )}}" name="image">
                    
                </div>
                <button type="submit" class="btn btn-primary">Upload Product</button>
            </form>
        </div>
    </div>
@endsection
