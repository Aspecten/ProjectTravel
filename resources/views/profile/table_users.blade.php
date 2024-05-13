<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;justify-content: space-between; ">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Пользователи') }}
            </h2>
            <p class="text-slate-500">
                <a href="{{ route('users.create') }}" class="btn btn-success">Добавить пользователя</a>
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
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Электронная почта</th>
                                <th>Дата создания</th>
                                <th>Роль</th> <!-- Новый столбец для роли -->
                                <th>Действия</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td> <!-- Выводим роли пользователя -->
                                    <td>
                                        <p style="display: ruby">
                                        {{-- Кнопка смены роли --}}
                                            @if(auth()->check() && auth()->user()->hasAnyRole(['admin'])) <a href="{{ route('users.editRoles', $user->id) }}" class="btn btn-primary btn-sm">
                                                <img title="Роли" width="15px" height="15px" src="https://cdn.icon-icons.com/icons2/4072/PNG/512/multimedia_option_change_exchange_random_arrows_shuffle_icon_258796.png" alt="">
                                            </a>
                                            @endif
                                        <!-- Кнопка для редактирования -->
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><img title=" Редактировать" width="15px" height="15px" src="https://cdn.icon-icons.com/icons2/1572/PNG/512/3592869-compose-create-edit-edit-file-office-pencil-writing-creative_107746.png"></a>

                                            <!-- Кнопка для удаления -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')"><img title="Удалить" width="15px" height="15px" src="https://cdn.icon-icons.com/icons2/1808/PNG/512/trash-can_115312.png"></button>
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
    </div>
</x-app-layout>
