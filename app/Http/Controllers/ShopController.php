<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{

    public function index(Request $request)
    {

        $query = Product::with('category','user')
            ->where('stock','>',0);

        if($request->search){
            $query->where('name','like',"%{$request->search}%");
        }

        if($request->category){
            $query->where('category_id',$request->category);
        }

        if($request->price_from){
            $query->where('price','>=',$request->price_from);
        }

        if($request->price_to){
            $query->where('price','<=',$request->price_to);
        }

        switch($request->sort){

            case 'cheap':
                $query->orderBy('price','asc');
                break;

            case 'expensive':
                $query->orderBy('price','desc');
                break;

            case 'new':
                $query->latest();
                break;

            default:
                $query->latest();

        }

        $products = $query->paginate(16)->withQueryString();

        $categories = Category::all();

        return Inertia::render('Shop/Home',[
            'products'=>$products,
            'categories'=>$categories,
            'filters'=>$request->all()
        ]);

    }


    public function search(Request $request)
    {

        $products = Product::where('name','like',"%{$request->q}%")
            ->limit(5)
            ->pluck('name');

        return response()->json($products);

    }

}
