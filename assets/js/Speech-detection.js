// Add your Azure API Key and Region here
const subscriptionKey = '4f464ad2de1b4cd3ad40a3675ccc82a7';
const serviceRegion = 'eastus'; // Example: 'eastus'
let recognizer;

document.addEventListener('DOMContentLoaded', (event) => {

    // Check if Speech SDK is loaded
    if (typeof SpeechSDK === 'undefined') {
        console.error("Speech SDK not loaded.");
        return;
    }

    document.getElementById('start-recognition').addEventListener('click', function () {
        const speechConfig = SpeechSDK.SpeechConfig.fromSubscription(subscriptionKey, serviceRegion);
        speechConfig.speechRecognitionLanguage = 'ar-EG';  // Set language

        const audioConfig = SpeechSDK.AudioConfig.fromDefaultMicrophoneInput();
        recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);

        recognizer.startContinuousRecognitionAsync();

        // Event for when speech is recognized
        recognizer.recognized = (s, e) => {
            if (e.result.reason === SpeechSDK.ResultReason.RecognizedSpeech) {
                const recognizedText = e.result.text;
                appendRecognizedText(recognizedText);
                console.log(`Recognized Text: ${recognizedText}`);
            }
        };

        recognizer.canceled = (s, e) => {
            console.error(`Recognition canceled: ${e.errorDetails}`);
        };

        recognizer.sessionStopped = (s, e) => {
            console.log("Session stopped");
            recognizer.stopContinuousRecognitionAsync();
        };

        document.getElementById('stop-recognition').disabled = false;
        document.getElementById('start-recognition').disabled = true;
    });

    document.getElementById('stop-recognition').addEventListener('click', function () {
        if (recognizer) {
            recognizer.stopContinuousRecognitionAsync();
            document.getElementById('stop-recognition').disabled = true;
            document.getElementById('start-recognition').disabled = false;
        }
    });

    function appendRecognizedText(recognizedText) {
        const contentDiv = document.getElementById('content');
        let highlightedText = recognizedText;
        highlightedText = highlightedText.replace(/\d+/g, '<span class="highlight-number">$&</span>');
        highlightedText = highlightedText.replace(/remember/gi, '<span class="highlight-remember">important</span>');
        contentDiv.innerHTML += ' ' + highlightedText;
    }

    document.getElementById('save-content').addEventListener('click', function () {
        var content = document.getElementById('content').innerHTML;
        console.log("Content to save: ", content);  // Check this in your console
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../includes/FileContent_class.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('content=' + encodeURIComponent(content) + '&file_id=1'); // Ensure this matches your backend code
    });
});
