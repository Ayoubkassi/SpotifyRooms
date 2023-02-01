<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spotify extends Model
{
    use HasFactory;

     protected $fillable = [
        'refresh_token','access_token','expires_in','token_type','user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
