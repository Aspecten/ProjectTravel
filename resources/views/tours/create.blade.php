<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Добавить тур') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Форма для добавления тура -->
                    <form action="{{ route('tours.store') }}" method="POST" class="max-w-sm mx-auto" enctype="multipart/form-data"> <!-- Загрузка файлов -->
                        @csrf <!-- Защита от CSRF -->

                        <div class="mb-5">
                            <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">Название тура:</label>
                            <input type="text" name="title" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" /> <!-- Используем классы Tailwind -->
                        </div>

                        <div class="mb-5">
                            <label for="price" class="block text-sm font-medium text-gray-900 dark:text-white">Цена:</label>
                            <input type="number" step="0.01" name="price" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <div class="mb-5">
                            <label for="highlights" class="block text-sm font-medium text-gray-900 dark:text-white">Основные данные:</label>
                            <textarea name="highlights" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-5">
                            <label for="description" class="block text-sm font-medium text-gray-900 dark:text-white">Полное описание:</label>
                            <textarea name="description" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-5">
                            <label for="country" class="block text-sm font-medium text-gray-900 dark:text-white">Страна:</label>
                            <input type="text" name="country" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <div class="mb-5">
                            <label for="city" class="block text-sm font-medium text-gray-900 dark:text-white">Город:</label>
                            <input type="text" name="city" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <div class="mb-5">
                            <label for="hotel_name" class="block text-sm font-medium text-gray-900 dark:text-white">Отель:</label>
                            <input type="text" name="hotel_name" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <div class="mb-5">
                            <label for="image" class="block text-sm font-medium text-gray-900 dark:text-white">Фото тура:</label>
                            <input type="file" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <button type="submit" class="btn btn-success">Создать тур</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
