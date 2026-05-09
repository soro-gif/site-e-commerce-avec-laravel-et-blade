<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SocialFormRequest;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function index(): View
    {
        $socials = Social::orderBy('created_at', 'desc')->paginate(5);
        return view('socials/index', ['socials' => $socials]);
    }

    public function show($id): View
    {
        $social = Social::findOrFail($id);

        return view('socials/show',['social' => $social]);
    }
    public function create(): View
    {
        return view('socials/create');
    }

    public function edit($id): View
    {
        $social = Social::findOrFail($id);
        return view('socials/edit', ['social' => $social]);
    }

    public function store(SocialFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $social = Social::create($data);
        return redirect()->route('admin.social.show', ['id' => $social->id]);
    }

    public function update(Social $social, SocialFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($social->imageUrl) {
            Storage::disk('public')->delete($social->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $social->update($data);

        return redirect()->route('admin.social.show', ['id' => $social->id]);
    }

    public function updateSpeed(Social $social, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $social->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Social $social)
    {
            if ($social->imageUrl) {
        Storage::disk('public')->delete($social->imageUrl);
    }
        $social->delete();

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