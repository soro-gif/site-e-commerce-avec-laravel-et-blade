<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SettingFormRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::orderBy('created_at', 'desc')->paginate(5);
        return view('settings/index', ['settings' => $settings]);
    }

    public function show($id): View
    {
        $setting = Setting::findOrFail($id);

        return view('settings/show',['setting' => $setting]);
    }
    public function create(): View
    {
        return view('settings/create');
    }

    public function edit($id): View
    {
        $setting = Setting::findOrFail($id);
        return view('settings/edit', ['setting' => $setting]);
    }

    public function store(SettingFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $setting = Setting::create($data);
        return redirect()->route('admin.setting.show', ['id' => $setting->id]);
    }

    public function update(Setting $setting, SettingFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($setting->imageUrl) {
            Storage::disk('public')->delete($setting->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $setting->update($data);

        return redirect()->route('admin.setting.show', ['id' => $setting->id]);
    }

    public function updateSpeed(Setting $setting, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $setting->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Setting $setting)
    {
            if ($setting->imageUrl) {
        Storage::disk('public')->delete($setting->imageUrl);
    }
        $setting->delete();

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