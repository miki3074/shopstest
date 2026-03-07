<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{

public function index()
{

$products = Product::where('user_id',auth()->id())->latest()->get();

return Inertia::render('Seller/Products/Index',[
'products'=>$products
]);

}

public function create()
{
return Inertia::render('Seller/Products/Create');
}

public function store(Request $request)
{

$request->validate([
'name'=>'required',
'price'=>'required',
'unit'=>'required',
'short_description'=>'required',
'image'=>'image'
]);

$image = null;

if($request->hasFile('image')){

$image = $request->file('image')->store('products','public');

}

Product::create([
'name'=>$request->name,
'price'=>$request->price,
'unit'=>$request->unit,
'short_description'=>$request->short_description,
'image'=>$image,
'user_id'=>auth()->id()
]);

return redirect()->route('seller.products');

}

}
