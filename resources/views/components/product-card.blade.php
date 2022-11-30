<div class="card">
    <img class="card-image-top" src="{{ asset($product->images()->first()->path) }}" alt="" height="500px">
    <div class="card-body">
        <h4 class="text-end"><strong>${{ $product->price}}</strong></h4>
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{$product->stock}} left</strong></p>

        @if(isset($cart))
        <p>Quantity: <strong>{{$product->pivot->quantity}}</strong> (${{$product->total}})</p>
        <form class="d-inline" method="POST" action="{{ route('products.carts.destroy', ['product' => $product->id, 'cart' => $cart->id]) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Remove from cart</button>
        </form>
        @else
        <form class="d-inline" method="POST" action="{{ route('products.carts.store', ['product' => $product->id]) }}">
            @csrf
            <button class="btn btn-success">Add to cart</button>
        </form>
        @endif
    </div>
</div>