document.querySelectorAll("textarea").forEach(function (textarea) {
    textarea.style.height = textarea.scrollHeight + "px";
    textarea.style.overflowY = "hidden";

    textarea.addEventListener("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
});

document.addEventListener("alpine:init", () => {
    Alpine.data("questionnaireForm", () => ({
        questions: [],
        addQuestion() {
            this.questions.push({
                title: "",
                type: "input",
                options: [],
                is_required: true,
                hasScore: false,
                image: null,
                previewImage: null,
            });
        },
        removeQuestion(index) {
            this.questions.splice(index, 1);
        },
        addOption(questionIndex) {
            this.questions[questionIndex].options.push({
                text: "",
                score: null,
            });
        },
        removeOption(questionIndex, optionIndex) {
            this.questions[questionIndex].options.splice(optionIndex, 1);
        },
        handleImageUpload(event, questionIndex) {
            const file = event.target.files[0];
            this.questions[questionIndex].image = file;

            // Mostrar previsualización de la imagen
            const reader = new FileReader();
            reader.onload = (e) => {
                this.questions[questionIndex].previewImage = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        submitForm() {
            // Aquí se procesaría el formulario para enviar la información al backend
            console.log(this.questions);
        },
    }));
});
