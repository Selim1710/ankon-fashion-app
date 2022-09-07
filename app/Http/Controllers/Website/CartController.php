<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request, $id)
    {
        $products = Product::with('productImage')->where('id', $id)->get();
        foreach ($products as $product) {
            $productId = $product->id;
            $productName = $product->name;
            $productImage = $product->productImage;
            $oldPrice =  $product->old_price;
            $offer = $product->offer;
            $newPrice = $product->new_price;
        }
        $productSize = $request->size;
        $productQuantity = $request->quantity;
        if (!$product) {
            return redirect()->route('website.home')->with('error', 'there is no product into the cart');
        }
        $cartExist = session()->get('cart');
        // case-1:no cart
        if (!$cartExist) {
            $cartData = [$id => [
                'id' => $productId,
                'name' => $productName,
                'image' => $productImage,
                'size' => $productSize,
                'old_price' => $oldPrice,
                'offer' => $offer,
                'new_price' => $newPrice,
                'quantity' => $productQuantity,
            ]];
            session()->put('cart', $cartData);
            return redirect()->back()->with('message', 'Product added into the cart');
        }
        // case-2:already one cart exist
        if (!isset($cartExist[$id])) {
            $cartExist[$id] = [
                'id' => $productId,
                'name' => $productName,
                'image' => $productImage,
                'size' => $productSize,
                'old_price' => $oldPrice,
                'offer' => $offer,
                'new_price' => $newPrice,
                'quantity' => $productQuantity,
            ];
            session()->put('cart', $cartExist);
            return redirect()->route('website.home')->with('message', 'Product added into the cart');
        }
        // case-3: same product adding into the cart
        $cartExist[$id]['quantity'] = $cartExist[$id]['quantity'] + $productQuantity;
        session()->put('cart', $cartExist);
        return redirect()->route('website.home')->with('message', 'Product added into the cart');
    }
    public function viewCart()
    {
        $carts = session()->get('cart');
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.view_cart', compact('carts', 'categories', 'products'));
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('user.view.cart')->with('error', 'Cart Cleared');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('error', 'Product deleted from cart');
    }

    public function checkout()
    {
        dd('checkout');
        $carts = session()->get('cart');
        if ($carts) {
            foreach ($carts as $cart)
                Order::create([
                    'customer_id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'id' => $cart['id'],
                    'name' => $cart['name'],
                    'price' => $cart['price'],
                    'offer' => $cart['offer'],
                    'quantity' => $cart['quantity'],
                    'total' => ($cart['price'] * $cart['quantity']) - ($cart['price'] * $cart['quantity'] * ($cart['offer'] / 100)),
                ]);
            session()->forget('cart');
            return redirect()->back()->with('message', 'Order place successfully. Now Click -- PROCESS TO PAY -- to confirm order');
        }
        return redirect()->back()->with('error', 'No data found into the cart');
    }
}
