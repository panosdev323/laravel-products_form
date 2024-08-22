<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Products</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <div class="row pt-4">
            <div class="col-12 text-danger">
                <h2 class="text-center">Add Product</h2>
            </div>
            <div class="col-12">
                <form id="productForm">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantityStock" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantityStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="itemPrice" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </form>
                <div id="responseMessage"></div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-12 text-success">
                <h2 class="text-center">Products</h2>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Quantity in stock</th>
                            <th>Price per item</th>
                            <th>Datetime submitted</th>
                            <th>Total value number</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @foreach($products as $p) 
                        <tr>
                            <td>{{$p->product_name}}</td>
                            <td>{{$p->quantity_stock}}</td>
                            <td>{{$p->item_price}}</td>
                            <td>{{$p->created_at}}</td>
                            <td>{{$p->quantity_stock * $p->item_price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
