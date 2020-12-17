<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'allDay' => 'required',
            'color' => 'required',
            'textColor' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        } else {
            Event::create($request->all());
            Alert::success('Success!!', 'Agenda berhasil disimpan');
            // return redirect()->back();
            return redirect()->back()->with('success', 'Task Created Successfully!');
  
        }
    }

    public function index()
    {
        $event = Event::latest()->get();
        return Response()->json($event);
    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);

       
        return Response::json($event);
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();

        return Response::json($event);
    }
}
