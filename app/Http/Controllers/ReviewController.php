<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string'
        ]);

        Review::updateOrCreate(
            [
                'user_id'=>auth()->id(),
                'product_id'=>$product->id
            ],
            [
                'rating'=>$request->rating,
                'comment'=>$request->comment
            ]
        );

        return back()->with('success','Отзыв добавлен');
    }
}
