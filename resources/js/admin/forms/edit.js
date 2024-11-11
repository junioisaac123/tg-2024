document.querySelectorAll("textarea").forEach(function (textarea) {
    textarea.style.height = textarea.scrollHeight + "px";
    textarea.style.overflowY = "hidden";

    textarea.addEventListener("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
});

document.addEventListener("alpine:init", () => {
    Alpine.data("questionnaireFormEdit", (dataToInit) => ({
        fId: dataToInit.id ?? null,
        fTitle: dataToInit.title ?? "",
        fDescription: dataToInit.description ?? "",
        fCategoryId: dataToInit.questionnaire_category_id ?? null,
        fRatingMode: dataToInit.rating_mode ?? "off",

        questions: [
            // ...(dataToInit.questions ?? []).map((question) => ({
            //     ...question,
            // })),
            ...(dataToInit.questions ?? []).map((question) => {
                const questionObj = {
                    ...question,
                };
                const rattingMode = dataToInit.rating_mode ?? "off";
                if (rattingMode == "checks") {
                    questionObj.options.map((option) => {
                        option.checkScore = option.score;
                    });
                }
                return questionObj;
            }),
        ],
        addQuestion() {
            const newQuestion = {
                title: "",
                description: "",
                image: null,
                is_required: true,
                type: "input",
                options: [],
                previewImage: null,
            };
            if (this.fRatingMode == "scores") {
                const baeModes = [
                    "Casi siempre",
                    "Algunas veces",
                    "Rara vez",
                    "Nunca",
                ];
                for (let i = 0; i < 4; i++) {
                    newQuestion.options.push({
                        text: baeModes[i],
                        checkScore: 0,
                        score: i + 1,
                        editable: false,
                    });
                }
            }
            this.questions.push(newQuestion);
        },
        toggleOptionScore(questionIndex, optionIndex, ev) {
            this.questions[questionIndex].options[optionIndex].checkScore = ev
                .target.checked
                ? 1
                : 0;
        },
        removeQuestion(index) {
            this.questions.splice(index, 1);
        },
        addOption(questionIndex) {
            this.questions[questionIndex].options.push({
                text: "",
                checkScore: 0,
                score: this.fRatingMode != "off" ? 0 : null,
                editable: true,
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
            // const jsonFormData = {
            //     title: this.fTitle,
            //     description: this.fDescription,
            //     category_id: this.fCategoryId,
            //     rating_mode: this.fRatingMode,
            //     questions: this.questions,
            // };
            const formData = new FormData(this.$refs.questionnaireForm);
            const actionUrl = this.$refs.questionnaireForm.action;
            fetch(actionUrl, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: formData,
            })
                .then((result) => {
                    return result.json();
                })
                .then((data) => {
                    if (data.success) {
                        window.Swal.fire({
                            title: "Ok",
                            text: data.message,
                            icon: "success",
                        }).then(() => {
                            window.location.href = "/admin/forms";
                        });
                    } else {
                        window.Swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error",
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    window.Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
        },
    }));
});
