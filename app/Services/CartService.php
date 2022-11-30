<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected $cookieName = 'cart';

    public function getCookie()
    {
        $cartId = Cookie::get($this->cookieName);
        return Cart::find($cartId);
    }

    public function getCookieOrCreate()
    {
        $cart = $this->getCookie();
        return $cart ?? Cart::create();
    }

    public function createCookie(Cart $cart)
    {
        return Cookie::queue($this->cookieName, $cart->id, 7 * 24 * 60);
    }

    public function countProduct()
    {
        $cart = $this->getCookie();
        if (isset($cart)) {
            return $cart->products->pluck('pivot.quantity')->sum();
        }
        return 0;
    }
}
