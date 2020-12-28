<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class DashboardController extends Controller
{
    public function layanan1()
    {
        $uid = auth()->user();
        $prop = DB::table('proposals')->select()
            ->leftJoin('reports', 'proposals.id', '=', 'reports.proposal_id')
            ->where('proposals.user_id', '=', $uid->id)
            ->where('proposals.status', '=', 'ACC')->orderBy('reports.spj_name', 'asc')->get();


            if($prop[0]->spj_id==null){
                return view('UKM.403', notif()); 
            } else {
                return view('UKM.dasboardUKM', notif()); 
            }

          
    }

    public function beranda(){
        return view('UKM.beranda', notif());   
    }
    
}
