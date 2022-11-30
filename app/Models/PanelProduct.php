<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class PanelProduct extends Product
{
    use HasFactory;

    protected static function booted()
    {
        // static::addGlobalScope(new AvailableScope);
    }
}
