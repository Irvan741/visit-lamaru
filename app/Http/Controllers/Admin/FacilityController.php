<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Wisata;

class FacilityController extends Controller
{
    public function index($id){
        $datas = Wisata::findOrFail($id);
        return view('admin.wisata.facility.index', compact('datas'));
    }

    public function create($id){
        $wisata = Wisata::findOrFail($id);
        return view('admin.wisata.facility.create', compact('wisata'));
    }

    public function store(Request $request){
        Facility::create([
            'wisata_id' => $request->wisata_id,
            'name' => $request->name,
            'image_path' => $request->image_path,
            'caption' => $request->caption,
        ]);

        return redirect('/admin/wisata/'.$request->wisata_id.'/facility');
    }

    public function edit($id){
        $data = Facility::findOrFail($id);
        return view('admin.facility.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Facility::findOrFail($id);
        $data->update([
            'wisata_id' => $request->wisata_id,
            'name' => $request->name,
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
