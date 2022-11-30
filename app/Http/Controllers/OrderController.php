<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\CartService;

class OrderController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getCookie();
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()->back()->withErrors('Your cart is empty');
        }

        return view('orders.create')->with([
            'cart' => $cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();
        $order = $user->orders()->create([
            'status' => 'pending'
        ]);

        $cart = $this->cartService->getCookie();
        $cartProductWithQuantity = $cart->products
            ->mapWithKeys(function ($product) {
                $element[$product->id] = ['quantity' => $product->pivot->quantity];
                return $element;
            });
        $order->products()->attach($cartProductWithQuantity->toArray());

        return redirect()->route('orders.payments.create', ['order' => $order->id]);
    }
}
