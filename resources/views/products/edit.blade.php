@extends('layouts.app')
@section('content')
    <h1>Edit a product</h1>
    <form method="POST"
        action="{{ route('products.update', ['product' => $product->id]) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <label for="">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') ?? $product->title }}" >
        </div>
        <div class="form-row">
            <label for="">Description</label>
            <input class="form-control" type="text" name="description" value="{{ old('description') ?? $product->description }}" >
        </div>
        <div class="form-row">
            <label for="">Price</label>
            <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') ?? $product->price }}" >
        </div>
        <div class="form-row">
            <label for="">Stock</label>
            <input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') ?? $product->stock }}" >
        </div>
        <div class="form-row">
            <label for="">Status</label>
            <select class="custom-select form-control" name="status" >
                @if(!empty(old('status')))
                <option value="available" {{ old('status') === 'available' ? 'selected' : ''}}>
                    Available
                </option>
                <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : ''}}>
                    Unavailable
                </option>
                @else
                <option value="available" {{$product->status === 'available' ? 'selected' : ''}}>
                    Available
                </option>
                <option value="unavailable" {{$product->status === 'unavailable' ? 'selected' : ''}}>
                    Unavailable
                </option>
                @endif
            </select>
        </div>
        <div class="form-row">
            <label for="images">{{ __('Product Images') }}</label>
            <input class="form-control" name="images[]" type="file" accept="image/*" multiple>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-lg mt-3">Update Product</button>
        </div>
    </form>
@endsection