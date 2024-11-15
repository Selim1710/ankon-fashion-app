<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function manageProduct()
    {
        $products = Product::with('productImage')->orderBy('id', 'desc')->get();
        // dd($products);
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
        $new_product = Product::create([
            'name' => $request->name,
            'old_price'  => $request->old_price,
            'new_price' => $request->new_price,
            'offer' => $request->offer,
            'size' => json_encode($request->size),
            'description' => $request->description,

            'subCategory_id' => $request->subCategory_id,
        ]);
        $filename = array();
        if ($request->has('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $filename = date('Ymdmhs') . '-image-' . rand(0, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/uploads/products'), $filename);
                ProductImage::create([
                    'images' => json_encode($filename),
                    'product_id' => $new_product->id,
                ]);
            }
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
            'old_price'  => $request->old_price,
            'new_price' => $request->new_price,
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
        $productImages = ProductImage::where('product_id', $id)->get();
        return view('admin.layouts.product.view_product', compact('productImages'));
    }
}
