@extends('layouts.app')
@section('content')  
<h1>Order List</h1>
<h4 class="text-center"><strong>Grand total: </strong>${{$cart->total}}</h4>
<div class="text-center">
    <form method="POST" action="{{route('orders.store')}}" class="d-inline">
        @csrf
        <button class="btn btn-success" type="submit">Confirm Order</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($cart->products as $product)
            <tr>
                <td>
                    <img src="{{asset($product->images->first()->path)}}" alt="" height="100"> {{$product->title}}</td>
                <td>${{$product->price}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>${{$product->total}}</td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
