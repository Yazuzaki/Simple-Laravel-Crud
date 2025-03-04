<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <br>
                    <a href="{{ route('product.index') }}" class="inline-block mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-950 transition duration-200">
                        Product Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
