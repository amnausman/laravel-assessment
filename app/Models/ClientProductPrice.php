<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientProductPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['client_id','product_id', 'price']; //← the fields name inside the array is mass-assignable
}
