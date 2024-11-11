document.addEventListener("alpine:init", () => {
    Alpine.data("manageForm", () => ({
        checkElements: [],
        toggleCheckAll(e) {
            this.checkElements.forEach((el) => {
                el.checked = e.target.checked;
            });
        },

        deleteSelectedForms(e) {
            const target = e.target;
            const selectedFoms = this.checkElements.filter(
                (el) => el.checked,
            ).length;

            if (selectedFoms > 0) {
                // confirm if delete
                SwalFCC({
                    title: target.dataset.messageConfirm ?? "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.fetchDeleteForms(target.dataset.actionUrl, target);
                    }
                });
            } else {
                SwalFCC({
                    title: "Error",
                    text:
                        target.dataset.messageNoSeletError ??
                        "No selected elements to delete",
                    icon: "error",
                });
            }
        },

        fetchDeleteForms(actionUrl, target) {
            // get all ids of selected for
            const ids = this.checkElements
                .filter((el) => el.checked)
                .map((el) => el.dataset.questionnaireId);
            fetch(actionUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ ids: ids }),
            })
                .then((result) => {
                    return result.json();
                })
                .then((data) => {
                    console.log(data);
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
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    SwalFCC({
                        title: "Error",
                        text:
                            target.dataset.messageError ??
                            "Something went wrong!",
                        icon: "error",
                    });
                });
        },

        confirmDeleteForm(ev) {
            const target = ev.target;
            SwalFCC({
                title: target.dataset.messageConfirm ?? "Are you sure?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteQuestionnaire(target);
                }
            });
        },
        deleteQuestionnaire(target) {
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
