<?php

namespace App\Http\Controllers;

use App\Models\Megacollection;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MegacollectionFormRequest;
use Illuminate\Support\Facades\Storage;

class MegacollectionController extends Controller
{
    public function index(): View
    {
        $megacollections = Megacollection::orderBy('created_at', 'desc')->paginate(5);
        return view('megacollections/index', ['megacollections' => $megacollections]);
    }

    public function show($id): View
    {
        $megacollection = Megacollection::findOrFail($id);

        return view('megacollections/show',['megacollection' => $megacollection]);
    }
    public function create(): View
    {
        return view('megacollections/create');
    }

    public function edit($id): View
    {
        $megacollection = Megacollection::findOrFail($id);
        return view('megacollections/edit', ['megacollection' => $megacollection]);
    }

    public function store(MegacollectionFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $megacollection = Megacollection::create($data);
        return redirect()->route('admin.megacollection.show', ['id' => $megacollection->id]);
    }

    public function update(Megacollection $megacollection, MegacollectionFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($megacollection->imageUrl) {
            Storage::disk('public')->delete($megacollection->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $megacollection->update($data);

        return redirect()->route('admin.megacollection.show', ['id' => $megacollection->id]);
    }

    public function updateSpeed(Megacollection $megacollection, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $megacollection->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Megacollection $megacollection)
    {
            if ($megacollection->imageUrl) {
        Storage::disk('public')->delete($megacollection->imageUrl);
    }
        $megacollection->delete();

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