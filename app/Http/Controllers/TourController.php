<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        // Получаем все туры
        $tours = Tour::all(); // Или Tour::paginate(10), если хотите добавить пагинацию

        // Возвращаем вид с данными о турах
        return view('profile.table_tours', compact('tours'));
    }

    public function create()
    {
        return view('tours.create'); // Возвращает вид с формой для добавления тура
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'highlights' => 'required|string',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'hotel_name' => 'required|string|max:255',
            'image' => 'nullable|image', // Проверяем, что файл является изображением
        ]);

        // Сохранение файла изображения, если загружен
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images/tours', 'public'); // Сохраняем изображение
        }

        // Создание нового тура
        Tour::create($validated);

        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id); // Находим тур по ID
        return view('tours.edit', compact('tour')); // Возвращаем вид с данными тура
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'highlights' => 'required|string',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'hotel_name' => 'required|string|max:255',
            'image_path' => 'nullable|string',
        ]);

        $tour = Tour::find($id);
        $tour->update($request->all());

        return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
    }

    public function destroy($id)
    {
        Tour::destroy($id);

        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
