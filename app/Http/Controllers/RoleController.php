<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function editRoles($id)
    {
        $user = User::find($id); // Находим пользователя по ID
        $roles = Role::all(); // Получаем все доступные роли
        return view('users.edit_roles', compact('user', 'roles')); // Передаем данные в вид
    }

    public function updateRoles(Request $request, $id)
    {
        // Найдите пользователя по ID
        $user = User::findOrFail($id);

        // Получите список идентификаторов ролей из запроса
        $roleIds = $request->input('roles', []);

        // Преобразуйте идентификаторы в имена
        $roleNames = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

        // Убедитесь, что все роли действительно существуют
        if (count($roleIds) !== count($roleNames)) {
            throw new \Exception("Некоторые роли не существуют"); // Ошибка, если есть несоответствие
        }

        // Обновление ролей пользователя
        $user->syncRoles($roleNames); // Передаем список имен ролей

        // Перенаправление после успешного обновления
        return redirect()->route('table_users')->with('success', 'Роли обновлены успешно');
    }
}
