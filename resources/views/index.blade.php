@extends('nav_scripts.navbar')

@section('content')
    <div class="container">
        <div class="row">

            @foreach ($products as $product)
                <div class="col-3 m-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('public/images/product/' . $product->image) }}" class="card-img-top" alt="..."
                            style="height: 40vh">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>

                            @if (Auth::check())
                            {{-- Condition if special price is not null then show Special Price --}}
                                @if (Auth::user()->role_id == App\Models\User::ROLE_PREMIUM_USER && $product->special_price != null)
                                    <p class="card-text">
                                        <b>
                                            <span class="bg-warning round-circle"
                                                style="
                                            border-radius: 20%;
                                            border-style:solid;
                                            border-width: 1px 1px 1px 1px;
                                            padding:0 2%;
                                            margin:0px;">
                                                Special Price:</span>
                                            ${{ $product->special_price }} <s>${{ $product->price }}</s><br></b>
                                        <em>Premium Users Only</em>
                                    </p>

                                    {{-- Condition if special price is null then show base price --}}
                                @elseif (Auth::user()->role_id == App\Models\User::ROLE_PREMIUM_USER && $product->special_price == null)
                                    <p class="card-text"><b>Price: ${{ $product->price }} </b></p>

                                    {{-- Condition if USER is Normal then show base price --}}
                                @elseif (Auth::user()->role_id == App\Models\User::ROLE_NORMAL_USER)
                                    <p class="card-text"><b>Price: ${{ $product->price }} </b></p>
                                @endif
                                    {{-- If View when no-one is Login--}}
                            @else
                                <p class="card-text"><b>Price: ${{ $product->price }} </b></p>
                            @endif
                            <a href="#" class="btn btn-success">View Product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
