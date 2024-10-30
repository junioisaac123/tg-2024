document.addEventListener("alpine:init", () => {
    Alpine.data("managePermission", () => ({
        showModal: false,
        waitingResponse: false,
        petitionUrl: null,

        showCreateModal() {
            this.$refs.permissionForm.reset();
            const actionToExecute = this.$refs.permissionForm.getAttribute(
                "data-create-action-url",
            );
            this.$refs.permissionForm.setAttribute("action", actionToExecute);
            this.$refs.permissionForm.setAttribute("method", "POST");
            this.$refs.permissionForm.setAttribute(
                "data-ok-message",
                this.$refs.permissionForm.getAttribute(
                    "data-create-ok-message",
                ),
            );
            this.$refs.permissionForm.setAttribute(
                "data-error-message",
                this.$refs.permissionForm.getAttribute(
                    "data-create-error-message",
                ),
            );

            this.openModal();
        },

        showEditModal(ev) {
            this.$refs.permissionForm.reset();

            const target = ev.target;
            const name = target.getAttribute("data-permission-name");
            const id = target.getAttribute("data-permission-id");
            const guardName = target.getAttribute("data-permission-guard-name");
            this.$refs.permissionForm.name.value = name;
            this.$refs.permissionForm.id.value = id;
            this.$refs.permissionForm.guard_name.value = guardName;

            let actionToExecute = this.$refs.permissionForm.getAttribute(
                "data-edit-action-url",
            );
            actionToExecute = actionToExecute.replace(":id", id);
            this.$refs.permissionForm.setAttribute("action", actionToExecute);
            this.$refs.permissionForm.setAttribute("method", "PATCH");
            this.$refs.permissionForm.setAttribute(
                "data-ok-message",
                this.$refs.permissionForm.getAttribute("data-edit-ok-message"),
            );
            this.$refs.permissionForm.setAttribute(
                "data-error-message",
                this.$refs.permissionForm.getAttribute(
                    "data-edit-error-message",
                ),
            );

            this.openModal();
        },

        openModal() {
            this.showModal = true;
            document.body.style.overflow = "hidden";
        },
        closeModal() {
            this.showModal = false;
            document.body.style.overflow = "auto";
        },

        runAction(ev) {
            const actionUrl = ev.target.getAttribute("action");
            const actionMethod = ev.target.getAttribute("method");
            const okMessage = ev.target.getAttribute("data-ok-message");
            const errorMessage = ev.target.getAttribute("data-error-message");
            this.waitingResponse = true;
            const dataForm = new FormData(ev.target);
            const data = Object.fromEntries(dataForm.entries());
            console.log(data);
            fetch(actionUrl, {
                method: actionMethod,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((result) => {
                    if (result.ok) {
                        window.Swal.fire(
                            "¡Success!",
                            okMessage || "Acción realizada con éxito.",
                            "success",
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        window.Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: errorMessage || "Something went wrong!",
                        });
                    }
                })
                .catch((error) => {
                    window.Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: error.message || "Something went wrong!-",
                    });
                })
                .finally(() => {
                    this.waitingResponse = false;
                });
        },

        deletePermission(ev) {
            const target = ev.target;
            const permissionActionUrl = target.getAttribute("data-action-url");
            Swal.fire({
                title: "¿Estas seguro de eliminar este permiso?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, bórralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deletePetition(permissionActionUrl);
                }
            });
        },

        deletePetition(action_url) {
            fetch(action_url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((result) => {
                    if (result.ok) {
                        window.Swal.fire(
                            "¡Eliminado!",
                            "El Permiso ha sido eliminado.",
                            "success",
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        console.log(result);
                        window.Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    window.Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: error.message || "Something went wrong!-",
                    });
                });
        },
    }));
});
