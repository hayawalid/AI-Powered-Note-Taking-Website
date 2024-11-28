<!-- 
<?php
 // include '../includes/user_sidebar.php';
// include '../includes/config.php';
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/Note.js"></script>
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../assets/css/Note.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body class="Bootstrap-body">

 <h1 class="text-center">Esm el folder w el note el mafto7a</h1> 
<div id="container-fluid">
  <div class="row come-in">
    
   
    
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 note-content centered">
      <div class="panel panel-info">
        <div class="panel-heading">Artifical intelligence vs machine learning 
        <button class="btn btn-primary Edit">Edit</button> 
        <button class="btn btn-primary summarize">Summerize ✨</button> 
        </div>
       
        <div class="panel-body">
          <p> <?php //include '../includes/FileContent_class.php'; echo $content; ?></p>
        </div>
        
      </div>   
            
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 summaried-class">
      <div class="panel panel-warning">
        <div class="panel-heading">Summarized Text
        <button class="btn btn-primary save">Save</button>
        </div>
        <div class="panel-body">
          <p>"Don't speak of it, I beg of you," replied the Woodman.  
            "I have no heart, you know, so I am careful to help all those who may need a friend, 
            even if it happens to be only a mouse."</p>

      
        </div>
      </div> 
      
   
    </div>
  </div>
</div>


</div>




</body>
</html> -->


<?php
// include '../includes/user_sidebar.php';
include '../includes/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Initialize Logger
$logger = new Logger('gemini_logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));

// Initialize the HTTP client
$client = new Client();

// Static content for summarization
$staticText = "Artificial Intelligence (AI) is a branch of computer science that focuses on creating intelligent machines capable of performing tasks that typically require human intelligence. These tasks include learning, reasoning, problem-solving, perception, language understanding, and more. The development and implementation of AI have profound implications for various sectors, including healthcare, education, business, and entertainment.

One of the most significant impacts of AI is in the healthcare industry. AI technologies are being used to improve diagnostic accuracy, personalize treatment plans, and streamline administrative tasks. For instance, AI algorithms can analyze medical images such as X-rays, MRIs, and CT scans to detect abnormalities with greater precision than human radiologists. In addition, AI-driven tools can sift through vast amounts of patient data to identify patterns and predict health outcomes, enabling proactive and preventive care. Personalized medicine is also benefiting from AI, as machine learning models can recommend tailored treatment plans based on an individual's genetic makeup, lifestyle, and medical history. Moreover, AI-powered chatbots and virtual assistants are enhancing patient engagement by providing 24/7 support and answering common health-related queries.

In the education sector, AI is transforming how students learn and teachers teach. Intelligent tutoring systems can provide personalized instruction and feedback, adapting to each student's learning pace and style. These systems can identify knowledge gaps and offer targeted practice exercises to reinforce understanding. AI-driven analytics can also help educators track student progress, identify at-risk students, and tailor interventions accordingly. Furthermore, AI-powered tools are making education more accessible to students with disabilities. For example, speech recognition software can transcribe lectures for hearing-impaired students, while text-to-speech applications can assist those with visual impairments.

Businesses are leveraging AI to enhance efficiency, productivity, and customer experiences. AI-powered chatbots and virtual assistants are handling customer inquiries, resolving issues, and providing recommendations around the clock. In the realm of data analysis, AI algorithms can process massive datasets to uncover insights, forecast trends, and drive strategic decision-making. Automation is another area where AI is making a significant impact. Robotic Process Automation (RPA) can automate repetitive, rule-based tasks, freeing employees to focus on more complex and creative work. Additionally, AI is being used in marketing to deliver personalized content and advertisements, improving customer engagement and conversion rates.

In the entertainment industry, AI is revolutionizing content creation and consumption. AI algorithms can analyze viewer preferences and recommend movies, TV shows, and music tailored to individual tastes. Content creators are also using AI tools to generate realistic graphics, animations, and special effects, enhancing the quality and appeal of entertainment products. Furthermore, AI-driven analytics can help studios and producers understand audience behavior, predict box office performance, and optimize marketing strategies.

While the benefits of AI are undeniable, there are also ethical and societal concerns that need to be addressed. One of the primary concerns is the potential for job displacement. As AI automates more tasks, there is a risk that some jobs will become obsolete, leading to unemployment and economic inequality. To mitigate this, there is a need for policies and programs that support workforce reskilling and transition into new roles created by AI technologies.

Another concern is the ethical use of AI. There are instances where AI systems have exhibited biases, leading to unfair treatment or discrimination. This is often due to biased training data or flawed algorithms. To ensure fairness and accountability, it is crucial to implement robust mechanisms for auditing and regulating AI systems. Additionally, transparency in AI decision-making processes is essential to build trust and ensure ethical use.

Privacy is another critical issue. AI systems often require large amounts of data to function effectively. The collection, storage, and use of this data raise concerns about privacy and data security. It is important to establish strong data protection policies and practices to safeguard personal information and prevent misuse.

In conclusion, artificial intelligence has the potential to transform various aspects of society, from healthcare and education to business and entertainment. While the opportunities are immense, it is essential to address the ethical, societal, and privacy challenges associated with AI. By fostering responsible development and implementation, we can harness the power of AI to create a better future for all. ";

$prompt = "Generate many multiple-choice question based on the following text: " . $staticText;

//Handle summarization request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['summarize'])) {
  try {
    // Make the API request to the Node.js service
    $response = $client->request('POST', 'http://localhost:3000/summarize', [
      'json' => [
        'prompt' => $prompt
      ]
    ]);
    $data = json_decode($response->getBody(), true);
    $summary = $data['summary'] ?? "No summary generated";

    // Log the response
    $logger->info('API Response', $data);
  } catch (Exception $e) {
    // Handle errors and log them
    $summary = "Error: " . htmlentities($e->getMessage());
    $logger->error('Error in summarization', ['message' => $e->getMessage()]);
  }
} else {
  $summary = "Summarized text will appear here...";
}
//----------------------------------------------------------------------------------------------

