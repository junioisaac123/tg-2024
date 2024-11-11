<div class="relative shadow-md sm:rounded-lg" x-data="manageForm">
    <div
        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div class="relative" x-data="{ open: false }">
            <button id="dropdownActionButton"
                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button" @click="open = !open">
                <span class="sr-only">{{ __('Action button') }}</span>
                {{ __('Actions') }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownAction"
                class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 block absolute inset-0 top-full h-max mt-3 "
                x-show="open" x-cloak @click.away="open = false">
                <div class="py-1">
                    <a href="{{ route('admin.forms.create') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ __('Add Form') }}
                    </a>
                    <a href="#" @click="open = !open; deleteSelectedForms(event)"
                        data-message-no-selet-error="{{ __('No forms selected') }}"
                        data-message-error="{{ __('Error') }}"
                        data-message-success="{{ __('Form deleted successfully') }}"
                        data-message-confirm="{{ __('Are you sure you want to delete this form?') }}"
                        data-action-url="{{ route('admin.forms.masive-destroy') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ __('Delete form') }}
                    </a>
                </div>
            </div>
        </div>
        <label for="table-search" class="sr-only">{{ __('Search') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-forms"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Search for forms') }}">
        </div>
    </div>
    <section class="overflow-x-auto w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" x-ref="dataTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" @change="toggleCheckAll" x-ref="checkboxTop"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        {{ __('Title') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Description') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Updated at') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody x-ref="tableBody">
                @foreach ($questionnaires as $questionnaire)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    data-questionnaire-id="{{ $questionnaire->id }}">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="ps-3">
                                <div class="text-base font-semibold">
                                    {{ $questionnaire->title }}
                                </div>
                                <div class="font-normal text-gray-500">{{ $questionnaire->category->text }}</div>
                            </div>
                        </th>

                        <td class="px-6 py-4">
                            {{ $questionnaire->description }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $questionnaire->updated_at }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.forms.edit', $questionnaire->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline block"
                                data-questionnaire-id="{{ $questionnaire->id }}">
                                {{ __('Edit') }}
                            </a>
                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline block"
                                @click.prevent="confirmDeleteForm" data-id="{{ $questionnaire->id }}"
                                data-action-url="{{ route('admin.forms.destroy', $questionnaire->id) }}"
                                data-message-confirm="{{ __('Are you sure you want to delete this form?') }}">{{ __('Delete') }}</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

</div>
