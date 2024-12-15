document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.quiz-box'); // All question boxes
    let currentQuestionIndex = 0;

    // Display only the first question on page load
    function showQuestion(index) {
        questions.forEach((question, idx) => {
            question.classList.remove('active'); // Hide all questions
            if (idx === index) {
                question.classList.add('active'); // Show current question
            }
        });
    }

    // Function for "Next" button
    window.navigateQuestion = function (direction) {
        currentQuestionIndex += direction; // Increment or decrement question index

        // Prevent out-of-bounds navigation
        if (currentQuestionIndex < 0) {
            currentQuestionIndex = 0;
        } else if (currentQuestionIndex >= questions.length) {
            currentQuestionIndex = questions.length - 1;
        }

        showQuestion(currentQuestionIndex);
    };

    // Function to handle quiz submission
    window.submitQuiz = function () {
        let score = 0;

        questions.forEach((question, index) => {
            const correctAnswer = question.dataset.correctAnswer.trim();
            const selectedOption = document.querySelector(`input[name="option${index + 1}"]:checked`);

            if (selectedOption && selectedOption.value.trim() === correctAnswer) {
                score++;
            }
        });

        alert(`You scored ${score} out of ${questions.length}!`);
    };

    // Initialize the first question
    showQuestion(currentQuestionIndex);
});
