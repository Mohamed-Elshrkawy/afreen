<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['Transaction','wallet_id','id'];

    public function wallet()
    {
        return $this->belongsTo(wallet::class);
    }


}
