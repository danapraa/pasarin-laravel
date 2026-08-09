<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(private readonly ImageService $imageService)
    {
    }

    public function index(): View
    {
        $products = Product::with(['store', 'category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $stores = Store::where('status', 'approved')->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'stores'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create([
            'store_id' => $request->store_id,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'name' => $request->name,
            'slug' => $this->uniqueSlug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        foreach ($request->file('images', []) as $index => $file) {
            $path = $this->imageService->storeProductImage($file);

            $product->images()->create([
                'path' => $path,
                'is_primary' => $index === 0,
                'sort_order' => $index,
            ]);
        }

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $product->load('images');
        $categories = Category::orderBy('name')->get();
        $stores = Store::where('status', 'approved')->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'stores'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update([
            'store_id' => $request->store_id,
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'name' => $request->name,
            'slug' => $product->name === $request->name ? $product->slug : $this->uniqueSlug($request->name, $product->id),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        foreach ($request->file('images', []) as $file) {
            $path = $this->imageService->storeProductImage($file);

            $product->images()->create([
                'path' => $path,
                'is_primary' => $product->images()->count() === 0,
                'sort_order' => $product->images()->count(),
            ]);
        }

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dihapus.');
    }

    public function destroyImage(Product $product, ProductImage $image): RedirectResponse
    {
        $this->imageService->deleteProductImage($image->path);
        $image->delete();

        return back()->with('status', 'Gambar dihapus.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
