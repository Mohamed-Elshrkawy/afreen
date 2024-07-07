<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_size extends Model
{
    use HasFactory;
    protected $fillable = ['size','product_id'];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
