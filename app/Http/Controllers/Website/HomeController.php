<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Stock;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('subCategory')->orderBy('id', 'DESC')->paginate(8);
        $offers_image = Offer::pluck('image');
        return view('website.layouts.home', compact('categories', 'products', 'offers_image'));
    }
    public function search(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $products = Product::where('model', 'LIKE', '%' . $search . '%')
                ->orwhere('product_name', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'DESC')
                ->get();
            $result = Product::where('model', 'LIKE', '%' . $search . '%')
                ->orwhere('product_name', 'LIKE', '%' . $search . '%')
                ->get()
                ->count();
            return view('website.layouts.search', compact('products', 'search', 'result'));
        } else {
            $products = Product::with('subCategory')->orderBy('id', 'DESC')->get();
            $result = '0';
            return view('website.layouts.search', compact('products', 'search', 'result'));
        }
    }

    public function categoryProduct($id)
    {
        $category = Category::find($id);
        $subCategory = Subcategory::where('category_id', '=', $id)->get();
        foreach ($subCategory as $sub) {
            $products = Product::where('subCategory_id', '=', $sub->id)->orderBy('id', 'DESC')->get();
        }
        return view('website.layouts.category_product', compact('products'));
    }

    public function subCategoryProduct($id)
    {
        $subCategory = Subcategory::find($id);
        $products = Product::where('subCategory_id', '=', $id)->orderBy('id', 'DESC')->get();
        return view('website.layouts.sub_category_product', compact('products'));
    }

    ////////////////////////// price shorting ////////////////////////// 
    public function allProduct()
    {
        $products = Product::with('subCategory')->orderBy('id', 'DESC')->paginate(16);
        $processor = Product::pluck('processor')->unique();
        $display = Product::pluck('display')->unique();
        $memory = Product::pluck('memory')->unique();
        $graphics = Product::pluck('graphics')->unique();
        $operating = Product::pluck('operating_system')->unique();
        $battery = Product::pluck('battery')->unique();

        return view('website.layouts.all_product', compact('products', 'processor', 'display', 'memory', 'graphics', 'operating', 'battery'));
    }

    public function lowPrice()
    {
        $products = Product::where('regular_price', '<', '20000')->orderBy('id', 'DESC')->paginate(16);
        $processor = Product::pluck('processor')->unique();
        $display = Product::pluck('display')->unique();
        $memory = Product::pluck('memory')->unique();
        $graphics = Product::pluck('graphics')->unique();
        $operating = Product::pluck('operating_system')->unique();
        $battery = Product::pluck('battery')->unique();

        return view('website.layouts.all_product', compact('products', 'processor', 'display', 'memory', 'graphics', 'operating', 'battery'));
    }

    public function midPrice()
    {
        $max = 50000;
        $min = 20000;
        $processor = Product::pluck('processor')->unique();
        $display = Product::pluck('display')->unique();
        $memory = Product::pluck('memory')->unique();
        $graphics = Product::pluck('graphics')->unique();
        $operating = Product::pluck('operating_system')->unique();
        $battery = Product::pluck('battery')->unique();
        $products = Product::whereBetween('regular_price', [$min, $max])->orderBy('id', 'DESC')->paginate(16);

        return view('website.layouts.all_product', compact('products', 'processor', 'display', 'memory', 'graphics', 'operating', 'battery'));
    }
    public function highPrice()
    {
        $products = Product::where('regular_price', '>', '50000')->orderBy('id', 'DESC')->paginate(16);
        $processor = Product::pluck('processor')->unique();
        $display = Product::pluck('display')->unique();
        $memory = Product::pluck('memory')->unique();
        $graphics = Product::pluck('graphics')->unique();
        $operating = Product::pluck('operating_system')->unique();
        $battery = Product::pluck('battery')->unique();

        return view('website.layouts.all_product', compact('products', 'processor', 'display', 'memory', 'graphics', 'operating', 'battery'));
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
        }else{
            $products = Product::with('subCategory')->orderBy('id', 'DESC')->paginate(16);
            $processor = Product::pluck('processor')->unique();
            $display = Product::pluck('display')->unique();
            $memory = Product::pluck('memory')->unique();
            $graphics = Product::pluck('graphics')->unique();
            $operating = Product::pluck('operating_system')->unique();
            $battery = Product::pluck('battery')->unique();
        }
        return view('website.layouts.all_product_filter', compact('products','result', 'processor', 'display', 'memory', 'graphics', 'operating', 'battery'));
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

    public function laptopDeals()
    {
        // laravel query for laptop deals
        $category = Category::where('category_name', 'LIKE', 'laptop')->get();
        foreach ($category as $cat) {
            $sub_cat = Subcategory::where('category_id', '=', $cat->id)->get();
            foreach ($sub_cat as $sub) {
                $product = Product::where('subCategory_id', '=', $sub->id)->orderBy('id', 'DESC')->get();
            }
        }
        $laptopDeals = $product;
        // laravel query for tablet deals
        $category = Category::where('category_name', 'LIKE', 'tablet')->get();
        foreach ($category as $cat) {
            $sub_cat = Subcategory::where('category_id', '=', $cat->id)->get();
            foreach ($sub_cat as $sub) {
                $product = Product::where('subCategory_id', '=', $sub->id)->orderBy('id', 'DESC')->get();
            }
        }
        $tabletDeals = $product;
        // return $tabletDeals;
        return view('website.layouts.laptop_deals', compact('laptopDeals', 'tabletDeals'));
    }
    public function laptopDealsDetails($id)
    {
        $product = Product::find($id);
        $stocks = Stock::where('product_id', '=', $id)->get();
        return view('website.layouts.laptop_deals_details', compact('product', 'stocks'));
    }
    public function productDetails($id)
    {
        $product = Product::find($id);
        $stocks = Stock::where('product_id', '=', $id)->get();
        return view('website.layouts.product_details', compact('product', 'stocks'));
    }

    public function compareProduct(Request $request)
    {
        $search_c1 = $request['search_c1'] ?? "";
        $search_c2 = $request['search_c2'] ?? "";
        // remain: specific product will be show
        if ($search_c1 && $search_c2 != "") {
            $search_c1 = Product::where('product_name', 'LIKE', "%$search_c1%")
                ->orwhere('model', 'LIKE', "%$search_c1%")
                ->get();
            $search_c2 = Product::where('product_name', 'LIKE', "%$search_c2%")
                ->orwhere('model', 'LIKE', "%$search_c2%")
                ->get();
            return view('website.layouts.compare_product_table', compact('search_c1', 'search_c2'));
        } else {
            return redirect()->route('website.home')->with('error', 'Search is empty');
        }
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
