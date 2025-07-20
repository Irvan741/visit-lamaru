<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Category;
use Illuminate\Support\Str;

class WisataController extends Controller
{
    public function index(){
        $datas = Wisata::get();
        return view('admin.wisata.index', compact('datas'));
    }

    public function create(){
        $categories = Category::get();
        return view('admin.wisata.create', compact('categories'));
    }

    public function store(Request $request){
        Wisata::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude
        ]);
        flash()->success('Wisata created successfully!');
        return redirect('/admin/wisata');
    }
    public function edit($id){
        $data = Wisata::findOrFail($id);
        return view('admin.wisata.edit', compact('data'));
    }

    public function update(Request $request){
        $data = Wisata::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude
        ]);

        flash()->success('Wisata updated successfully!');
        return redirect('/admin/wisata');
    }

    public function destroy(Request $request, $id){
        $data = Wisata::findOrFail($id);
        $data->delete();
    }
}
