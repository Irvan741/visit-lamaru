<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\WisataFacility;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class WisataFacilityController extends Controller
{
    public function index($id){
        $datas = Wisata::findOrFail($id);
        // dd($datas);
        return view('admin.wisata.facility.index', compact('datas'));
    }

    public function create($id){
        $data = Wisata::findOrFail($id);
        return view('admin.wisata.facility.create', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'wisata_id' => 'required|exists:wisatas,id',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);
        // Simpan gambar
        $imagePath = $request->file('image_path')->store('wisata_images', 'public');

        WisataFacility::create([
            'wisata_id' => $request->wisata_id,
            'image_path' => $imagePath,
            'caption' => $request->caption
        ]);
    }

    public function edit($id){
        $data = WisataFacility::findOrFail($id);
        return view('admin.wisata.facility.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = WisataFacility::findOrFail($id);

        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'nullable|string',
            'wisata_id' => 'required|exists:wisatas,id',
        ]);

        $imagePath = $data->image_path;

        // Kalau ada file baru diupload
        if ($request->hasFile('image_path')) {
            // Hapus gambar lama jika ada
            if ($imagePath && file_exists(public_path('facility' . $imagePath))) {
                unlink(public_path('facility' . $imagePath));
            }

            $image = $request->file('image_path');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('facility'), $filename);
            $imagePath = $filename;
        }

        $data->update([
            'wisata_id' => $request->wisata_id,
            'image_path' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect('/admin/wisata/' . $data->wisata_id.'/fasilitas')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }


    public function destroy(Request $request, $id)
    {
        $data = WisataFacility::findOrFail($id);
        $wisataId = $data->wisata_id;

        // Hapus file gambar dari public folder
        if ($data->image_path && File::exists(public_path($data->image_path))) {
            File::delete(public_path($data->image_path));
        }

        // Hapus data dari database
        $data->delete();

        return redirect('/admin/wisata/' . $wisataId .'/fasilitas');
    }

}
