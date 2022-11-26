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
                            <th scope="col">Orignal Price</th>
                            <th scope="col">Special Price for customer</th>
                            <th scope="col">Image</th>
                            <th scope="col">Assign Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $product->name }}</td>
                                <td class="text-success">{{ $product->price }}
                                <td class="text-info">{{ $product->ifSpecialPrice ?  $product->ifSpecialPrice->price : 'No Price Assigned' }}
                                </td>
                                <td>
                                    <div class="col-md-4 px-0">
                                        <img src="{{ $product->photo->filename }}" class="img-fluid"
                                            style="width: auto; height: 100px;" alt="alt text">
                                    </div>
                                </td>
                                <td>
                                    <x-input id="special_price{{$i}}" class="block mt-1" type="number" step="any" name="special_price{{$i}}" :value="old('special_price')" required />
                                </td>
                                <td><button class="btn btn-success special_price" id="set_price" onclick="setPriceForClient({{$i}},{{ $product->id }})">Set Prices</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-input id="client_id" type="hidden" name="client_id" value="{{$client->id}}" required autofocus />
            </div>
        </div>
    </div>
</x-app-layout>


<script type="text/javascript">
    function setPriceForClient(row,product_id) {
        if($("input[name='special_price" + row + "']").val() == ''){
            toastr.error('Special Price cannot be empty');
            return;
        }
        Swal.fire({
        title: 'Are you sure?',
        text: "You want to assign special price?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
        }).then((result) => {
        if (result.value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // e.preventDefault();
            var clientId = $("input[name=client_id]").val();
            var productId = product_id;
            var special_price = $("input[name='special_price" + row + "']").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('product.setPriceForClient') }}",
                data: {
                    client_id: clientId,
                    product_id: productId,
                    special_price: special_price
                },
                dataType: 'JSON',
                success: function (response) {
                    if(response.status === 1){
                     toastr.success(response.message);
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.reload();
                        })
                    }
                    else if(response.status === 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        }).then((result) => {
                            window.location.reload();
                        })
                    }
                },
                error: function(jqXHR, ajaxOptions, thrownError) {
                        response = $.parseJSON(jqXHR.responseText);
                        $.each(response, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value, 'Error');
                                });
                            }
                        });
                    }
            });
        }
        else if (!result.value) {
            swal.fire({
                icon: 'error',
                title: 'Cancelled...',
                text: 'Your changes have been cancelled',
            })
            $("input[name='special_price" + row + "']").val('');
        }
    })
}
</script>
