<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['images', 'category']) // Добавили category
        ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return Inertia::render('Seller/Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $categories = Category::all()->toArray(); // <-- точно массив

        return Inertia::render('Seller/CreateProduct', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {



//        $request->validate([
//            'name' => 'required',
//            'price' => 'required|numeric',
//            'stock' => 'required|integer|min:0',
//            'unit' => 'required',
//            'description' => 'nullable', // Изменил с short_description
//            'category_id' => 'required|exists:categories,id',
//        ]);
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'unit' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);


        // Если у тебя в модели есть поле image (для главной картинки)
        $mainImage = null;
        if ($request->hasFile('images')) {
            // Берем первое изображение как основное
            $mainImage = $request->file('images')[0]->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => (int) $request->stock,
            'unit' => $request->unit,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'image' => $mainImage, // Сохраняем путь к картинке
        ]);

        // Если есть дополнительные фото (связь hasMany)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('seller.products')->with('success', 'Товар добавлен');
    }


    public function show(Product $product)
    {

        $product->load('category','user','images');

        return Inertia::render('Shop/Product',[
            'product'=>$product
        ]);

    }

}
