<x-app-layout>
    @section('head.scrpits')
        @vite(['resources/js/admin/students/new.js'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Student') }}
        </h2>
    </x-slot>

    <input type="hidden" name="app_name" id="app_name" value="{{ env('APP_NAME') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">

                    @include('admin.students.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
