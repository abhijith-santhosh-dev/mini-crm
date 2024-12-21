<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
   //display
    public function index()
    {
        $customers = Customer::with('orders')->paginate(10); 
        return view('customers.index', compact('customers'));
    }


//new create
 public function create()
{
    return view('customers.create'); 
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:customers,email',
        'phone' => 'required|numeric',
        'address' => 'required',
    ]);

    Customer::create($request->all());

    return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
}


public function show(Customer $customer)
{
    return view('customers.show', compact('customer')); 
}

public function edit(Customer $customer)
{
    return view('customers.edit', compact('customer')); 
}

public function update(Request $request, Customer $customer)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:customers,email,' . $customer->id,
        'phone' => 'required|numeric',
        'address' => 'required',
    ]);

    $customer->update($request->all());

    return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
}

public function destroy(Customer $customer)
{
    $customer->delete();

    return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
}
}
