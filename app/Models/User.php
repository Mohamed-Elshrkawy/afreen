<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'email_verified_at',
        'phone',
        'Country code',
        'usertype',
    ];

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
       /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }


public function likes()
{
    return $this->hasMany(Like::class);
}

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

public function wallet()
{
    return $this->hasOne(Wallet::class);
}

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
