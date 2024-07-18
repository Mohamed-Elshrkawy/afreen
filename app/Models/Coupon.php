<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=['code','start_date','end_date','discount_amount'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
