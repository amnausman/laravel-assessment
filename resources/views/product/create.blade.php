<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @if (Session::has('success'))
            <div class="alert alert-success">
                    <strong>{{ Session::get('success') }}</strong>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger">
                    <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
            @csrf

            <!-- Name -->
            <div>
                <x-label for="product_name" :value="__('Product Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="price" :value="__('Product Base Price')" />

                <x-input id="price" class="block mt-1 w-full" type="number" step="any" name="price" :value="old('price')" required />
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Product Image')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Create Product') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
