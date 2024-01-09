@extends('layouts.web')

@section('content')
{{-- using unsplash api to retrieve images of some products --}}

<div class="text-2xl text-center p-4">Products</div>

<div class="grid grid-cols-4 gap-20 p-10">

    @foreach ($products as $product)
    <div class="">
        <div class="flex  justify-between">
           <div class="">
            <h1>{{'handle:'. $product->handle }}</h1>
            <h2>{{'title:'. $product->title }}</h2>
           </div>
           <div class="font-bold">
                <p>{{ $product->price.' $' }}</p>
           </div>
        </div>
        <a href="#"><img alt="avatar" class=" rounded-xl"
                src="https://source.unsplash.com/400x400/?plant&v={{$product->id}}"></a>
        <p>{{ $product->body }}</p>
    </div>
    @endforeach
</div>

@endsection