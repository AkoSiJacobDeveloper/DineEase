<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function orders() {
        $orders = Order::select([
            'dish_name',
            'payment_method',
            'total',
            'order_number',
            'status',
        ])->latest()->get();

        return Inertia::render('AdminPage/Orders', [
            'orders' => $orders
        ]);
    }
}
