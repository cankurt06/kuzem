<?php

namespace App\Http\Controllers;

use App\Bagislar;
use Illuminate\Http\Request;

class BagisController extends Controller
{
    public function bagislar($slug=null)
    {
        if ($slug)
        {
            $bagis=Bagislar::where('slug',$slug)->first();
            return view('bagis',compact('bagis'));
        }
        $bagislar=Bagislar::get();
    }
}
