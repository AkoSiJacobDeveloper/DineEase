<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function orders()
    {
        $orders = Order::select([
            'id',
            'order_number',
            'dish_name',
            'total',
            'payment_method',
            'status'
        ])
        ->with(['items.food' => function ($query) {
            $query->select('id', 'name', 'description', 'image');
        }])
        ->latest()
        ->get()
        ->map(function ($order) {
            $food = $order->items->first()?->food;
            return [
                'order_number' => $order->order_number,
                'dish_name' => $order->dish_name ?? 'Unknown Dish',
                'total' => $order->total,
                'payment_method' => $order->payment_method,
                'status' => $order->status,
                'description' => $food?->description ?? 'No description available',
                'image' => $food?->image ?? null 
            ];
        });

        return Inertia::render('AdminPage/Orders', [
            'orders' => $orders
        ]);
    }
}