<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Order Details</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Product Name:</strong> {{ $order->product_name }}</p>
                <p><strong>Amount:</strong> ${{ $order->amount }}</p>
                {{-- <p><strong>Order Date:</strong> {{ $order->order_date->format('d-m-Y') }}</p> --}}
                <p><strong>Order Date:</strong> {{ date('d-m-Y', strtotime($order->order_date)) }}</p>

                <p><strong>Customer Name:</strong> {{ $customer->name }}</p>
            </div>
        </div>

        <a href="{{ route('customers.orders.index', $customer->id) }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </div>
</body>
</html>
