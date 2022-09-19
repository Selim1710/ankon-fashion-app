<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CartController extends Controller
{
    public function cart(Request $request, $id)
    {
        $products = Product::with('productImage')->where('id', $id)->get();
        foreach ($products as $product) {
            $productId = $product->id;
            $productName = $product->name;
            // product image 
            if ($product->productImage) {
                foreach ($product->productImage as $image) {
                    $productImage = $image->images;
                }
            }
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
        $carts = session()->get('cart');
        if ($carts) {
            foreach ($carts as $cart)
                Order::create([
                    'customer_id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'address' => auth()->user()->address,

                    'product_id' => $cart['id'],
                    'product_name' => $cart['name'],
                    'image' => json_encode($cart['image']),
                    'size' => $cart['size'],
                    'price' => $cart['new_price'],
                    'quantity' => $cart['quantity'],
                    'total' => ($cart['new_price'] * $cart['quantity']),
                ]);
            session()->forget('cart');
            return redirect()->back()->with('message', 'Order place successfully');
        }
        return redirect()->back()->with('error', 'No data found into the cart');
    }

    public function orderList($id)
    {
        $supplierOrderList = Order::where('order_status', 'accepted')->get();
        $orders = Order::where('customer_id', '=', $id)->get();
        $categories = Category::with('subCategories')->get();
        $products = Product::with('productImage')->orderBy('id', 'DESC')->paginate(8);
        return view('website.layouts.order_list', compact('supplierOrderList', 'orders', 'categories', 'products'));
    }
    public function buyProduct(Request $request, $id)
    {
        $product = Product::find($id);
        try {
            Order::create([
                'customer_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address,

                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'image' => json_encode($product['image']),
                'size' => $request['size'],
                'price' => $product['new_price'],
                'quantity' => $request['quantity'],
                'total' => ($product['new_price'] * $request['quantity']),
            ]);
            return redirect()->back()->with('message', 'Order place successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Please! check your address or phone number');
        }
    }
}
