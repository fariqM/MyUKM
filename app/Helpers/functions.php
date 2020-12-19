<?php

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Notif;
use App\Models\User;
use Carbon\Carbon;

function waktu($waktu){
    $tanggal = Carbon::parse($waktu)->locale('id');
    return $tanggal->diffForHumans();
}