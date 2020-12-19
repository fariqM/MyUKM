<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class DashboardController extends Controller
{
    public function layanan1()
    {
        $userid = auth()->user()->id;
        $allNotif = Notif::get()->where('user_id', '==', $userid);
        return view('UKM.dasboardUKM', [
            'notifSuccess' => $allNotif->where('info', '==', 0)->where('tipe', '==', 1),
            'notifFail' => $allNotif->where('info', '==', 0)->where('tipe', '==', 0),
            'notifBaru' => count($allNotif->where('info', '==', 0)),
            'allNotif' => $allNotif
        ]);
        
    }
}
