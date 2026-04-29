<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PageFormRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(5);
        return view('pages/index', ['pages' => $pages]);
    }

    public function show($id): View
    {
        $page = Page::findOrFail($id);

        return view('pages/show',['page' => $page]);
    }
    public function create(): View
    {
        return view('pages/create');
    }

    public function edit($id): View
    {
        $page = Page::findOrFail($id);
        return view('pages/edit', ['page' => $page]);
    }

    public function store(PageFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $page = Page::create($data);
        return redirect()->route('admin.page.show', ['id' => $page->id]);
    }

    public function update(Page $page, PageFormRequest $req)
    {
        $data = $req->validated();

        

        $page->update($data);

        return redirect()->route('admin.page.show', ['id' => $page->id]);
    }

    public function updateSpeed(Page $page, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $page->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Page $page)
    {
        
        $page->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}