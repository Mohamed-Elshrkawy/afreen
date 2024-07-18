<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=['id','country','city','address','flat_number','building_number','floor_number','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
