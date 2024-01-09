<?php

namespace App\Http\Livewire;

use App\Models\ClientProduct;
use App\Models\User;
use Livewire\Component;

class EditClientProduct extends Component
{
    public $client;
    public $item=[];
    public $price;
    public $showModal=false;

    
    public function mount(User $user){
        $this->client = $user;
    }

    public function getProduct($product){
        $this->showModal=true;
        $this->item=(array)json_decode($product);
        
    }

    public function destroy($product){
            ClientProduct::where(['user_id'=>$product['user_id'],'product_id'=> $product['product_id']])->delete();
            $this->client->refresh();
            $this->emit('discountRemovedSuccessfully','Discount Was Removed Successfully');
            
    }

    public function setPrice($id){
        ClientProduct::where('id',$id)->update([
            'special_price' => $this->price
        ]);

        $this->emit('priceWasUpdated','Price Was Updated Successfully');
    }

    public function render()
    {
        
        return view('livewire.edit-client-product');
    }

    

}
