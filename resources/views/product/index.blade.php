<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Products
                </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                      </tr>
                    </thead>
                    <tbody>@php $i=0; @endphp
                        @foreach ($products as $product)
                        <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->specialPrice ? $product->specialPrice->price : $product->price}}</td>
                        <td>
                            <div class="col-md-4 px-0">
                                <img src="{{$product->photo->filename}}" class="img-fluid" style="width: auto; height: 100px;" alt="alt text">
                            </div>
                        </td>
                      </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
