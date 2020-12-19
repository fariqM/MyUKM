<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentController extends Controller
{
    public function show($slug)
    {
        try {
            $asd = decrypt($slug);
            $data = Proposal::where('slug', $asd)->firstOrFail();
            return view('UKM.layouts.viewer', compact('data'),  notif());
        } catch (DecryptException $e) {
            return view('UKM.layouts.404');
        }
    }

    public function index()
    {
        $id = auth()->user()->id;
        $file = Proposal::get()->where('user_id', '==', $id);
        return view('UKM.dataUKM',  notif(), compact('file'));
    }

    public function docUpdate($slug, Request $request)
    {
        $data = Proposal::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,pdf,docx,zip',
        ]);

        if ($validator->fails()) {
            return back()->with('errors', "gagal");
        } else {
            if ($request->file('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->delete('docs/proposal/' . $data->name);
                $request = $file->storeAs("docs/proposal", $filename);
                $docs = [
                    'name' => $filename,
                    'type' => $file->getClientOriginalExtension()
                ];
                $docs['status'] = null;
                $data->update($docs);
            }
        }
    }

    public function store(Request $request)
    {
        $data = new Proposal();
        $attr = request()->validate([
            'file' => 'required|mimes:doc,pdf,docx,zip',
            'judul' => 'required|min:4',
            'mulai' => 'required|min:4',
            'selesai' => 'required|min:4',
            'tanggal' => 'required|min:4',
            'tempat' => 'required|min:4',
            'PenanggungJawab' => 'required|min:4',
        ]);

        $conv = date_format(date_create($request->tanggal), "Y-m-d");
        $attr['tanggal']=$conv;
        // dd( $attr['tanggal']);
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request = $file->storeAs("docs/proposal", $filename);
        $attr['name'] = $filename;
        $attr['type'] = $file->getClientOriginalExtension();
        $rand = substr(str_shuffle("abcPQ&UVd&efg=hi=jk&EFGH&LM=lm=noCD&NOpq==r=stI&JKu=vwRSTx=yzAB&WXYZ"), 0, 3);
        $attr['slug'] = 'ENC%R' . $file->getClientOriginalExtension() . $rand . time() * 6218016;

        $data = auth()->user()->proposals()->create($attr);
        Alert::success('Berhasil!!', 'Proposal berhasil terkirim');
        return redirect()->back();
    }

    public function update($slug)
    {
        $asd = decrypt($slug);
        $data = Proposal::where('slug', $asd)->firstOrFail();
        $attr = request()->validate([
            'judul' => 'required|min:4',
            'mulai' => 'required|min:4',
            'selesai' => 'required|min:4',
            'tanggal' => 'required|min:4',
            'tempat' => 'required|min:4',
            'PenanggungJawab' => 'required|min:4',
        ]);

        $conv = date_format(date_create(request('tanggal')), "Y-m-d");
        $attr['tanggal']=$conv;
        $attr['status'] = null;
        $data->update($attr);
        // Alert::success('Berhasil!!', 'Proposal berhasil diedit');
        session()->flash('updateProp');
        return redirect()->to('profileUKM/data');
        // toast('Success Toast', 'success')->autoClose(10000)->position('top')->showConfirmButton('Confirm', '#3085d6');
    }

    public function adminUpdate($slug)
    {
        $data = Proposal::where('slug', $slug)->firstOrFail();
        $attr = request()->validate([
            'judul' => 'required|min:4',
            'mulai' => 'required|min:4',
            'selesai' => 'required|min:4',
            'tanggal' => 'required|min:4',
            'tempat' => 'required|min:4',
            'PenanggungJawab' => 'required|min:4',
        ]);
        $conv = date_format(date_create(request('tanggal')), "Y-m-d");
        $attr['tanggal']=$conv;
        $data->update($attr);
        Alert::success('System!!', 'Proposal berhasil diedit');
        return redirect()->to('/adminTable/Pengajuan');
    }

    public function acc($id)
    {
        $notif = new Notif();
        $proposal = Proposal::where('id', $id)->firstOrFail();
        $attr['status'] = "ACC";
        $proposal->update($attr);

        $dist['user_id'] = $proposal->user_id;
        $dist['judul'] = 'Proposal telah diterima dan ter-acc';
        $dist['info'] = '0';
        $dist['pengirim'] = "admin";
        $dist['tipe'] = '1';
        $dist['deskripsi'] = 'Proposal ' . $proposal->judul . ' telah di-acc, silahkan melaksanakan kegiatan.
         Tetap laksanakan PROTOKOL KESEHATAN!, dan jangan lupa lampirkan laporan SPJ setelah kegiatan. Terima Kasih.';
        $notif = Notif::create($dist);

        Alert::success('System!!', 'Proposal ter-acc');
        return redirect()->to('/adminTable/Pengajuan');
    }
    public function tolak($id, Request $request)
    {
        // dd($id);

        // $attr['deskripsi'] = $request->deskripsi;

        $proposal = Proposal::where('id', $id)->firstOrFail();
        $attr['status'] = "Ditolak";
        $proposal->update($attr);

        $dist['user_id'] = $proposal->user_id;
        $dist['judul'] = 'Proposal ' . $proposal->judul . ' ditolak';
        $dist['info'] = '0';
        $dist['tipe'] = '0';
        $dist['pengirim'] = $request->pengirim;
        if ($request->deskripsi == '') {
            $dist['deskripsi'] = 'Proposal ' . $proposal->judul . ' dibatalkan.
            silahkan periksa kembali proposal yang dikirim atau hubungi yang berwenang';
        } else {
            $dist['deskripsi'] = $request->deskripsi;
        }

        $notif = Notif::create($dist);
        session()->flash('tolakProp');
        // Alert::warning('System!!', 'Proposal ditolak');

        // return redirect()->to('/adminTable/Pengajuan');
    }

    public function edit($slug)
    {
        try {
            $dec = decrypt($slug);
            $proposal = Proposal::where('slug', $dec)->firstOrFail();
            return view('UKM.editProposal', compact('proposal'), notif());
        } catch (DecryptException $e) {
            return view('UKM.layouts.404');
        }
    }

    public function editAdmin($slug)
    {
        $proposal = Proposal::where('slug', $slug)->firstOrFail();

        return view('users.adminEditProposal', compact('proposal'));
    }


    public function destroy($slug)
    {
        $teas = decrypt($slug);
        $proposal = Proposal::where('slug', $teas)->firstOrFail();
        Storage::disk('public')->delete('docs/proposal/' . $proposal->name);
        $proposal->delete();
        // Proposal::destroy($proposal->name);
        Alert::success('System!', 'Penghapusan permohonan berhasil');
        return redirect()->back();
    }

    public function adminDestroy($slug)
    {
        $proposal = Proposal::where('slug', $slug)->firstOrFail();
        Storage::disk('public')->delete('docs/proposal/' . $proposal->name);
        $proposal->delete();
        // Proposal::destroy($proposal->name);
        Alert::success('System!', 'Penghapusan permohonan berhasil');
        return redirect()->back();
    }
}
