<?php

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Notif;
use App\Models\Proposal;
use App\Models\User;
use Carbon\Carbon;

function waktu($waktu)
{
    $tanggal = Carbon::parse($waktu)->locale('id');
    return $tanggal->diffForHumans();
}

function successToast($pesan)
{
    toast($pesan, 'success')->autoClose(10000)->position('top')->showConfirmButton('Sipp!', '#3085d6');
}

function PropToUKM($id)
{
    $prop = Proposal::find($id);
    $ukm = $prop->user;

    return $ukm->name;
}

function ukmName($id)
{
    $ukm = User::find($id);
    return $ukm->name;
}

function failToast($pesan)
{
    toast($pesan, 'error');
}

function alertconfirm()
{
    alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();
}

function alertsuccess($title, $body)
{
    alert($title, $body, 'success')->autoClose(5000);
}

function notif()
{
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
