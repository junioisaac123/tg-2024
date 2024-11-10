document.addEventListener("alpine:init", () => {
    Alpine.data("manageForm", () => ({
        checkElements: [],
        toggleCheckAll(e) {
            this.checkElements.forEach((el) => {
                el.checked = e.target.checked;
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
