<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.all-categories', compact('categories'));
    }
    public function addCategory()
    {
        return view('admin.add-category');
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        return redirect()->route('admin-all-categories')->with('message', 'Category Added Successfully');
    }
    public function EditCategory($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.edit-category', compact('data'));
    }
    public function UpdateCategory(Request $request)
    {
        $category_id = $request->category_id;
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        return redirect()->route('admin-all-categories')->with('message', 'Category Updated Successfully');
    }
    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin-all-categories')->with('message', 'Category Deleted Successfully');
    }
}
