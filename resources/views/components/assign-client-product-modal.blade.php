<div x-cloak x-data="{isOpen:false}" @custom-assign-product-to-client.window="isOpen=true" x-init="Livewire.on('priceWasAssigned',()=>{
    isOpen=false
})" x-show="isOpen" @keydown.escape.window="isOpen=false" class="relative z-10" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">



            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">

                    <h4 class="text-xl text-gray-600 text-center my-4">Assign Products To Client</h4>

                    @if($products)

                    <div class="">

                        <form wire:submit.prevent='assignProduct' class="w-full max-w-sm">
                            @csrf
                            <div class="md:flex  mb-6">
                                <div class="md:w-1/3">
                                    <label class="form-label" for="sites">
                                        Products
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <select wire:model='clientProduct' class="form-input" required>
                                        <option value="" hidden selected>Choose Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product['id'] }}">{{ $product['handle'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="form-label" for="price">
                                        Assign Price
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input wire:model.defer='price' required class="form-input" min="0" id="price"
                                        type="number" placeholder="100">
                                </div>

                            </div>
                            <div class=" sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-purple-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500 sm:ml-3 sm:w-auto">Submit</button>

                                <button type="button" @click="isOpen=false"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                            </div>
                        </form>
                    </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>