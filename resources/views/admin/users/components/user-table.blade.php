<style>
    @media screen and (max-width: 720px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        td {
            border: none;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            position: absolute;
            left: 6px;
            content: attr(data-label);
            font-weight: bold;
        }
    }
</style>

<div class="relative  shadow-md sm:rounded-lg" x-data="manageUser">
    <div
        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div class="relative" x-data="{ open: false }">
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
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
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ __('Add User') }}
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        {{ __('Delete Users') }}
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
            <input type="text" id="table-search-users"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ __('Search for users') }}">
        </div>
    </div>
    <section class="overflow-x-auto w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('user') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('user name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('role') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('document type') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('document number') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $user->first_name }} {{ $user->last_name }}
                                </div>
                                <div class="font-normal text-gray-500">{{ $user->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->roles->isEmpty())
                                {{ __('No roles') }}
                            @endif
                            @foreach ($user->roles as $role)
                                {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->document_type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->document_number }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline block">Edit user</a>
                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline block"
                                @click="deleteUser" data-id="{{ $user->id }}"
                                data-token="{{ md5($user->id . env('APP_NAME')) }}"
                                data-action-url="{{ route('admin.users.destroy', $user->id) }}">Delete user</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

</div>
