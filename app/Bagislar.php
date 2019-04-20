<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagislar extends Model
{
    protected $table="bagislar";

    public function get_kategori()
    {
        return $this->hasOne(BagisKategori::class,'id','bagis_turu');
    }
}
