<?php

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Notif;
use App\Models\User;
use Carbon\Carbon;

function waktu($waktu){
    $tanggal = Carbon::parse($waktu)->locale('id');
    return $tanggal->diffForHumans();
}

function successToast($pesan){
    return toast($pesan,'success');
    
}

function failToast($pesan){
    toast($pesan,'error');
}

function notif(){
    $id = auth()->user()->id;
    $allNotif = Notif::get()->where('user_id', '==', $id);

    $data = [
        'notifSuccess' => $allNotif->where('info', '==', 0)->where('tipe', '==', 1),
        'notifFail' => $allNotif->where('info', '==', 0)->where('tipe', '==', 0),
        'notifBaru' => count($allNotif->where('info', '==', 0)),
        'allNotif' => $allNotif
    ];
    return $data;
}