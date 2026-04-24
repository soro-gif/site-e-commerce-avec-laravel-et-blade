<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BannerFormRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(5);
        return view('banners/index', ['banners' => $banners]);
    }

    public function show($id): View
    {
        $banner = Banner::findOrFail($id);

        return view('banners/show',['banner' => $banner]);
    }
    public function create(): View
    {
        return view('banners/create');
    }

    public function edit($id): View
    {
        $banner = Banner::findOrFail($id);
        return view('banners/edit', ['banner' => $banner]);
    }

    public function store(BannerFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $banner = Banner::create($data);
        return redirect()->route('admin.banner.show', ['id' => $banner->id]);
    }

    public function update(Banner $banner, BannerFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($banner->imageUrl) {
            Storage::disk('public')->delete($banner->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $banner->update($data);

        return redirect()->route('admin.banner.show', ['id' => $banner->id]);
    }

    public function updateSpeed(Banner $banner, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $banner->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Banner $banner)
    {
            if ($banner->imageUrl) {
        Storage::disk('public')->delete($banner->imageUrl);
    }
        $banner->delete();

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