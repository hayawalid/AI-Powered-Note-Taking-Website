document.addEventListener("DOMContentLoaded", () => {
    const pages = document.querySelectorAll(".survey-page");
    const dots = document.querySelectorAll(".dot");
    const progressIndicator = document.getElementById("progress-indicator");
    const continueButton = document.getElementById("continue-btn");
    const finishButton = document.getElementById("finish-button");
    const form = document.getElementById('form');
    let currentPage = 0;

    if (continueButton) {
        continueButton.addEventListener("click", () => {
            if (currentPage === 0) {
                progressIndicator.style.display = "flex";
            }
            currentPage++;
            showPage(currentPage);
        });


        function showPage(index) {
            pages.forEach((page, i) => {
                page.classList.toggle("hidden", i !== index);
                if (dots[i]) {
                    dots[i].classList.toggle("active", i === index);
                }
            });
            finishButton.classList.toggle("hidden", index < pages.length - 1);
        }

        pages.forEach((page, index) => {
            const choices = page.querySelectorAll(".choice");
            choices.forEach((choice) => {
                choice.addEventListener("click", () => {
                    choices.forEach((c) => {
                        c.style.borderColor = "#ddd";
                        const radioInput = c.querySelector("input[type='radio']");
                        if (radioInput) radioInput.checked = false;
                    });

                    choice.style.borderColor = "#6495ED";
                    const radioInput = choice.querySelector("input[type='radio']");
                    if (radioInput) radioInput.checked = true;
                    if (radioInput.value == "Work") console.log("Work" + " is checked.");

                    if (currentPage === index && index < pages.length - 1) {
                        currentPage++;
                        showPage(currentPage);
                    }
                });
            });
        });

        finishButton.addEventListener("click", () => {
            alert("Thank you for completing the survey!");
            document.getElementById("survey-overlay").style.display = "none";
        });

        showPage(currentPage);
    }

});
