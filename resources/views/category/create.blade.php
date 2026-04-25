<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto"> {{-- Kita buat lebih ramping agar form tidak terlalu lebar --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900 dark:text-gray-100">
                        
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold tracking-tight">Add New Category</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Create a new classification for your products.</p>
                        </div>

                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf

                            {{-- Input Nama Kategori --}}
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Category Name
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                       placeholder="e.g. Electronics, Furniture, etc."
                                       required>
                                
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Buttons --}}
                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <a href="{{ route('category.index') }}" 
                                   class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition duration-150">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition duration-150">
                                    Save Category
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>