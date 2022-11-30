@extends('layouts.app')
@section('content')  
<h1>Payment Details</h1>
<h4 class="text-center"><strong>Grand total: </strong>${{$order->total}}</h4>
<div class="text-center">
    <form method="POST" action="{{route('orders.payments.store', ['order' => $order->id])}}" class="d-inline">
        @csrf
        <button class="btn btn-success" type="submit">Pay Order</button>
    </form>
</div>
@endsection
