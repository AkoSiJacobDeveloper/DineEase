<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class BackfillDishName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:backfill-dish-name';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill dish_name for orders with null values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::whereNull('dish_name')->get();
        $count = 0;

        foreach ($orders as $order) {
            $orderItem = $order->items()->first();
            if ($orderItem && $orderItem->food) {
                $order->update(['dish_name' => $orderItem->food->name]);
                $count++;
            }
        }
        $this->info("Updated $count orders with dish_name.");
    }
}
