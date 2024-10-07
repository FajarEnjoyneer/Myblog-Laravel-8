<?php

namespace App\Http\Controllers;

// class LocalizationController extends Controller
// {

//     public function __invoke($language = 'en')
//     {
//         request()->session()->put('locale', $language);
//         return redirect()->back();
//     }
// }


class LocalizationController extends Controller
{
    
    public function switch($language = 'en')
    {
        request()->session()->put('locale', $language);
        return redirect()->back();
    }
}
