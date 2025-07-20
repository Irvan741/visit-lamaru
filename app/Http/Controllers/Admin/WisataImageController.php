<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WisataImage;

class WisataImageController extends Controller
{
    public function index($id){
        $datas = WisataImage::where('wisata_id', $id)->get();
        return view('admin.wisata.image.index', compact('datas'));
    }

    public function create(){
        return view('admin.wisata.image.create');
    }

    public function store(Request $request){

        WisataImage::create([
            'wisata_id' => $request->wisata_id,
            'image_path' => $request->image_path,
            'caption' => $request->caption
        ])
    }

    public function edit($id){
        $data = WisataImage::findOrFail($id);
        return view('admin.wisata.image.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = WisataImage::findOrFail($id);
        $data->update([
            'wisata_id' => $request->wisata_id,
            'image_path' => $request->image_path,
            'caption' => $request->caption
        ]);

        return redirect('/admin/wisata/image/'. $data->wisata_id);
    }

    public function destroy(Request $request, $id){
        $data = WisataImage::findOrFail($id);

        $id = $data->wisata_id;
        $data->delete();
        return redirect('/admin/wisata/image/'.$id);
    }
}
