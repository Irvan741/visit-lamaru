<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index(){
        $datas = Facility::get();
        return view('admin.facility.index', compact('datas'));
    }

    public function create(){
        return view('admin.facility.create');
    }

    public function store(Request $request){
        Facility::create([
            'wisata_id' => $request->wisata_id,
            'image_path' => $request->image_path,
            'caption' => $request->caption
        ]);

        return redirect('/admin/facility');
    }

    public function edit($id){
        $data = Facility::findOrFail($id);
        return view('admin.facility.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Facility::findOrFail($id);
        $data->update([
            'wisata_id' => $request->wisata_id,
            'image_path' => $request->image_path,
            'caption' => $request->caption
        ]);

        return redirect('/admin/facility');
    }

    public function delete(Request $request, $id){
        $data = Facility::findOrFail($id);
        $data->delete();

        return redirect('/admin/facility');
    }
}
