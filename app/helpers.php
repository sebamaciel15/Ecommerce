<?php

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($produc_id, $color_id = null, $size_id = null)
{
    $product = Product::find($produc_id);

    if ($size_id) {
        $size = Size::find($size_id);

        $quantity = $size->colors->find($color_id)->pivot->quantity;
    } elseif ($color_id) {

        $quantity = $product->colors->find($color_id)->pivot->quantity;
    } else {
        $quantity = $product->quantity;
    }

    return $quantity;
}

function qty_added($produc_id, $color_id = null, $size_id = null)
{
    $cart = Cart::content();

    $item = $cart->where('id', $produc_id)
        ->where('options.color_id', $color_id)
        ->where('options.si_id', $size_id);

    if ($item) {
        return $item->qty;
    } else {
        return 0;
    }
}

function qty_available($produc_id, $color_id = null, $size_id = null)
{
    return quantity($produc_id, $color_id, $size_id) - qty_added($produc_id, $color_id, $size_id);
}
