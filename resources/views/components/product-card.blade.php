<div class="card">
    {{-- Image Carousel --}}
    <div class="carousel slide carousel-fade" id="carousel{{ $product->id }}">
        <div class="carousel-inner">
        @foreach($product->images as $image)
        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
            <img class="d-block w-100 card-image-top" src="{{ asset($image->path) }}" alt="" height="500px">
        </div>
        @endforeach
        </div>
        {{-- Carousel link previous --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        {{-- Carousel link next --}}
        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$product->id}}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>     
    </div>
    {{-- End Image Carousel --}}
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
