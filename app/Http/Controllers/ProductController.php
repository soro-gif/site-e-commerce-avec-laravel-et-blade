<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('products/index', ['products' => $products]);
    }

    public function show($id): View
    {
        $product = Product::findOrFail($id);

        return view('products/show',['product' => $product]);
    }
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products/create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('products/edit', ['product' => $product, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(ProductFormRequest $req ): RedirectResponse
    {
        $categories = $req->validated('categories');
        $tags = $req->validated('tags');
        $data = $req->validated();
    
            if ($req->hasFile('imageUrls')) {
        $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
    }

        $product = Product::create($data);
        if($tags){
            $product->tags()->sync($tags);
        }
        $product->categories()->sync($categories);
        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $data = $req->validated();
        $tags = $req->validated('tags');
        
        if($tags){
            $product->tags()->sync($tags);
        }
        $categories = $req->validated('categories');
         $product->categories()->sync($categories);
            if ($req->hasFile('imageUrls')) {
        $uploadedImages = $this->handleImageUpload($req->file('imageUrls'));
        // Suppression des anciennes images s'il en existe
        $oldImages = $product->imageUrls();
        if (!empty($oldImages)) {
            foreach ($oldImages as $imageUrl) {
                Storage::disk('public')->delete($imageUrl);
            }
        }
        $data['imageUrls'] = json_encode($uploadedImages);
    }

        $product->update($data);
        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function updateSpeed(Product $product, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $product->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Product $product)
    {
        $images = $product->imageUrls();
        if (!empty($images)) {
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        $product->delete();

        return [
            'isSuccess' => true
        ];
    }

        private function handleImageUpload(\Illuminate\Http\UploadedFile|array $images): string|array
    {
        if (is_array($images)) {
            $uploadedImages = [];
            foreach ($images as $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName, 'public');
                $uploadedImages[] = 'images/' . $imageName;
            }
            return $uploadedImages;
        } else {
            $imageName = uniqid() . '_' . $images->getClientOriginalName();
            $images->storeAs('images', $imageName, 'public');
            return 'images/' . $imageName;
        }
    }
}