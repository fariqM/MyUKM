<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Report;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    public function report(){ 
        $uid = auth()->user();
        
        // $roles = DB::table('proposals')->pluck('name');

        $prop = DB::table('proposals')->select()
            ->leftJoin('reports', 'proposals.id', '=', 'reports.proposal_id')
            ->where('proposals.user_id', '=', $uid->id)
            ->where('proposals.status', '=', 'ACC')->orderBy('reports.spj_name', 'asc')->get();
        // dd($prop[0]->spj_id);  
        return view('UKM.laporan', notif(), [
            'prop' => $prop,
            'uid' => $uid
        ]);  
    }

    public function store($PropID, Request $request){
        
        $asd = decrypt($PropID);
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,pdf,docx,zip',
        ]);

        if($validator->fails()){
            return back()->with('errors', "gagal");
        } else {
            if($request->file('file')){
                $file = $request->file('file');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $request = $file->storeAs("docs/spj", $filename);
                $docs = [
                    'spj_name' => $filename,
                    'spj_type' => $file->getClientOriginalExtension(),
                    'proposal_id' => $asd,
                    $rand = substr(str_shuffle("abc%PQ&UVd&ef%ghi%jk&EF%GH&LM%lm%no%CD&NO%pqr%stI&JKu%vw%RSTx%yzAB&WX%YZ"), 0, 3),
                    'spj_slug' => 'ENCRYPT%' . $file->getClientOriginalExtension() . $rand . time() * 6218016,
                ];
                $data =  auth()->user()->reports()->create($docs);
                Alert::success('Berhasil!!', 'SPJ berhasil terkirim');
                return redirect()->back();
            }
        }
    }

    public function test(){
        return view('UKM.blankpage', notif());  
    }

    public function show_spj($slug){
        try {
            $asd = decrypt($slug);
            $data = Report::where('spj_slug', $asd)->firstOrFail();
            return view('UKM.layouts.viewer_spj', compact('data'),  notif());
        } catch (DecryptException $e) {
            return view('UKM.layouts.404');
        }
    }
}
