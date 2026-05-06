<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TagFormRequest;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(5);
        return view('tags/index', ['tags' => $tags]);
    }

    public function show($id): View
    {
        $tag = Tag::findOrFail($id);

        return view('tags/show',['tag' => $tag]);
    }
    public function create(): View
    {
        return view('tags/create');
    }

    public function edit($id): View
    {
        $tag = Tag::findOrFail($id);
        return view('tags/edit', ['tag' => $tag]);
    }

    public function store(TagFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $tag = Tag::create($data);
        return redirect()->route('admin.tag.show', ['id' => $tag->id]);
    }

    public function update(Tag $tag, TagFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($tag->imageUrl) {
            Storage::disk('public')->delete($tag->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $tag->update($data);

        return redirect()->route('admin.tag.show', ['id' => $tag->id]);
    }

    public function updateSpeed(Tag $tag, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $tag->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Tag $tag)
    {
            if ($tag->imageUrl) {
        Storage::disk('public')->delete($tag->imageUrl);
    }
        $tag->delete();

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