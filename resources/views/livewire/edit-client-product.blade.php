<div>
    
    <div class=" my-8 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Offered Products
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Special Prices
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>

                </tr>
        </thead>
            <tbody>
                @foreach ( $client->clientHasOffer as $product)
                <tr class="bg-white border-b  hover:bg-gray-50 ">
                    <td class="px-6 py-4">
                        {{ \App\Models\Product::where('id',$product->product_id)->value('handle') }}
                    </td>

                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                        {{ $product->special_price }}
                    </th>

                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a class="cursor-pointer" >
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" wire:click="destroy({{ $product }})" stroke="currentColor"
                                    class="w-6 h-6 hover:text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                            <a class="cursor-pointer" x-data=""  wire:click="getProduct('{{ $product }}')"   >
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 hover:text-purple-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            
                        </div>

                    </td>

                </tr>

                @endforeach


            </tbody>
        </table>

    </div>

    
    <x-set-client-price-modal :item="$item" />
    
</div>
