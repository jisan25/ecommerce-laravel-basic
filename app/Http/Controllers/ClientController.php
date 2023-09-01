<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function categoryIndex($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('frontend.category', compact('category', 'products'));
    }
    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');

        $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('frontend.single-product', compact('product', 'related_products'));
    }
    public function addToCart()
    {
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        return view('frontend.add-to-cart', compact('cart_items'));
    }
    public function removeCart($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('add.to.cart')->with('message', 'Your item removed from cart successfully');
    }
    public function shippingAddress()
    {
        return view('frontend.shipping-address');
    }
    public function shippingAddressStore(Request $request)
    {
        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code
        ]);
        return redirect()->route('checkout');
    }
    public function addProductToCart(Request $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;
        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price,
        ]);
        return redirect()->route('add.to.cart')->with('message', 'Your item added to cart succesfully');
    }
    public function checkout()
    {
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        return view('frontend.checkout', compact('cart_items', 'shipping_address'));
    }
    public function placeOrder()
    {
        $userid = Auth::id();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        $cart_items = Cart::where('user_id', $userid)->get();

        foreach ($cart_items as $item) {
            Order::insert([
                'userid' => $userid,
                'shipping_phonenumber' => $shipping_address->phone_number,
                'shipping_city' => $shipping_address->city_name,
                'shipping_postalcode' => $shipping_address->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price
            ]);
            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }
        ShippingInfo::where('user_id', $userid)->first()->delete();
        return redirect()->route('pending.orders')->with('message', 'Your order has been placed successfully');
    }
    public function userProfile()
    {
        return view('frontend.user-profile');
    }
    public function pendingOrders()
    {
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('frontend.pending-orders', compact('pending_orders'));
    }
    public function history()
    {
        return view('frontend.history');
    }
    public function newRelease()
    {
        return view('frontend.new-release');
    }
    public function todaysDeal()
    {
        return view('frontend.todays-deal');
    }
    public function customService()
    {
        return view('frontend.custom-service');
    }
}
