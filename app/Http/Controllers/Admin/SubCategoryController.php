<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data = SubCategory::latest()->get();
        return view('admin.all-sub-categories', compact('data'));
    }
    public function addSubCategory()
    {
        $data = Category::latest()->get();
        return view('admin.add-sub-category', compact('data'));
    }
    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);
        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');
        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->sub_category_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);
        Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('admin-all-sub-categories')->with('message', 'Sub Category Added Successfully');
    }
    public function edit($id)
    {
        $data = SubCategory::findOrFail($id);
        return view('admin.edit-sub-category', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
        ]);
        SubCategory::findOrFail($id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->sub_category_name)),
        ]);
        return redirect()->route('admin-all-sub-categories')->with('message', 'Sub Category Updated Successfully');
    }
    public function destroy($id)
    {
        $cat_id =  SubCategory::where('id', $id)->value('category_id');
        SubCategory::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('subcategory_count');
        return redirect()->route('admin-all-sub-categories')->with('message', 'Sub Category Deleted Successfully');
    }
}
