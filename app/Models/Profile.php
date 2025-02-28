<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable =['image','phone','Country_code','id','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