// Define the prompt for generating multiple-choice questions
$prompt_1 = "Generate questions and answers from the following text: " . $staticText . "\nPlease format the output as follows: \nQuestion 1: <question text>\nAnswer 1: <answer text>\nQuestion 2: <question text>\nAnswer 2: <answer text>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['summarize'])) {
  try {
    // Make the API request to the Node.js service
    $response_1 = $client->request('POST', 'http://localhost:3000/summarize', [
      'json' => [
        'prompt' => $prompt_1
      ]
    ]);
    $data_1 = json_decode($response_1->getBody(), true);
    
    // Print the API response for debugging
    //echo "<pre>" . htmlentities(print_r($data_1, true)) . "</pre>";

    $MCQ = $data_1['summary'] ?? "No summary generated";

    // Separate the questions and answers using a regular expression
    $questions = [];
    $answers = [];

    // Updated regular expression to match questions and answers
    preg_match_all('/Question (\d+): (.*?)\nAnswer \1: (.*?)(?=\n|$)/s', $MCQ, $matches);

    if (isset($matches[1])) {
      $questions = $matches[2];  // Extracted questions
      $answers = $matches[3];    // Extracted answers
    } else {
      $questions = ["No questions found"];
      $answers = ["No answers found"];
    }

    

    // Log the response for debugging (optional)
    $logger->info('API Response', $data_1);
  } catch (Exception $e) {
    // Handle errors and log them
    $MCQ = "Error: " . htmlentities($e->getMessage());
    $questions = ["Error occurred"];
    $answers = ["Error occurred"];
    $logger->error('Error in summarization', ['message' => $e->getMessage()]);
  }
} else {
  $MCQ = "Summarized text will appear here...";
  $questions = ["No questions generated"];
  $answers = ["No answers generated"];
}

function saveQandAtoDatabase($q_and_a) {
    global $pdo; // Use the global PDO instance for the database connection

    // Prepare the database query to insert the Q&A pairs
    $stmt = $pdo->prepare("INSERT INTO qa_pairs (question, answer) VALUES (:question, :answer)");

    // Loop through the generated Q&A and insert them into the database
    foreach ($q_and_a as $qa) {
        // Execute the statement for each question-answer pair
        $stmt->execute([
            'question' => $qa['question'],
            'answer' => $qa['answer']
        ]);
    }
}
// echo "\n----------------------------------------------------------------------------------------------------------------------------------------------------\n";

// // Debugging: Print staticText and summary for verification
//  echo nl2br(htmlentities($staticText));
// // echo nl2br(htmlentities($summary));

// // Debugging: Print separator to check if echo is working
// echo "\n----------------------------------------------------------------------------------------------------------------------------------------------------\n";

// // Display the questions and answers
// $counter = 1;
// foreach ($questions as $index => $question) {
//     echo "<h3>Question " . $counter . ":</h3>";
//     echo "<p>" . htmlentities($question) . "</p>";
//     echo "<h4>Answer " . $counter . ":</h4>";
//     echo "<p>" . htmlentities($answers[$index]) . "</p>";
//     $counter++; // Increment counter for next question-answer pair

// }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summarization and Q&A Generation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .section h2 {
            font-size: 1.5em;
            color: #007BFF;
        }
        .json-section pre, .text-section p {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            font-family: 'Courier New', Courier, monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .qa-section h3 {
            color: #28a745;
            font-size: 1.3em;
        }
        .qa-section p {
            padding: 10px;
            background-color: #e9f7e9;
            border-radius: 5px;
            font-style: italic;
        }
        .form-container {
            margin-top: 20px;
        }
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="section text-section">
        <h2>API Request Content Sent</h2>
            <p><?php echo $staticText; ?></p>
        </div>

        <div class="section text-section">
        <h2>API MCQ Response (JSON)</h2>
            <p><?php echo nl2br(htmlentities(print_r($data, true))); ?></p>
        </div>
        
        <!-- JSON Response Section -->
        <div class="section text-section">
        <h2>API Q&A Response (JSON)</h2>
            <p><?php echo nl2br(htmlentities(print_r($data_1, true))); ?></p>
        </div>

        


        <!-- Questions and Answers Section -->
        <div class="section qa-section">
            <h2>Generated Q&A</h2>
            <?php 
            $counter = 1;
            foreach ($questions as $index => $question) { 
                echo "<h3>Question " . $counter . ":</h3>";
                echo "<p>" . htmlentities($question) . "</p>";
                echo "<h4>Answer " . $counter . ":</h4>";
                echo "<p>" . htmlentities($answers[$index]) . "</p>";
                $counter++;
            }
            ?>
        </div>

        <!-- Form for Generating and Saving Q&A -->
        <div class="form-container">
            <form action="" method="POST">
                <textarea name="staticText" placeholder="Enter text here..." required></textarea><br>
                <button type="submit" name="summarize">Generate Q&A</button>
            </form>
        </div>
    </div>
</body>
</html>