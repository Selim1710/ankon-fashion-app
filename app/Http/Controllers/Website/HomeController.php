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
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories'));
    }

    public function lowPrice()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::where('new_price', '<', '1000')->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories'));
    }

    public function midPrice()
    {
        $categories = Category::with('subCategories')->get();
        $max = 2000;
        $min = 1000;
        $products = Product::whereBetween('new_price', [$min, $max])->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories'));
    }
    public function highPrice()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::where('new_price', '>', '2001')->orderBy('id', 'DESC')->paginate(16);
        return view('website.layouts.all_product', compact('products', 'categories'));
    }

    ////////////////////////// prodcut filtering ////////////////////////// 
    public function filterAllProduct(Request $request)
    {
        $array = $request->all();
        $filter = $array ?? "";
        if ($filter) {
            $products = Product::whereIn('processor', $filter)
                ->orwhereIn('display', $filter)
                ->orwhereIn('memory', $filter)
                ->orwhereIn('graphics', $filter)
                ->orwhereIn('operating_system', $filter)
                ->orwhereIn('battery', $filter)
                ->get();

            $result = $products->count();

            $processor = Product::pluck('processor')->unique();
            $display = Product::pluck('display')->unique();
            $memory = Product::pluck('memory')->unique();
            $graphics = Product::pluck('graphics')->unique();
            $operating = Product::pluck('operating_system')->unique();
            $battery = Product::pluck('battery')->unique();
        } else {
            $products = Product::with('subCategory')->orderBy('id', 'DESC')->paginate(16);
            $processor = Product::pluck('processor')->unique();
            $display = Product::pluck('display')->unique();
            $memory = Product::pluck('memory')->unique();
            $graphics = Product::pluck('graphics')->unique();
            $operating = Product::pluck('operating_system')->unique();
            $battery = Product::pluck('battery')->unique();
        }
        return view('website.layouts.all_product_filter', compact('products', 'result'));
    }

    ////////////////////////// The end ////////////////////////// 
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
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        $product = Product::find($id);
        $productImages = ProductImage::where('product_id', $id)->get();
        $subCatProduct = Product::with('productImage')->where('subCategory_id', $product->subCategory_id)->get();
        $reviews = Review::where('product_id',$id)->get();
        // dd($reviews);
        return view('website.layouts.product_details', compact('categories', 'productImages', 'products', 'product', 'subCatProduct','reviews'));
    }

    ////////////////////////// Review //////////////////////////
    public function review($id)
    {
        $review = Order::find($id);
        // dd($id);
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.review', compact('review','categories','products'));
    }
    public function submitReview(Request $request, $id)
    {
        $review = Order::find($id);
        Review::create([
            'order_id'=>$review->id,
            'product_id'=>$review->product_id,
            'customer_name'=>$review->name,
            'comment'=>$request->comment,
        ]);
        return redirect()->back()->with('message','Thank you for your comment 🙂');
    }

     ////////////////////////// cancel Order //////////////////////////
     public function cancelOrder($id)
     {
         $order = Order::find($id);
         $order->delete();
         return redirect()->back()->with('error','order cancelled');
         
     }

    public function refundPolicy()
    {
        return view('website.layouts.refund_policy');
    }
    public function termsConditions()
    {
        return view('website.layouts.terms_condition');
    }
}
