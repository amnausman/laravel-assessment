@extends('nav_scripts.navbar')

@section('content')
    <div class="container mt-3">
        <a href="{{ route('create') }}" class="btn btn-success mb-2">List Product</a>
        <div class="col-11">
            <table class="table bg-light">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Special Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row" class="pID">{{ $product->id }}</th>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ $product->price }}</td>
                            <td class="_js_special_tdata">$ <input type="text" class="special_price"  value="{{ $product->special_price }}">
                                 <a href="javascript:void(0);" class="btn btn-success btn-sm btnS" data-id="{{$product->id }}">Set Price</a></td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <img src="{{ asset('public/images/product/' . $product->image) }}"
                                    alt="{{ $product->image }}" style="width: 70px">
                            </td>
                            <td><a href="{{ url('products/' . $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('product/' . $product->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


