<x-app-layout>
    @section('head.scrpits')
        @vite(['resources/js/admin/students/index.js', 'resources/css/modules/table-responsive.css'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Students') }}
        </h2>
    </x-slot>
    <input type="hidden" name="app_name" id="app_name" value="{{ env('APP_NAME') }}">
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 dark:text-gray-100">
                    @include('admin.students.components.students-table')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
