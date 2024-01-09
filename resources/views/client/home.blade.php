<x-app-layout>


    @if ($client_products->isEmpty())
    <div class=" flex justify-center items-center h-[33rem]">
        <p class="text-gray-600 text-center">No Offer Yet</p>
    </div>
    
    @else
    <div class="text-center text-xl">Discounts</div>
    <div class="grid grid-cols-3 gap-20 p-10">
        @foreach ($client_products as $item)
        <div class="">
            <div class="flex  justify-between">
                <div class="">
                    <h1>{{'handle:'. $item->product->handle }}</h1>
                    <h2>{{'title:'. $item->product->title }}</h2>
                </div>
                <div class="font-bold">
                    <p>{{ 'price:'.$item->product->price.' $' }}</p>
                    <p>{{ 'after discount:'.$item->special_price.' $' }}</p>
                </div>
            </div>
            <a href="#"><img alt="avatar" class=" rounded-xl"
                    src="https://source.unsplash.com/400x400/?plant&v={{$item->id}}"></a>
            <p>{{ $item->product->body }}</p>
        </div>
        @endforeach

    </div>

    @endif

</x-app-layout>