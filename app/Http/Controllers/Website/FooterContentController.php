<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FooterContentController extends Controller
{
    public function aboutUs()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.about_us', compact('categories', 'products'));
    }

    public function contactUs()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.contact_us', compact('categories', 'products'));
    }

    public function howToShop()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.how_to_shop', compact('categories', 'products'));
    }

    public function paymentMethod()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.payment_method', compact('categories', 'products'));
    }


    public function privacyPolicy()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.privacy_policy', compact('categories', 'products'));
    }
    public function termsConditions()
    {
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.footer_content.terms_condition', compact('categories', 'products'));
    }
}
