<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('categories/index', ['categories' => $categories]);
    }

    public function show($id): View
    {
        $category = Category::findOrFail($id);

        return view('categories/show',['category' => $category]);
    }
    public function create(): View
    {
        return view('categories/create');
    }

    public function edit($id): View
    {
        $category = Category::findOrFail($id);
        return view('categories/edit', ['category' => $category]);
    }

    public function store(CategoryFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $category = Category::create($data);
        return redirect()->route('admin.category.show', ['id' => $category->id]);
    }

    public function update(Category $category, CategoryFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($category->imageUrl) {
            Storage::disk('public')->delete($category->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $category->update($data);

        return redirect()->route('admin.category.show', ['id' => $category->id]);
    }

    public function updateSpeed(Category $category, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $category->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Category $category)
    {
            if ($category->imageUrl) {
        Storage::disk('public')->delete($category->imageUrl);
    }
        $category->delete();

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