<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.printPage.js"></script>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
    <center>
        <h1>orders Information List </h1>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Order Date') }}</th>
                <th>{{ __('Product names') }}</th>
                <th>{{ __('Notes') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Customer') }}</th>
                <th>{{ __('Phone Number') }}</th>
                <th>{{ __('Address') }}</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->products->map(function($product){
                        return $product->name_ar;
                    }) }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->customer->phone }}</td>
                    <td>{{ $order->customer->address }}</td>
                </tr>
            @endforeach
    </center>
</div>
</div>
</body>

</html>