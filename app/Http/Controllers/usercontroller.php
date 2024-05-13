<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get(); // Извлекаем пользователей с ролями
        return view('table_users', compact('users')); // Передаем данные в вид
    }

    public function edit($id)
    {
        $user = User::find($id); // Находим пользователя по ID
        return view('users.edit', ['user' => $user]); // Передаем данные в вид
    }

    public function update(Request $request, $id)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Игнорируем текущего пользователя
            'password' => 'nullable|min:8|confirmed', // Пароль не обязателен, но если есть, должен быть подтвержден
        ]);

        // Обновляем данные пользователя
        $user = User::find($id); // Находим пользователя
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password, // Шифрование пароля
        ]);

        return redirect()->route('table_users')->with('success', 'Пользователь обновлен успешно'); // Перенаправление с сообщением
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete(); // Удаляет пользователя
        }
        return redirect()->route('table_users'); // Возвращает к таблице пользователей
    }

    public function create()
    {
        return view('users.create'); // Возвращает вид с формой для создания пользователя
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Правильный синтаксис
            'email' => 'required|email|unique:users,email|max:255', // Правильный синтаксис
            'password' => 'required|min:8|confirmed', // Правильный синтаксис
        ]);

        // Создание нового пользователя
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Шифрование пароля
        ]);

        $user->assignRole('defuser');

        return redirect()->route('table_users'); // Перенаправление после успешного создания
    }
}
