<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $products = $query->get();
        $categories = Product::distinct('category')->get()->pluck('category');

        return view('shop.index', compact('products', 'categories'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('shop.cart', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('shop.checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('shop.index')->with('error', 'Cart is empty');
        }

        $totalPrice = 0;
        $orderedItems = [];
        $itemsSummaryArr = [];

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $orderedItems[] = [
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ];
            $itemsSummaryArr[] = $item['quantity'] . 'x ' . $item['name'];
        }

        $itemsSummary = implode(', ', $itemsSummaryArr);

        // Assign a random active driver
        $activeDrivers = \App\Models\Driver::where('status', 'active')->get();
        $driver = $activeDrivers->isNotEmpty() ? $activeDrivers->random() : null;

        // Dynamically create a route for this order
        $route = \App\Models\Route::create([
            'route_name' => 'Delivery to ' . $request->city,
            'start_location' => 'Main Hub',
            'end_location' => $request->delivery_address . ', ' . $request->city,
            'start_lat' => 17.4399, // Static mock for Hyderabad roughly
            'start_lng' => 78.4983,
            'end_lat' => 17.4399 + (rand(-5, 5) / 1000), // Very close by
            'end_lng' => 78.4983 + (rand(-5, 5) / 1000),
            'estimated_distance' => rand(1, 30) / 10, // 0.1 to 3.0 km
            'estimated_time' => rand(5, 14) . ' mins',
            'status' => 'pending',
            'driver_id' => $driver ? $driver->id : null,
        ]);

        $orderNumber = 'ORD-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);

        Order::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => Auth::user()->email,
            'delivery_address' => $request->delivery_address,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'ordered_items' => $orderedItems,
            'items_summary' => $itemsSummary,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'route_id' => $route->id,
            'driver_id' => $driver ? $driver->id : null,
        ]);

        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('shop.success');
    }
}

