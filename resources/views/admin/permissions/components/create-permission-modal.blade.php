<div tabindex="-1"
    class="overflow-y-auto overflow-x-hidden fixed inset-0 z-[51] flex justify-center items-center flex-col max-h-full"
    x-show="showModal" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
    <div class="relative p-4 w-full max-w-md max-h-full">
        {{-- Modal header --}}
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            {{-- Modal header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('Create New Permission') }}
                </h3>
                <button type="button" @click="closeModal"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            {{-- Modal body --}}
            <div class="p-4 md:p-5">
                <form class="grid gap-4" data-edit-action-url="{{ route('admin.permissions.update', ':id') }}"
                    data-create-action-url="{{ route('admin.permissions.store') }}"
                    data-create-ok-message="{{ __('Permission created successfully') }}"
                    data-create-error-message="{{ __('Something went wrong. Please try again later.') }}"
                    data-edit-ok-message="{{ __('Permission updated successfully') }}"
                    data-edit-error-message="{{ __('Something went wrong. Please try again later.') }}"
                    @submit.prevent="runAction" x-ref="permissionForm">
                    <input type="hidden" name="id">
                    <label class="">
                        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Permission name') }}
                        </span>
                        <input type="text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="blog.create" required />
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Use the route name syntax to create a permission') }}.
                            {{ __('For example:') }}
                            <code>
                                <span class="font-medium text-blue-600 dark:text-blue-500">admin.users.*</span>
                            </code>
                        </p>
                    </label>

                    <label>
                        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Guard name') }}
                        </span>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:opacity-50"
                            name="guard_name" disabled>

                            <option value="web"> {{ __('Web') }} </option>
                        </select>
                    </label>



                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                        {{ __('Create') }}
                    </button>

                </form>
            </div>

            <div class="absolute inset-0 flex items-center justify-center backdrop-blur-[2px] backdrop-brightness-75 bg-white/30 dark:bg-gray-900/30"
                x-show="waitingResponse" x-cloack>
                <div role="status" class="">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

        </div>
    </div>
</div>

<div x-show="showModal" class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-50"></div>
