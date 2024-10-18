<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['text'] ?? '';
    if (!empty($inputText)) {
        // Call the function to summarize and generate questions
        $output = summarizeAndGenerateQA($inputText);
        // Return the output to the client
        echo nl2br($output);
    } else {
        echo 'No text provided for processing!';
    }
}

function summarizeAndGenerateQA($text) {
    $apiKey = '4f464ad2de1b4cd3ad40a3675ccc82a7'; // Replace with your Azure API key
    $endpoint = 'https://eastus.api.cognitive.microsoft.com/ '; // Replace with your Text Analytics endpoint
    
    $data = [
        'documents' => [
            [
                'id' => '1',
                'text' => $text,
                'language' => 'en'
            ]
        ]
    ];
    
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Ocp-Apim-Subscription-Key: $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return 'Curl error: ' . curl_error($ch);
    }
    
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpcode >= 400) {
        return 'HTTP error code: ' . $httpcode;
    }
    
    curl_close($ch);
    $result = json_decode($response, true);
    
    if (isset($result['documents'][0]['summaries'])) {
        $output = "Summary and Questions:\n" . $result['documents'][0]['summaries'][0]['text'] . "\n";
        // Add logic to generate questions
        return $output;
    } else {
        return 'No response from API. Response: ' . $response;
    }
}
?>
