<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentController extends Controller
{


    public function show($id)
    {
        $data = Proposal::find($id);
        return view('UKM.layouts.viewer', compact('data'));
    }

    public function index()
    {
        $id = auth()->user()->id;
        $allNotif = Notif::get()->where('user_id', '==', $id);

        $file = Proposal::get()->where('user_id', '==', $id);
        return view('UKM.dataUKM', [
            'file' => $file,
            'notifSuccess' => $allNotif->where('info', '==', 0)->where('tipe', '==', 1),
            'notifFail' => $allNotif->where('info', '==', 0)->where('tipe', '==', 0),
            'notifBaru' => count($allNotif->where('info', '==', 0)),
            'allNotif' => $allNotif
        ]);
    }

    public function docUpdate($name, Request $request)
    {
        $data = Proposal::where('name', $name)->firstOrFail();

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
                $data->update($docs);
                return response()->json(['success' => $filename]);
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

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request = $file->storeAs("docs/proposal", $filename);
        $attr['name'] = $filename;
        $attr['type'] = $file->getClientOriginalExtension();

        $data = auth()->user()->proposals()->create($attr);
        Alert::success('Berhasil!!', 'Proposal berhasil terkirim');
        return redirect()->back();
    }

    public function update($name)
    {

        $data = Proposal::where('name', $name)->firstOrFail();
        $attr = request()->validate([
            'judul' => 'required|min:4',
            'mulai' => 'required|min:4',
            'selesai' => 'required|min:4',
            'tanggal' => 'required|min:4',
            'tempat' => 'required|min:4',
            'PenanggungJawab' => 'required|min:4',
        ]);


        $data->update($attr);
        Alert::success('Berhasil!!', 'Proposal berhasil diedit');
        return redirect()->to('profileUKM/data');
    }

    public function adminUpdate($name)
    {
        $data = Proposal::where('name', $name)->firstOrFail();
        $attr = request()->validate([
            'judul' => 'required|min:4',
            'mulai' => 'required|min:4',
            'selesai' => 'required|min:4',
            'tanggal' => 'required|min:4',
            'tempat' => 'required|min:4',
            'PenanggungJawab' => 'required|min:4',
        ]);


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
        $dist['tipe'] = '1';
        $dist['deskripsi'] = 'Proposal ' . $proposal->judul . ' telah di-acc, silahkan melaksanakan kegiatan.
         Tetap laksanakan PROTOKOL KESEHATAN!, dan jangan lupa lampirkan laporan SPJ setelah kegiatan. Terima Kasih.';
        $notif = Notif::create($dist);

        Alert::success('System!!', 'Proposal ter-acc');
        return redirect()->to('/adminTable/Pengajuan');
    }
    public function tolak($id)
    {
        $proposal = Proposal::where('id', $id)->firstOrFail();
        $attr['status'] = "Ditolak";
        $proposal->update($attr);

        $dist['user_id'] = $proposal->user_id;
        $dist['judul'] = 'Proposal ditolak';
        $dist['info'] = '0';
        $dist['tipe'] = '0';
        $dist['deskripsi'] = 'Proposal ' . $proposal->judul . ' dibatalkan.
         silahkan periksa kembali proposal yang dikirim atau hubungi yang berwenang';
        $notif = Notif::create($dist);
        Alert::warning('System!!', 'Proposal ditolak');
        return redirect()->to('/adminTable/Pengajuan');
    }

    public function edit($name)
    {
        $proposal = Proposal::where('name', $name)->firstOrFail();
        // dd($proposal->name);
        return view('UKM.editProposal', compact('proposal'));
    }

    public function editAdmin($name)
    {
        $proposal = Proposal::where('name', $name)->firstOrFail();

        return view('users.adminEditProposal', compact('proposal'));
    }


    public function destroy($name)
    {

        $proposal = Proposal::where('name', $name)->firstOrFail();
        Storage::disk('public')->delete('docs/proposal/' . $proposal->name);
        $proposal->delete();
        // Proposal::destroy($proposal->name);
        Alert::success('System!', 'Penghapusan permohonan berhasil');
        return redirect()->back();
    }

    public function adminDestroy($name)
    {
        $proposal = Proposal::where('name', $name)->firstOrFail();
        Storage::disk('public')->delete('docs/proposal/' . $proposal->name);
        $proposal->delete();
        // Proposal::destroy($proposal->name);
        Alert::success('System!', 'Penghapusan permohonan berhasil');
        return redirect()->back();
    }
}
