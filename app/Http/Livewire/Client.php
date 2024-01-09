<?php

namespace App\Http\Livewire;

use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Client extends Component
{

    public $products;
    public $price;
    public $clientProduct;
    public $userId;
    

    public function render()
    {
        $users = User::with('clientHasOffer')->get();

        $users = $users->reject(function ($users) {
            return $users->isAdmin();
        });

        return view('livewire.client', ['users' => $users]);
    }


    public function getProducts($user)
    {
        $user = json_decode($user);
        $products_ids = [];

        if ($user->client_has_offer) {
            foreach ($user->client_has_offer as $item) {
                $products_ids[] = $item->product_id;
            }
        }        

        $this->userId = $user->id;
        $this->products = Product::whereNotIn('id', $products_ids)->get()->toArray();

        
    }

    public function assignProduct()
    {
        ClientProduct::create([
            'user_id' => $this->userId,
            'product_id' => $this->clientProduct,
            'special_price' => $this->price 
        ]);

        $this->emit('priceWasAssigned','Price Was Assigned Successfully
        ');
    }

    public function destroy($user){
        User::where('id',$user['id'])->delete();
        $this->emit('userHasDeleted','Client Was Deleted Successfully');
    }
}
