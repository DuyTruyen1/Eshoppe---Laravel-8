<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>{{ $data['subject'] }}</h2>
    <p>Dear {{ $data['user']->name }},</p>
    <p>{{ $data['body'] }}</p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['cartItems'] as $item)
                <tr>
                    <td>
                        @if (!empty($item['hinhanh']))
                            @foreach ($item['hinhanh'] as $image)
                                <img src="{{ asset('upload/product/' . $image) }}" alt="" width="100px">
                                @break
                            @endforeach
                        @else
                            <img src="{{ asset('upload/product/default.jpg') }}" alt="" width="100px">
                        @endif
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Cart Sub Total: ${{ $data['totalCartPrice'] }}</p>
    <p>Exo Tax: $2</p>
    <p>Shipping Cost: Free</p>
    <p>Total: ${{ $data['totalCartPrice'] + 2 }}</p>

    <p>Thank you for shopping with us!</p>
</body>
</html>
