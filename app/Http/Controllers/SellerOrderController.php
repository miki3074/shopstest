<?php

namespace App\Http\Controllers;

use App\Models\SellerOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SellerOrderController extends Controller
{
    public function index()
    {

        $orders = SellerOrder::where('seller_id', auth()->id())
            ->with('items.product', 'order')
            ->latest()
            ->get();

        return Inertia::render('Seller/Orders',[
            'orders'=>$orders
        ]);

    }
}
