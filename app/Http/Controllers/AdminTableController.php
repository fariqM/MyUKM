<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class AdminTableController extends Controller
{
    public function index(){
        $alldata = Proposal::all();
        $data = Proposal::paginate(5);
        $jumlahdata = $alldata->count();

        $halaman = ceil($jumlahdata/5);
        // dd($halaman);
        // return view('users.tabelPengajuan', compact('data'));

        return view('users.tabelPengajuan', [
            'data' => $alldata,
            'halaman' => $halaman,
        ]);
    }

    public function show($id){

        $data = Proposal::find($id);


        // dd($data);
        return view('users.show', compact('data'));
    }
}
