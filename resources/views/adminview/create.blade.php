@extends('nav_scripts.navbar')

@section('content')
    <div class="container mt-3">
        <h1>Product Upload Form</h1>
        <div class="col-6">
            <form class="pb-3" action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="descrpition" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="descrpition">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" name="quantity" class="form-control" id="quantity">
                </div>
                <div class="mb-3">
                    <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                </div>
                <button type="submit" class="btn btn-primary">Upload Product</button>
            </form>
        </div>
    </div>
@endsection
