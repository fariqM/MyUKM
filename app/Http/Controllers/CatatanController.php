<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function show(){
        $pageSlug = "Catatan";
        return view('users.catatan', compact('pageSlug'));
    }
}
