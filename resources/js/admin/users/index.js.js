import { MD5 } from "crypto-js";
document.addEventListener("alpine:init", () => {
    Alpine.data("manageUser", () => ({
        deleteUser(ev) {
            const target = ev.target;
            const user_id = target.getAttribute("data-id");
            const user_token = target.getAttribute("data-token");
            const user_action_url = target.getAttribute("data-action-url");
            const APP_NAME = document.getElementById("app_name").value;
            if (
                !user_id ||
                !user_token ||
                user_token !== MD5(user_id + APP_NAME).toString()
            ) {
                window.Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
                return;
            }
            Swal.fire({
                title: "¿Estas seguro de eliminar este usuario?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, bórralo!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.delete(user_action_url);
                }
            });
        },
        delete(action_url) {
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
                            "El usuario ha sido eliminado.",
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
