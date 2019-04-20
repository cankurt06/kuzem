<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Haberler extends Model
{
    protected $table="haberler";
    public function haber_yazari()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
