<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Orders for {{ $customer->name }}</h1>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to Customers</a>
        </div>

        @if($orders->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>No orders found for this customer.</strong>
            </div>
            <!-- Button to create a new order -->
            <div class="text-center">
                <a href="{{ route('customers.orders.create', $customer->id) }}" class="btn btn-success btn-lg">Create New Order</a>
            </div>
        @else
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Order List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>${{ number_format($order->amount, 2) }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('customers.orders.show', ['customer' => $customer->id, 'order' => $order->id]) }}" 
                                           class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('customers.orders.edit', ['customer' => $customer->id, 'order' => $order->id]) }}" 
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('customers.orders.destroy', ['customer' => $customer->id, 'order' => $order->id]) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav>
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
