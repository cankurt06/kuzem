<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBagis extends Model
{
     protected $table="user_bagis";

    public function get_bagis_bilgisi()
    {
        return $this->hasOne(Bagislar::class,'id','bagis_id')->with('get_kategori');
    }

    public function get_bagis_yapan()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function get_sertifika()
    {
     //   return $this->hasOne(User::class,'id','user_id');
    }
}
