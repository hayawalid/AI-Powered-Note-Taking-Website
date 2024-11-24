const subscriptionKey = '4f464ad2de1b4cd3ad40a3675ccc82a7';
const serviceRegion = 'eastus';
let recognizer;
let animationInterval;

window.addEventListener("load", () => {
    const soundWaveContainer = document.getElementById("soundWave");

    // Generate 160 bars dynamically
    for (let i = 0; i < 160; i++) {
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

    document.getElementById('start-recognition').addEventListener('click', function () {
        const speechConfig = SpeechSDK.SpeechConfig.fromSubscription(subscriptionKey, serviceRegion);
        speechConfig.speechRecognitionLanguage = 'ar-EG';

        const audioConfig = SpeechSDK.AudioConfig.fromDefaultMicrophoneInput();
        recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);

        recognizer.startContinuousRecognitionAsync();

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

        document.getElementById('stop-recognition').disabled = false;
        document.getElementById('start-recognition').disabled = true;
    });

    document.getElementById('stop-recognition').addEventListener('click', function () {
        if (recognizer) {
            recognizer.stopContinuousRecognitionAsync();
            document.getElementById('stop-recognition').disabled = true;
            document.getElementById('start-recognition').disabled = false;
            stopAnimation();
        }
    });

    function appendRecognizedText(text) {
        const contentDiv = document.getElementById('content');
        let formattedText = text.trim();

        formattedText = formattedText.replace(/\d+/g, '<span class="highlight-number">$&</span>');
        formattedText = formattedText.replace(/remember/gi, '<span class="highlight-remember">important</span>');

        formattedText = `<div class="paragraph">${formattedText}</div>`;
        contentDiv.innerHTML += ` ${formattedText}`;
    }
});
