<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function store(Request $request)
{
    // Enhanced validation
    $validated = $request->validate([
        'food_id' => 'required|exists:foods,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'payment_method' => 'required|in:gcash,paypal,cash',
    ]);

    $food = \App\Models\Food::findOrFail($validated['food_id']);

    // Simple calculations
    $subtotal = $validated['price'] * $validated['quantity'];
    $serviceCharge = $subtotal * 0.05; 
    $total = $subtotal + $serviceCharge;

    // Create order
    $order = Order::create([
        'user_id' => Auth::id(),
        'status' => 'pending',
        'subtotal' => $subtotal,
        'service_charge' => $serviceCharge,
        'total' => $total,
        'payment_method' => $validated['payment_method'],
        'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
        'dish_name' => $food->name
    ]);

    // Create single order item
    $order->items()->create([
        'food_id' => $validated['food_id'],
        'quantity' => $validated['quantity'],
        'price' => $validated['price']
    ]);

    return redirect()->route('order.confirmation', $order->id)
        ->with('success', 'Order Placed Successfully!');
    }

    public function confirmation(Order $order)
    {
        return Inertia::render('Orders/Confirmation', [
            'order' => $order->load('items.food'),
            'success' => session('success') 
        ]);
    }
}