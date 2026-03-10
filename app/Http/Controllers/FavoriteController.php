<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
class FavoriteController extends Controller
{

    public function toggle(Product $product)
    {

        $user = auth()->user();

        if($user->favorites()->where('product_id',$product->id)->exists()){

            $user->favorites()->detach($product->id);

        }else{

            $user->favorites()->attach($product->id);

        }

        return back();

    }


    public function index()
    {

        $products = auth()->user()
            ->favorites()
            ->with('category')
            ->paginate(12);

        return Inertia::render('Favorites/Index',[
            'products'=>$products
        ]);

    }

}
