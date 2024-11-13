<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Allowed forms') }}
        </h2>
    </x-slot>
    <input type="hidden" name="app_name" id="app_name" value="{{ env('APP_NAME') }}">
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (empty($allowedForms))
                <div class="text-center text-grey-600 dark:text-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
                    <p>{{ __('no forms') }}</p>
                </div>
            @else
                <div class="grid gap-4 grid-cols-[repeat(auto-fill,_minmax(300px,_1fr))]">
                    @foreach ($allowedForms as $aForm)
                        <div
                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $aForm->title }}
                                </h5>
                                @if (isset($aForm->category))
                                    <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ $aForm->category->text }}
                                    </span>
                                @endif
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $aForm->description ?? '' }}
                            </p>
                            <a href="{{ route('answers.show.form', $aForm->id) }}"
                                class="ml-auto inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ __('Reply') }}
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 dark:text-gray-100">
                    {{-- @include('admin.users.components.user-table') --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
