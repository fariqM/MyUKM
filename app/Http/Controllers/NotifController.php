<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function update(){

        $user_id = auth()->user()->id;
        $notif = Notif::where('user_id', $user_id);
        $attr['info'] = 1; 
        $notif->update(array('info' => '1'));
    }
}
