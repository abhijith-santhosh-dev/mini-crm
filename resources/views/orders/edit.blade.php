<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Order for {{ $customer->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customers.orders.update', [$customer->id, $order->id]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $order->product_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $order->amount) }}" required>
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input 
                    type="date" 
                    class="form-control" 
                    id="order_date" 
                    name="order_date" 
                    value="{{ old('order_date', is_string($order->order_date) ? date('Y-m-d', strtotime($order->order_date)) : $order->order_date->format('Y-m-d')) }}" 
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
            <a href="{{ route('customers.orders.index', $customer->id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
