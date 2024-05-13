<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TourController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Таблица пользователей
Route::get('/table_users', [usercontroller::class, 'index'])->name('table_users');

Route::delete('/users/{id}', [usercontroller::class, 'destroy'])->name('users.destroy'); // Маршрут для удаления
Route::get('/users/create', [usercontroller::class, 'create'])->name('users.create');
Route::post('/users', [usercontroller::class, 'store'])->name('users.store');

Route::get('/users/{id}/edit', [usercontroller::class, 'edit'])->name('users.edit'); // Для перехода к форме редактирования
Route::put('/users/{id}', [usercontroller::class, 'update'])->name('users.update'); // Для обновления данных пользователя

Route::get('/table_users', function () {
    $users = \App\Models\User::all(); // Получаем всех пользователей
    return view('profile.table_users', ['users' => $users]); // Передаем в вид
})->name('table_users');

// Таблица Туров
Route::resource('tours', TourController::class);
Route::get('/table_tours', [TourController::class, 'index'])->name('table_tours'); // Новый маршрут с контроллером
Route::get('/tours/{id}/edit', [TourController::class, 'edit'])->name('tours.edit'); // Маршрут для формы редактирования
Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create'); // Маршрут для формы добавления тура

/*
Route::get('/table_tours', function () {
    return view('profile/table_tours');
})->name('table_tours');


Главные руты
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/table_orders', function () {
    return view('profile/table_orders');
})->name('table_orders');


Route::middleware(['auth'])->group(function() {
    Route::get('/users/{id}/edit-roles', [RoleController::class, 'editRoles'])->name('users.editRoles'); // Для получения формы редактирования
    Route::post('/users/{id}/update-roles', [RoleController::class, 'updateRoles'])->name('users.updateRoles'); // Для обновления ролей
});

Route::get('/dashboard', function () {
    $user = Auth::user(); // Получаем текущего пользователя

    if ($user->hasRole('admin')) { // Если админ
        return view('dashboard_admin'); // Перенаправляем на админский дашборд
    }
    if ($user->hasRole('manage')) { // Если админ
        return view('dashboard_manage'); // Перенаправляем на админский дашборд
    }

    return view('dashboard'); // Обычный дашборд
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
