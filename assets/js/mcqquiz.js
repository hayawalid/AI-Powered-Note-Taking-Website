document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.quiz-box');
    let currentQuestionIndex = 0;

    function showQuestion(index) {
        questions.forEach((question, idx) => {
            question.classList.remove('active');
            if (idx === index) {
                question.classList.add('active');
            }
        });
    }

    window.navigateQuestion = function (direction) {
        currentQuestionIndex += direction;
        if (currentQuestionIndex < 0) {
            currentQuestionIndex = 0;
        } else if (currentQuestionIndex >= questions.length) {
            currentQuestionIndex = questions.length - 1;
        }
        showQuestion(currentQuestionIndex);
    };

    window.submitQuiz = function () {
        let score = 0;
        questions.forEach((question, index) => {
            const correctAnswerKey = question.dataset.correctAnswer.trim();
            const selectedOption = document.querySelector(`input[name="option${index + 1}"]:checked`);
            if (selectedOption && selectedOption.dataset.key.trim() === correctAnswerKey) {
                score++;
            }
        });
        alert(`You scored ${score} out of ${questions.length}!`);
    };

    questions.forEach((question, idx) => {
        const options = question.querySelectorAll('input[type="radio"]');
        options.forEach(option => {
            option.addEventListener('click', () => {
                const correctAnswerKey = question.dataset.correctAnswer.trim();
                options.forEach(opt => {
                    const label = opt.parentElement;
                    if (opt.dataset.key.trim() === correctAnswerKey) {
                        label.classList.add('correct');
                    } else {
                        label.classList.add('wrong');
                    }
                });
                // Disable options after selection
                options.forEach(opt => opt.disabled = true);
            });
        });
    });

    showQuestion(currentQuestionIndex);
});
