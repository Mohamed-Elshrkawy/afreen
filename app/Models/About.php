<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class About extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes  = ['welcome','head','text'];
    protected $fillable = ['l_image','s_image','id'];


}
