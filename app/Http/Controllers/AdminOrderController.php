<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AdminOrderController extends Controller
{
    public function orders()
    {
        $orders = Order::select([
            'id',
            'order_number',
            'total',
            'payment_method',
            'status',
            'food_id',
            'user_id'
        ])
        ->with([
            'food' => function ($query) {
                $query->select('id', 'name', 'description', 'image');
            },
            'user' => function ($query) {
                $query->select('id', 'email');
            }
        ])
        ->latest()
        ->get()
        ->map(function ($order) {
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'dish_name' => $order->food ? $order->food->name : 'Unknown Dish',
                'total' => $order->total,
                'payment_method' => $order->payment_method,
                'status' => $order->status,
                'description' => $order->food ? $order->food->description : 'No description available',
                'image' => $order->food ? $order->food->image : null,
                'user_email' => $order->user ? $order->user->email : 'Unknown User'
            ];
        });

        return Inertia::render('AdminPage/Orders', [
            'orders' => $orders
        ]);
    }

    public function confirm(Request $request, Order $order): RedirectResponse
    {
        Log::info('Confirming order:', ['id' => $order->id, 'current_status' => $order->status]);

        if ($order->status !== Order::STATUS_PENDING) {
            Log::warning('Order confirmation failed: not pending', ['id' => $order->id, 'status' => $order->status]);
            return redirect()->back()->with('error', 'Order can only be confirmed if pending');
        }

        $order->update(['status' => Order::STATUS_COMPLETED]);
        Log::info('Order confirmed:', ['id' => $order->id, 'new_status' => $order->status]);

        return redirect()->back()->with('success', 'Order confirmed successfully');
    }

    public function reject(Request $request, Order $order): RedirectResponse
    {
        Log::info('Rejecting order:', ['id' => $order->id, 'current_status' => $order->status]);

        if ($order->status !== Order::STATUS_PENDING) {
            Log::warning('Order rejection failed: not pending', ['id' => $order->id, 'status' => $order->status]);
            return redirect()->back()->with('error', 'Order can only be rejected if pending');
        }

        $order->update(['status' => Order::STATUS_CANCELLED]);
        Log::info('Order rejected:', ['id' => $order->id, 'new_status' => $order->status]);

        return redirect()->back()->with('success', 'Order rejected successfully');
    }
}