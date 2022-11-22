<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id','name','phone','email','password','image'
    ]; //← the fields name inside the array is mass-assignable

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        //Polymorphic Relationship
    public function photo(){
        return $this->morphOne(Photo::class, 'imageable');
    }

    //declared scopes for getting Admins List if needed
    public function scopeAdmin($query) {
        return $query->whereRoleId('1');
    }

    //declared scopes for getting Clients when needed
    public function scopeClients($query) {
        return $query->whereRoleId('2');
    }

    //Boolean checks
    public function isAdmin(){
        if($this->role_id === 1){
            return 1;
        }
        return 0;
    }

    public function isClient(){
        if($this->role_id === 2){
            return 1;
        }
        return 0;
    }


    /********** RelationShips Start **********/

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

        //A user could be having special price on many products, although I haven't used this relation in my code as it was needed
    public function products()
    {
        return $this->belongsToMany(Product::class, 'client_product_prices', 'client_id', 'product_id');
    }
    /********** RelationShips End **********/


    /********** Accessor Start **********/

    //Mutator for Hashing Password attribute at time of sign up
    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

        }
    /********** Accessor End **********/
}
