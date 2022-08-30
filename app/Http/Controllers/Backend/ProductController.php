<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function manageProduct()
    {
        $products = Product::with('subCategory')->orderBy('id', 'desc')->get();
        return view('admin.layouts.product.product_table', compact('products'));
    }
    public function add()
    {
        $subCategories = Subcategory::with('product')->get();
        return view('admin.layouts.product.add_product', compact('subCategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'old_price' => 'required',
            'new_price' => 'required',
            'offer' => 'required',
            'size' => 'required',
            'images' => 'required|max:5048',
            'description' => 'required',
            'subCategory_id' => 'required',
        ]);
        $filename=array();
        if ($request->has('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $filename[] = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
                $imageArrayToString = implode("," ,$filename);
                $file->move(public_path('/uploads/products'), $imageArrayToString);
            }
            $sizeArrayToString = implode(",", $request['size']);
            Product::create([
                'name' => $request->name,
                'old_price'  => $request->old_price,
                'new_price' => $request->new_price,
                'image' => $imageArrayToString,
                'offer' => $request->offer,
                'size' => $sizeArrayToString,
                'description' => $request->description,

                'subCategory_id' => $request->subCategory_id,
            ]);
            return redirect()->route('admin.manage.product')->with('message', 'Product added successfully');
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.layouts.product.edit_product', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'offer' => $request->offer,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.manage.product')->with('message', 'Product updated');
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $image = str_replace('\\', '/', public_path('uploads/products/' . $product->image));
        if (is_file($image)) {
            unlink($image);
            $product->delete();
            return redirect()->route('admin.manage.product')->with('error', 'Product deleted');
        } else {
            $product->delete();
            return redirect()->back()->with('error', 'image not found! product deleted');
        }
    }

    public function view($id)
    {
        $product = Product::find($id);
        return view('admin.layouts.product.view_product', compact('product'));
    }
    public function change(Request $request, $id)
    {
        $product = Product::find($id);
        $filename = '';
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = date('Ymdmhs') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/products'), $filename);
        }
        $product->update([
            'image' => $filename,
        ]);
        return redirect()->route('admin.manage.product')->with('message', 'Product Image Updated');
    }
}
