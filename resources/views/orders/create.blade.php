<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Create Order for {{ $customer->name }}</h1>
            <a href="{{ route('customers.orders.index', $customer->id) }}" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Order Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('customers.orders.store', $customer->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="amount" class="form-label">Order Amount</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control" placeholder="Enter order amount" required>
                    </div>

                    <div class="mb-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" name="order_date" id="order_date" class="form-control" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
