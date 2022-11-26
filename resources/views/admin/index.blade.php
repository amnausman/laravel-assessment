<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="d-flex justify-content-between">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Welcome <strong>{{$admin->name}}</strong>, You're logged in as <strong>Admin!</strong><br>
                        Go thorugh ReadMe file if you have any confusions...!!
                    </div>
                    <div class="d-flex flex-row-reverse p-6 bg-white border-b border-gray-200">
                        <a href="{{route('admin.create')}}" class="btn btn-secondary">Create User</a>
                    </div>
                    <div class="d-flex flex-row-reverse p-6 bg-white border-b border-gray-200">
                        <a href="{{route('product.create')}}" class="btn btn-primary">Create Products</a>
                    </div>
                    <div class="d-flex flex-row-reverse p-6 bg-white border-b border-gray-200">
                        <a href="{{route('client.getClientsList')}}" class="btn btn-success">Set Prices for Clients</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
