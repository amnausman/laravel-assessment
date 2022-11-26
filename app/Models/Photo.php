<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['filename','imageable_id', 'imageable_type']; //← the fields name inside the array is mass-assignable

    //Polymorphic Relation ship for User and Product
    public function imageable(){
        return $this->morphTo();
    }
}
