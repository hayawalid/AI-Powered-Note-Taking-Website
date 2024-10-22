// Add your Azure API Key and Region here
const subscriptionKey = '4f464ad2de1b4cd3ad40a3675ccc82a7';
const serviceRegion = 'eastus'; // Example: 'eastus'
let recognizer;




// const openAiEndpoint = "https://textgeniusai.openai.azure.com/";
// const openAiApiKey = "f29a41d023554ef7a8f44b9db3c8e014";

// async function getSummary(text) {
//     const response = await fetch(openAiEndpoint, {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "Authorization": `Bearer ${openAiApiKey}`
//         },
//         body: JSON.stringify({
//             prompt: `Summarize the following text: ${text}`,
//             max_tokens: 150,
//             temperature: 0.5
//         })
//     });

//     const data = await response.json();
//     return data.choices[0].text;
// }

// document.getElementById('summarize').addEventListener('click', () => {
//     const content = document.getElementById('content').innerText; // Get the text from your editable content area
//     getSummary(content).then(summary => {
//         document.getElementById('summary-section').innerText = summary; // Display the summary
//     });
// });

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('start-recognition').addEventListener('click', function () {
        // Setup the Speech SDK
        const speechConfig = SpeechSDK.SpeechConfig.fromSubscription(subscriptionKey, serviceRegion);
        speechConfig.speechRecognitionLanguage = 'ar-EG';  // Set to Arabic (Egypt) - You can change dialect or language if needed
        const audioConfig = SpeechSDK.AudioConfig.fromDefaultMicrophoneInput();
        recognizer = new SpeechSDK.SpeechRecognizer(speechConfig, audioConfig);
        recognizer.startContinuousRecognitionAsync();

        // Event for when speech is recognized
        recognizer.recognized = (s, e) => {
            if (e.result.reason === SpeechSDK.ResultReason.RecognizedSpeech) {
                const recognizedText = e.result.text;
                appendRecognizedText(recognizedText); // Append to the content div
                console.log(`Recognized Text: ${recognizedText}`);

                // Send recognized text to the PHP server for summarization and question generation
                // saveContentToServer(recognizedText);
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
        recognizer.stopContinuousRecognitionAsync();
        document.getElementById('stop-recognition').disabled = true;
        document.getElementById('start-recognition').disabled = false;
    });



    function appendRecognizedText(recognizedText) {
        const contentDiv = document.getElementById('content');
        highlightedText = highlightedText.replace(/\d+/g, '<span class="highlight-number">$&</span>');
        highlightedText = highlightedText.replace(/remember/gi, '<span class="highlight-remember">important</span>');
        contentDiv.innerHTML += ' ' + highlightedText;
    }

    document.getElementById('save-content').addEventListener('click', function () {
        var content = document.getElementById('content').innerHTML;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../includes/FileContent_class.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('content=' + encodeURIComponent(content) + '&file_id=1'); // Pass recognized text here
    });
    

});
