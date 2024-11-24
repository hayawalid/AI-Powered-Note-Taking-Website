const subscriptionKey = '4f464ad2de1b4cd3ad40a3675ccc82a7';
const serviceRegion = 'eastus';
let recognizer;
let animationInterval;
let transcribedText = '';

window.addEventListener("load", () => {
    const soundWaveContainer = document.getElementById("soundWave");

    // Generate 160 bars dynamically
    for (let i = 0; i < 130; i++) {
        const bar = document.createElement("div");
        bar.classList.add("bar");
        soundWaveContainer.appendChild(bar);
    }

    // Unify bar length initially
    const bars = document.querySelectorAll(".bar");
    bars.forEach((item) => {
        item.style.height = '30px'; // Initial height of 30px
    });

    function animateBars() {
        bars.forEach((bar) => {
            const randomHeight = Math.random() * 70 + 30; // Random height between 30px and 100px
            bar.style.height = `${randomHeight}px`;
        });
    }

    function startAnimation() {
        if (!animationInterval) {
            animationInterval = setInterval(animateBars, 100);
        }
    }

    function stopAnimation() {
        if (animationInterval) {
            clearInterval(animationInterval);
            animationInterval = null;
        }
        bars.forEach((bar) => {
            bar.style.height = '30px'; // Reset to initial height
        });
    }

    if (typeof SpeechSDK === 'undefined') {
        console.error("Speech SDK not loaded.");
        return;
    }

    const startRecognitionButton = document.getElementById('start-recognition');
    const stopRecognitionButton = document.getElementById('stop-recognition');
    const saveContentButton = document.getElementById('save-content');
    const editContentButton = document.getElementById('edit-content');
    const statusMessage = document.createElement('div');
    statusMessage.setAttribute('id', 'status-message');
    document.body.appendChild(statusMessage);

    function countdown(seconds, callback) {
        let remaining = seconds;
        statusMessage.innerHTML = `Starting in ${remaining}...`;
        const countdownInterval = setInterval(() => {
            remaining -= 1;
            statusMessage.innerHTML = `Starting in ${remaining}...`;
            if (remaining <= 0) {
                clearInterval(countdownInterval);
                callback();
            }
        }, 1000);
    }

    startRecognitionButton.addEventListener('click', function () {
        statusMessage.innerHTML = "Preparing to start... Please wait.";
        
        countdown(3, () => {
            const speechConfig = SpeechSDK.SpeechConfig.fromSubscription(subscriptionKey, serviceRegion);
            speechConfig.speechRecognitionLanguage = 'ar-EG';

            const audioConfig = SpeechSDK.AudioConfig.fromDefaultMicrophoneInput();
            recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);

            recognizer.startContinuousRecognitionAsync(() => {
                statusMessage.innerHTML = "You can start speaking now.";
            });

            recognizer.recognizing = (s, e) => {
                if (e.result.reason === SpeechSDK.ResultReason.RecognizingSpeech) {
                    console.log("Recognizing speech, animating bars");
                    startAnimation();
                } else {
                    stopAnimation();
                }
            };

            recognizer.recognized = (s, e) => {
                if (e.result.reason === SpeechSDK.ResultReason.RecognizedSpeech) {
                    appendRecognizedText(e.result.text);
                    startAnimation(); // Keep animating if continuous speech is recognized
                } else {
                    stopAnimation(); // Stop animating when there's no speech
                }
            };

            recognizer.canceled = (s, e) => {
                console.error(`Recognition canceled: ${e.errorDetails}`);
                stopAnimation();
            };

            recognizer.sessionStopped = (s, e) => {
                console.log("Recording stopped");
                recognizer.stopContinuousRecognitionAsync();
                stopAnimation();
            };

            stopRecognitionButton.disabled = false;
            startRecognitionButton.disabled = true;
        });
    });

    stopRecognitionButton.addEventListener('click', function () {
        if (recognizer) {
            recognizer.stopContinuousRecognitionAsync();
            stopRecognitionButton.disabled = true;
            startRecognitionButton.disabled = false;
            stopAnimation();
            statusMessage.innerHTML = "";
        }
    });

    saveContentButton.addEventListener('click', function () {
        saveTranscribedContent(transcribedText);
    });

    editContentButton.addEventListener('click', function () {
        saveTranscribedContent(transcribedText);
    });

    function appendRecognizedText(text) {
        const contentDiv = document.getElementById('content');
        let formattedText = text.trim();
        transcribedText += formattedText + ' ';

        formattedText = formattedText.replace(/\d+/g, '<span class="highlight-number">$&</span>');
        formattedText = formattedText.replace(/remember/gi, '<span class="highlight-remember">important</span>');

        formattedText = `<div class="paragraph">${formattedText}</div>`;
        contentDiv.innerHTML += ` ${formattedText}`;
        console.log('Text transcribed: ', formattedText); // Log the transcribed text
    }

    function saveTranscribedContent(content) {
        console.log('Preparing to send transcribed content to server...');
        console.log('Content to save:', content);

        fetch('../includes/FileContent_class.php', { // Ensure this path is correct
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `content=${encodeURIComponent(content)}&file_id=1`  // Adjust file_id as needed
        })
        .then(response => response.text())
        .then(data => {
            console.log('Server response:', data);
            if (data.includes("Record updated successfully")) {
                console.log('Content saved successfully');
            } else {
                console.log('Failed to save content. Response:', data);
            }
        })
        .catch(error => console.error('Error saving content:', error));
        window.location.href = '../pages/Note.php';
    }
});
