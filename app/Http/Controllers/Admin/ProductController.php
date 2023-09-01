<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::latest()->get();
        return view('admin.all-products', compact('data'));
    }
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        return view('admin.add-product', compact('categories', 'sub_categories'));
    }
    public function store(Request $request)
    {
        $request->validate(([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');
        Product::insert([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $img_url,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name))
        ]);
        Category::where('id', $category_id)->increment('product_count', 1);
        SubCategory::where('id', $subcategory_id)->increment('product_count', 1);
        return redirect()->route('admin-all-products')->with('message', 'Product Added Successfully');
    }
    public function editImg($id)
    {
        $data = Product::findOrFail($id);
        return view('admin.edit-product-img', compact('data'));
    }
    public function updateImg(Request $request, $id)
    {
        $request->validate(([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update([
            'product_img' => $img_url,
        ]);
        return redirect()->route('admin-all-products')->with('message', 'Product Image Updated Successfully');
    }
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        $data = Product::findOrFail($id);
        return view('admin.edit-product', compact('data', 'categories', 'sub_categories'));
    }
    public function update(Request $request, $id)
    {

        $data = Product::find($id);
        // dd($data);

        $request->validate(([
            'product_name' => 'required|unique:products,product_name,' . $id,
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));
        $img_url = $data->product_img;
        if ($request->file('product_img')) {
            @unlink(public_path($data->product_img));
            $image = $request->file('product_img');
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $request->product_img->move(public_path('upload'), $img_name);
            $img_url = 'upload/' . $img_name;
        }



        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $img_url,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name))
        ]);
        return redirect()->route('admin-all-products')->with('message', 'Product Updated Successfully');
    }
    public function destroy($id)
    {
        $data = Product::find($id);
        @unlink(public_path($data->product_img));

        $cat_id = Product::where('id', $id)->value('product_category_id');
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');

        Category::where('id', $cat_id)->decrement('product_count', 1);
        SubCategory::where('id', $subcat_id)->decrement('product_count', 1);

        Product::findOrFail($id)->delete();
        return redirect()->route('admin-all-products')->with('message', 'Product Deleted Successfully');
    }
}
