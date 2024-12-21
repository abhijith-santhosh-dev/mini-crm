<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Customer $customer)
    {
        $orders = $customer->orders()->paginate(10); 
        return view('orders.index', compact('orders', 'customer'));
    }

    public function create(Customer $customer)
    {
        return view('orders.create', compact('customer')); 
    }

    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'order_date' => 'required|date',
            'product_name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);

        $customer->orders()->create($request->all());

        return redirect()->route('customers.orders.index', $customer->id)->with('success', 'Order created successfully.');
    }

    public function show(Customer $customer, Order $order)
    {
        return view('orders.show', compact('order', 'customer')); 
    }


    public function edit(Customer $customer, Order $order)
    {
        return view('orders.edit', compact('order', 'customer')); 
    }


   
    public function update(Request $request, Customer $customer, Order $order)
    {
        $request->validate([
            'order_date' => 'required|date',
            'product_name' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);

        $order->update($request->all());

        return redirect()->route('customers.orders.index', $customer->id)->with('success', 'Order updated successfully.');
    }

    public function destroy(Customer $customer, Order $order)
    {
        $order->delete();

        return redirect()->route('customers.orders.index', $customer->id)->with('success', 'Order deleted successfully.');
    }
}
