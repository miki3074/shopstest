<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SellerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CheckoutController extends Controller
{

    public function index()
    {
        $carts = auth()->user()
            ->carts()
            ->with('product')
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return Inertia::render('Checkout/Index', [
            'carts' => $carts,
            'total' => $total
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string'
        ]);


        $carts = auth()->user()
            ->carts()
            ->with('product')
            ->get();


        if ($carts->isEmpty()) {
            return back()->with('error', 'Корзина пустая');
        }


        // Проверяем остаток товара
        foreach ($carts as $cart) {

            if ($cart->product->stock < $cart->quantity) {

                return back()->with(
                    'error',
                    'Недостаточно товара: ' . $cart->product->name
                );
            }
        }


        DB::transaction(function () use ($carts, $request) {

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });


            // создаём основной заказ
            $order = Order::create([
                'user_id' => auth()->id(),
                'address' => $request->address,
                'total' => $total,
                'payment_method' => $request->payment_method
            ]);


            // группируем товары по продавцам
            $groups = $carts->groupBy(function ($cart) {
                return $cart->product->user_id;
            });


            foreach ($groups as $sellerId => $items) {

                $sellerTotal = $items->sum(function ($cart) {
                    return $cart->product->price * $cart->quantity;
                });


                // создаём заказ продавца
                $sellerOrder = SellerOrder::create([
                    'order_id' => $order->id,
                    'seller_id' => $sellerId,
                    'total' => $sellerTotal,
                    'status' => 'new'
                ]);


                foreach ($items as $cart) {

                    // создаём товар заказа
                    OrderItem::create([
                        'order_id' => $order->id,
                        'seller_order_id' => $sellerOrder->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->product->price
                    ]);


                    // уменьшаем остаток товара
                    $cart->product->decrement('stock', $cart->quantity);

                }
            }


            // очищаем корзину
            Cart::where('user_id', auth()->id())->delete();

        });


        return redirect('/')->with('success', 'Заказ успешно оформлен');

    }
}
