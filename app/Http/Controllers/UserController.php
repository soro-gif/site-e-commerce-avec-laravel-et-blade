<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('users/index', ['users' => $users]);
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);

        return view('users/show',['user' => $user]);
    }
    public function create(): View
    {
        return view('users/create');
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        return view('users/edit', ['user' => $user]);
    }

    public function store(UserFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $user = User::create($data);
        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }

    public function update(User $user, UserFormRequest $req)
    {
        $data = $req->validated();

        

        $user->update($data);

        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }

    public function updateSpeed(User $user, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $user->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(User $user)
    {
        
        $user->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}