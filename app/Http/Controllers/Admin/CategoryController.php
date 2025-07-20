<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        flash()->success('Category created successfully!');
        return redirect('/admin/category');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        flash()->success('Category Updated successfully!');
        return redirect('/admin/category');
    }

    public function delete(Request $request, $id){
        $category = Category::find($id)->delete();
        flash()->success('Category Deleted successfully!');
        return redirect('/admin/category');
    }
}
