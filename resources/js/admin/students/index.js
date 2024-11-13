document.addEventListener("alpine:init", () => {
    Alpine.data("manageForm", () => ({
        checkElements: [],
        toggleCheckAll(e) {
            this.checkElements.forEach((el) => {
                el.checked = e.target.checked;
            });
        },

        confirmDeleteStudent(ev) {
            const target = ev.target;
            SwalFCC({
                title: target.dataset.messageConfirm ?? "Are you sure?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteStudent(target);
                }
            });
        },

        deleteStudent(target) {
            const actionUrl = target.dataset.actionUrl;

            fetch(actionUrl, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((result) => {
                    return result.json();
                })
                .then((data) => {
                    if (data.success) {
                        SwalFCC({
                            title: "Ok",
                            text: data.message,
                            icon: "success",
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        SwalFCC({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                })
                .catch((error) => {
                    window.Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
        },

        init() {
            this.checkElements = Array.from(
                this.$refs.tableBody.querySelectorAll("input[type=checkbox]"),
            );
            this.checkElements.forEach((el) => {
                el.addEventListener("change", () => {
                    if (!el.checked) {
                        if (this.$refs.checkboxTop.checked) {
                            this.$refs.checkboxTop.checked = false;
                        }
                    }
                });
            });
        },
    }));
});
