<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        // Загружаем пользователей вместе с их ролями через Spatie
        return Inertia::render('Admin/Users/Index', [
            'users' => User::with('roles')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        // Защита главного админа
        if ($user->email === 'miki23074@gmail.com') {
            return back()->with('error', 'Нельзя менять роль супер-админу');
        }

        $request->validate([
            'role' => 'required|in:seller,buyer'
        ]);

        // Spatie метод syncRoles удаляет старые роли и назначает новую
        $user->syncRoles($request->role);

        return back();
    }
}
