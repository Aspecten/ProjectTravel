<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Редактировать роли пользователя') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Форма для редактирования ролей -->
                    <form action="{{ route('users.updateRoles', $user->id) }}" method="POST">
                        @csrf
                        <h3>Выберите роли для {{ $user->name }}</h3>

                        @foreach ($roles as $role)
                            <div>
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }} /> <!-- Проверяем, есть ли у пользователя эта роль -->
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Обновить роли</button> <!-- Кнопка для обновления -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
