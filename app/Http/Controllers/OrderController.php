<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function show(Food $food)
    {
        Log::info('OrderController::show called', ['food_id' => $food->id, 'auth_user' => Auth::user()]);

        if (!$food->exists) {
            return Inertia::render('WebPage/OrderSummary', [
                'food' => null,
                'auth' => Auth::check() && Auth::user() ? [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ] : null,
                'flash' => ['error' => 'Dish not found.']
            ]);
        }

        return Inertia::render('WebPage/OrderSummary', [
            'food' => $food->only(['id', 'name', 'description', 'price', 'image', 'category_id']),
            'auth' => Auth::check() && Auth::user() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ] : null
        ]);
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
        return Inertia::render('Auth/Login', [
            'flash' => ['error' => 'Please login to place an order.']
        ]);
    }

    Log::info('OrderController::store input:', $request->all());

    $validated = $request->validate([
        'food_id' => 'required|exists:foods,id', // Correct table name
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'payment_method' => 'required|in:gcash,paypal,cash'
    ]);

    Log::info('Validated data:', $validated);

    $food = Food::findOrFail($validated['food_id']);
    $quantity = (int) $validated['quantity'];
    $subtotal = $validated['price'] * $quantity;
    $service_charge = $subtotal * 0.05;
    $total = $subtotal + $service_charge;

    $order = Order::create([
        'user_id' => Auth::id(),
        'food_id' => $validated['food_id'],
        'quantity' => $quantity,
        'subtotal' => $subtotal,
        'service_charge' => $service_charge,
        'total' => $total,
        'payment_method' => $validated['payment_method'],
        'status' => 'pending',
        'order_number' => 'ORD-' . Str::random(8),
        'notes' => $request->input('notes', null)
    ]);

    Log::info('Created order:', $order->toArray());

    return Inertia::render('Orders/Confirmation', [
        'order' => $order->only(['id', 'food_id', 'quantity', 'subtotal', 'service_charge', 'total', 'payment_method', 'status', 'order_number']),
        'food' => $food->only(['id', 'name', 'image']),
        'flash' => ['success' => 'Order placed successfully! Awaiting staff approval.']
    ]);
}

    public function showConfirmation(Order $order)
    {
        if (!Auth::check() || $order->user_id !== Auth::id()) {
            return Inertia::render('Auth/Login', [
                'flash' => ['error' => 'Unauthorized access to order confirmation.']
            ]);
        }

        $food = Food::where('id', $order->food_id)->first();

        return Inertia::render('Orders/Confirmation', [
            'order' => $order->only(['id', 'food_id', 'quantity', 'subtotal', 'service_charge', 'total', 'payment_method', 'status', 'order_number']),
            'food' => $food ? $food->only(['id', 'name', 'image']) : null,
            'flash' => ['success' => 'Order placed successfully! Awaiting staff approval.']
        ]);
    }
}