<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    public function index(){
        $datas = Event::get();
        return view('admin.event.index', compact('datas'));
    }

    public function create(){
        return view('admin.event.create');
    }

    public function store(Request $request){
        Event::create([
            'wisata_id' => $request->wisata_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect('/admin/event');
    }

    public function edit($id){
        $data = Event::findOrFail($id);
        return view('admin.event.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Event::findOrFail($id);
        $data->update([
            'wisata_id' => $request->wisata_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect('/admin/event');
    }

    public function delete(Request $request, $id){
        $data = Event::findOrFail($id);
        $data->delete();

        return redirect('/admin/event');
    }
}
