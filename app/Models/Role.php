<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','is_set_price_allowed']; //← the fields name inside the array is mass-assignable

    /********** RelationShips Start **********/

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /********** RelationShips End **********/


    /********** Accessor Start **********/

    /********** Accessor End **********/
}
