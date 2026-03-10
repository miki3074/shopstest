<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('product')->get();

        return Inertia::render('Cart/Index', [
            'carts'=>$carts
        ]);
    }

public  function add(Request $request, Product $product)
{
    // 1. Находим текущую запись в корзине для этого товара
    $cart = auth()->user()->carts()->where('product_id', $product->id)->first();

    // 2. Считаем, сколько пользователь хочет иметь в корзине (текущее + 1)
    $nextQuantity = ($cart ? $cart->quantity : 0) + 1;

    // 3. ПРОВЕРКА: Если желаемое количество больше, чем есть на складе
    if ($nextQuantity > $product->stock) {
        return back()->with('error', "Извините, на складе осталось только {$product->stock} шт.");
    }

    // 4. Добавляем или увеличиваем
    if ($cart) {
        $cart->increment('quantity');
    } else {
        auth()->user()->carts()->create([
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    return back()->with('success', 'Товар добавлен');
}

    public function update(Request $request, Cart $cart)
    {
        // Проверка прав (вместо authorize, если не создавал Policy)
        if ($cart->user_id !== auth()->id()) abort(403);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // ПРОВЕРКА: Сравниваем новое количество с остатком товара
        // Подгружаем товар, чтобы узнать его stock
        $product = $cart->product;

        if ($request->quantity > $product->stock) {
            return back()->with('error', "Максимально доступно: {$product->stock} шт.");
        }

        $cart->update(['quantity' => $request->quantity]);

        return back();
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);
        $cart->delete();
        return back();
    }
}
