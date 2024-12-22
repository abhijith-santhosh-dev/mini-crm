<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* General Reset and Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin-top: 50px;
        }

        /* Header Styling */
        .container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0d6efd;
        }

        /* Card Header Styling */
        .card-header {
            background-color: #ffffff;
            border-bottom: 2px solid #ddd;
            padding: 15px;
        }

        .card-header h4 {
            font-size: 1.75rem;
            color: #333;
            font-weight: 600;
        }

        /* Search Bar Styling */
        .search-bar .form-control {
            width: 80%;
            border-radius: 50px;
            padding: 12px 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar button {
            border-radius: 50px;
            background-color: #0d6efd;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        /* Table Styling */
        .table {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            border-collapse: separate;
            width: 100%;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: center;
            font-size: 1rem;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Button Styling */
        .btn {
            border-radius: 50px;
            padding: 8px 15px;
            transition: transform 0.2s, background-color 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        /* Actions Buttons Styling */
        .actions-btns .btn {
            margin: 5px 0;
        }

        /* Pagination Styling */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item .page-link {
            border-radius: 50px;
            padding: 10px 15px;
            background-color: #f8f9fa;
            color: #0d6efd;
            font-weight: 600;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: white;
        }

        /* Hover Effects */
        .table .btn {
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .table .btn:hover {
            opacity: 1;
        }

        /* Notifications */
        .alert {
            border-radius: 10px;
            padding: 15px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Customer List</h1>
            <a href="{{ route('customers.create') }}" class="btn btn-success btn-lg">Add New Customer</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Manage Customers</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('customers.index') }}" class="search-bar mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </div>
                </form>

                @if($customers->isEmpty())
                    <p class="text-center">No customers found.</p>
                @else
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Total Orders</th>
                                <th>Total Order Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->orders->count() }}</td>
                                    <td>${{ $customer->orders->sum('amount') }}</td>
                                    <td class="actions-btns">
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('customers.orders.index', $customer->id) }}" class="btn btn-success btn-sm">Orders</a>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-3">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
