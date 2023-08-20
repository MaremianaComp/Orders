<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Database\Eloquent\Builder;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = Order::query()
        ->orderBy('status','asc')
        ->latest()
        ->paginate(10);
        $statuses = Order::STATUSES;
        return view('orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order) {
        $statuses = Order::STATUSES;
        $current = Carbon::now()->timezone('Europe/Moscow');
        return view('orders.show', compact('order', 'statuses', 'current'));
    }  
    
    public function create() {
        return view('orders.create');
    }

    public function store(Request $request) {   
        $validated = validate($request->all(), [
            'name' => ['required', 'string', 'max:100'],    
        ]);

        $order = Order::query()->create([
            'name' => $validated['name'],
            'status' => 0,
        ]);

        return redirect()->route('orders');
    }

    public function update(Request $request, Order $order) {

        $order->update([
            'status' => 3,
        ]);
            
        return redirect()
            ->route('order.show', ['order' => $order->id]);
    }
}
