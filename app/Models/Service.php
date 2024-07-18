<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes  = ['name', 'description'];
    protected $fillable = ['image','id'];


}
