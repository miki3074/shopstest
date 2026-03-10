<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // Добавили импорт
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        // Добавляем загрузку категории для списка (with('category'))
        $query = Product::with(['category', 'images'])->where('user_id', auth()->id());

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        if ($request->unit && $request->unit !== 'all') {
            $query->where('unit', $request->unit);
        }

        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Seller/Dashboard', [
            'products' => $products,
            'filters' => $request->only(['search', 'unit'])
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        // Получаем все категории из БД и передаем их во Vue
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Seller/CreateProduct', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        // Валидация всех полей, которые приходят из формы
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|in:kg,g,l,ml,pcs',
            'category_id' => 'required|exists:categories,id', // Проверка категории
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120' // Ограничение 5МБ
        ]);

        // Сохраняем первую картинку как основную (поле image в таблице products)
        $mainImagePath = null;
        if ($request->hasFile('images')) {
            $mainImagePath = $request->file('images')[0]->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => (int) $request->stock,
            'unit' => $request->unit,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'image' => $mainImagePath, // Основное фото
        ]);

        // Сохраняем все загруженные картинки в связанную таблицу (если есть связь images())
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Товар добавлен');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        // Для редактирования тоже нужны категории
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Seller/EditProduct', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Товар обновлен');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        // Удаляем основное фото из папки
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Удаляем доп. фото (связи удалятся автоматически, если в БД стоит onDelete cascade)
        foreach($product->images as $img) {
            Storage::disk('public')->delete($img->path);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Товар удален');
    }
}
