<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        $offers = Offer::all();
        // dd($products);
        return view('website.layouts.home', compact('categories', 'products', 'offers'));
    }
    public function search(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $products = Product::with('productImage')->where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'DESC')
                ->get();
            $result = Product::where('name', 'LIKE', '%' . $search . '%')
                ->get()
                ->count();
            $categories = Category::with('subCategories')->get();
            return view('website.layouts.search', compact('products', 'search', 'result', 'categories'));
        } else {
            $categories = Category::with('subCategories')->get();
            $products = Product::with('subCategory')->orderBy('id', 'DESC')->get();
            $result = '0';
            return view('website.layouts.search', compact('products', 'search', 'result', 'categories'));
        }
    }

    public function categoryProduct($id)
    {
        $category = Category::find($id);
        $categories = Category::with('subCategories')->get();
        $subCategory = Subcategory::where('category_id', '=', $id)->get();
        foreach ($subCategory as $sub) {
            $products = Product::where('subCategory_id', '=', $sub->id)->orderBy('id', 'DESC')->get();
        }
        return view('website.layouts.category_product', compact('products', 'categories'));
    }

    public function subCategoryProduct($id)
    {
        $categories = Category::with('subCategories')->get();
        $subCategory = Subcategory::find($id);
        $products = Product::where('subCategory_id', '=', $id)->orderBy('id', 'DESC')->get();
        return view('website.layouts.sub_category_product', compact('categories', 'products'));
    }

    ////////////////////////// price shorting ////////////////////////// 
    public function allProduct()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        $subCategories = Subcategory::with('product')->pluck('sub_category_name');
        return view('website.layouts.all_product', compact('products', 'categories', 'subCategories'));
    }
    public function allProductFilter(Request $request)
    {
        $array = $request->all();
        $filter = $array ?? "";
        if ($filter) {
            $categories = Category::with('subCategories')->get();
            $products = Product::whereIn('size', [json_encode($filter['size'])])->get();
            $subCategories = Subcategory::pluck('sub_category_name');
        } else {
            $categories = Category::with('subCategories')->get();
            $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
            $subCategories = Subcategory::with('product')->pluck('sub_category_name');
        }
        return view('website.layouts.all_product_filter', compact('products', 'categories', 'subCategories'));
    }

    public function lowPrice()
    {
        $subCategories = Subcategory::with('product')->pluck('sub_category_name');
        $categories = Category::with('subCategories')->get();
        $products = Product::where('new_price', '<', '1000')->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories', 'subCategories'));
    }

    public function midPrice()
    {
        $subCategories = Subcategory::with('product')->pluck('sub_category_name');
        $categories = Category::with('subCategories')->get();
        $max = 2000;
        $min = 1000;
        $products = Product::whereBetween('new_price', [$min, $max])->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories', 'subCategories'));
    }
    public function highPrice()
    {
        $subCategories = Subcategory::with('product')->pluck('sub_category_name');
        $categories = Category::with('subCategories')->get();
        $products = Product::where('new_price', '>', '2001')->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories', 'subCategories'));
    }
    ////////////////////////// offer ////////////////////////// 

    public function offers()
    {
        $offers = Offer::all()->sortByDesc('id')->values();
        return view('website.layouts.offers', compact('offers'));
    }
    public function offerDetails($id)
    {
        $offer = Offer::find($id);
        return view('website.layouts.offer_details', compact('offer'));
    }

    public function productDetails($id)
    {
        $product = Product::find($id);
        if ($product) {
            $categories = Category::with('subCategories')->get();
            $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
            $productImages = ProductImage::where('product_id', $id)->get();
            $subCatProduct = Product::with('productImage')->where('subCategory_id', $product->subCategory_id)->get();
            $reviews = Review::where('product_id', $id)->get();
            return view('website.layouts.product_details', compact('categories', 'productImages', 'products', 'product', 'subCatProduct', 'reviews'));
        }
        return redirect()->back()->with('message', 'Product Not Found');
    }

    ////////////////////////// Review //////////////////////////
    public function review($id)
    {
        $review = Order::find($id);
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.review', compact('review', 'categories', 'products'));
    }
    public function submitReview(Request $request, $id)
    {
        $review = Order::find($id);
        Review::create([
            'order_id' => $review->id,
            'product_id' => $review->product_id,
            'customer_name' => $review->name,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with('message', 'Thank you for your comment 🙂');
    }

    ////////////////////////// cancel Order //////////////////////////
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('error', 'order cancelled');
    }

    ////////////////////////// supplier Delivered //////////////////////////

    public function supplierDelivered($id)
    {
        $supplierDelivered = Order::find($id);
        // dd($supplierDelivered);
        $supplierDelivered->update([
            'order_status' => 'delivered',
        ]);
        return redirect()->back()->with('message', 'order delivered');
    }
}
