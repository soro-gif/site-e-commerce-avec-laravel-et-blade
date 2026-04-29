<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CollectionFormRequest;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function index(): View
    {
        $collections = Collection::orderBy('created_at', 'desc')->paginate(5);
        return view('collections/index', ['collections' => $collections]);
    }

    public function show($id): View
    {
        $collection = Collection::findOrFail($id);

        return view('collections/show',['collection' => $collection]);
    }
    public function create(): View
    {
        return view('collections/create');
    }

    public function edit($id): View
    {
        $collection = Collection::findOrFail($id);
        return view('collections/edit', ['collection' => $collection]);
    }

    public function store(CollectionFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $collection = Collection::create($data);
        return redirect()->route('admin.collection.show', ['id' => $collection->id]);
    }

    public function update(Collection $collection, CollectionFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($collection->imageUrl) {
            Storage::disk('public')->delete($collection->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $collection->update($data);

        return redirect()->route('admin.collection.show', ['id' => $collection->id]);
    }

    public function updateSpeed(Collection $collection, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $collection->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Collection $collection)
    {
            if ($collection->imageUrl) {
        Storage::disk('public')->delete($collection->imageUrl);
    }
        $collection->delete();

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