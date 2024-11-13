<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("studentDeleteForm", () => ({

            deelteAccount() {
                SwalFCC({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('Do you really want to delete your account?') }}",
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            },
            submit() {
                fetch("{{ route('admin.students.destroy', $student->id) }}", {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    }).then((result) => {
                        return result.json();
                    })
                    .then((data) => {
                        if (data.success) {
                            SwalFCC({
                                title: "Ok",
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                // goto admin.forms.index
                                window.location.href =
                                    "{{ route('admin.students.index') }}";
                            });
                        } else {
                            SwalFCC({
                                title: "Error",
                                text: data.message,
                                icon: "error",
                            })
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        SwalFCC({
                            title: "Error",
                            text: "{{ __('Something went wrong') }}",
                            icon: "error",
                        })
                    })
            }
        }));
    });
</script>

<section class="space-y-6" x-data="studentDeleteForm">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button x-on:click="deelteAccount">{{ __('Delete Account') }}</x-danger-button>

</section>
