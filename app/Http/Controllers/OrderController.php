<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric'
        ]);

        // Calculate subtotal
        $subtotal = $validated['price'] * $validated['quantity'];

        // Calculate 5% service charge
        $serviceCharge = $subtotal * 0.05;
        
        // Calculate total with service charge
        $total = $subtotal + $serviceCharge;

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'subtotal' => $subtotal,  // Store subtotal
            'service_charge' => $serviceCharge,  // Store service charge
            'total' => $total  // Store final total
        ]);
        
        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'food_id' => $validated['food_id'],
            'quantity' => $validated['quantity'],
            'price_at_order' => $validated['price']
        ]);
        
        return redirect()->route('order.confirmation', $order->id);
    }
}
