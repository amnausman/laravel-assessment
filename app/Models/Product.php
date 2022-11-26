<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','price', 'image']; //← the fields name inside the array is mass-assignable

    //Polymorphic Relationship
    public function photo(){
        return $this->morphOne(Photo::class, 'imageable');
    }

    //A product could be having special prices for many clients, although I haven't used this relation in my code as it was needed
    public function users()
    {
        return $this->belongsToMany(User::class, 'client_product_prices', 'product_id', 'client_id',);
    }

    //This separate relation is for admin used in ProductController's getProducts function
    //To see if any special price is assigned to a client on any product when He selects a client
    public function ifSpecialPrice(){
        return $this->hasOne(ClientProductPrice::class);
    }

    //This relation is for everyone to see their special prices if assigned, else they will see base price
    //Used in ProductController's index function
    public function specialPrice(){
        return $this->hasOne(ClientProductPrice::class, 'product_id')->where('client_id', auth()->user()->id);
    }
}
