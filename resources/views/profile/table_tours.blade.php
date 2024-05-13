<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;justify-content: space-between; ">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Туры') }}
            </h2>
            <p class="text-slate-500">
                <a href="{{ route('tours.create') }}" class="btn btn-success">Добавить тур</a>
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="content">
                        <table id="myTable" class="display"> <!-- Используем Bootstrap для стилей -->
                        <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Название тура</th>
                            <th>Цена</th>
                            <th>Страна</th>
                            <th>Город</th>
                            <th>Отель</th>
                            <th>Основные данные</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tours as $tour)
                            <tr>
                                <td><img src="{{ $tour->image_path }}" width="200px" height="100px"></td>
                                <td>{{ $tour->title }}</td>
                                <td>${{ $tour->price }}</td>
                                <td>{{ $tour->country }}</td>
                                <td>{{ $tour->city }}</td>
                                <td>{{ $tour->hotel_name }}</td>
                                <td>{{ $tour->highlights }}</td>
                                <td>
                                    <p style="display: ruby" >
                                        <!-- Кнопки действий -->
                                        <a href="{{ route('tours.edit', $tour->id) }}" class="btn btn-warning btn-sm"><img title=" Редактировать" width="15px" height="15px" src="https://cdn.icon-icons.com/icons2/1572/PNG/512/3592869-compose-create-edit-edit-file-office-pencil-writing-creative_107746.png"></a>
                                        <form action="{{ route('tours.destroy', $tour->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот тур?')"><img title="Удалить" width="15px" height="15px" src="https://cdn.icon-icons.com/icons2/1808/PNG/512/trash-can_115312.png"></button>
                                        </form>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
