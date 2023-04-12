<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{

    /**
     * @param
     * @return
     */
    public function update(Request $request)
    {
        Session::put('theme', $request->theme);
        alert('success', 'Your are in '.str_replace('-', ' ', $request->theme));
        return back();
    }

}
