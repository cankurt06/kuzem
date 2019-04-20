<?php

namespace App\Http\Controllers;

use App\Haberler;
use Illuminate\Http\Request;

class HaberController extends Controller
{
    public function haberler($slug=null)
    {
        if ($slug)
        {
            $haber=Haberler::with('haber_yazari')->where('slug',$slug)->first();
            return view('haber',compact('haber'));
        }
        $haberler=Haberler::with('haber_yazari')->paginate(3,['*'], 'sayfa');
        return view('haberler',compact('haberler'));
    }
}
