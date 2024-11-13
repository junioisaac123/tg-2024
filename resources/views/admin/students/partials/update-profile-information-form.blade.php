@php
    $fields = [
        ['name' => 'first_name', 'label' => 'First name'],
        ['name' => 'last_name', 'label' => 'Last name'],
        ['name' => 'phone', 'label' => 'Phone (optional)', 'type' => 'tel', 'required' => false],
        ['name' => 'username', 'label' => 'Username'],
        ['name' => 'document', 'label' => 'No de Document (optional)', 'required' => false],
    ];
    // dd($student->toArray());
    /**
     * array:12 [▼ // resources/views/admin/students/partials/update-profile-information-form.blade.php
     * "id" => 16
     * "username" => "pollich.rusty"
     * "first_name" => "Haylee"
     * "last_name" => "Corwin"
     * "phone" => "252-263-1349"
     * "document_type" => "CC"
     * "document_number" => "5292841219561860"
     * "elo" => 0
     * "email" => "llubowitz@example.net"
     * "email_verified_at" => "2024-11-11T21:50:14.000000Z"
     * "created_at" => "2024-11-11T21:50:14.000000Z"
     * "updated_at" => "2024-11-11T21:50:14.000000Z"
     * ]
     */
@endphp

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("studentCreateForm", () => ({
            showPassword: false,
            first_name: "{{ old('first_name', $student->first_name ?? '') }}",
            last_name: "{{ old('last_name', $student->last_name ?? '') }}",
            username: "{{ old('username', $student->username ?? '') }}",
            phone: "{{ old('phone', $student->phone ?? '') }}",
            document: "{{ old('document', $student->document_number ?? '') }}",
            generateUsername() {
                if (this.first_name && this.last_name) {
                    const newUsername = (this.first_name.split(' ').join('.')) + '.' + (this
                        .last_name
                        .split(' ').join('.'));
                    // limit to 20 characters
                    this.username = newUsername.substring(0, 20);

                }
            }
        }));
    });
</script>
<section>

    <form method="POST" action="{{ $actionRoute ?? route('admin.students.store') }}" class=" space-y-6"
        x-data="studentCreateForm">
        @csrf
        @method($actionMethod ?? 'post')
        <section class="grid lg:grid-cols-2 gap-6">
            @foreach ($fields as $itemField)
                <div>
                    <x-input-label for="{{ $itemField['name'] }}" :value="__($itemField['label'])" />
                    <x-text-input id="{{ $itemField['name'] }}" name="{{ $itemField['name'] }}"
                        x-model="{{ $itemField['name'] }}" type="{{ $itemField['type'] ?? 'text' }}"
                        @change="generateUsername" class="mt-1 block w-full" :value="old($itemField['name'])" :autofocus="$loop->first"
                        :required="$itemField['required'] ?? true" autocomplete="{{ $itemField['name'] }}" />
                    <x-input-error class="mt-2" :messages="$errors->get($itemField['name'])" />
                </div>
            @endforeach

            @if (isset($create_password) ? $create_password : true)
                <div>
                    <x-input-label for="password_password" :value="__('Password')" />
                    <x-text-input id="password_password" name="password"
                        x-bind:type="showPassword ? 'text' : 'password'" class="mt-1 block w-full"
                        autocomplete="password" required />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_password_confirmation" name="password_confirmation"
                        x-bind:type="showPassword ? 'text' : 'password'" class="mt-1 block w-full"
                        autocomplete="new-password" required />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" x-model="showPassword"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Show password') }}
                    </label>
                </div>
            @endif

        </section>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
