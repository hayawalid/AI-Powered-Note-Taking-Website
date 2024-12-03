<?php
include_once '../includes/session.php';

$current_page = 'Flash Cards';
ini_set('display_errors', 1);
error_reporting(E_ALL);

//db connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartnotes_db"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch all flashcards where file_type = 3 (assuming that file_type 3 is for flashcards)
$sql = "SELECT id, name, content FROM files WHERE file_type = 3";
$result = $conn->query($sql);

$flashcards = []; // Initialize an empty array to store flashcards

if ($result->num_rows > 0) {
    // Loop through each flashcard
    while ($card = $result->fetch_assoc()) {
        // Decode the content JSON to access question and answer
        $content = json_decode($card['content'], true);

        if (isset($content['question']) && isset($content['answer'])) {
            // Add the card data to the flashcards array with the question and answer
            $flashcards[] = [
                'id' => $card['id'],
                'name' => $card['name'],
                'question' => $content['question'],
                'answer' => $content['answer']
            ];
        } else {
            // Fallback if question or answer is missing
            $flashcards[] = [
                'id' => $card['id'],
                'name' => $card['name'],
                'question' => 'No question available',
                'answer' => 'No answer available'
            ];
        }
    }
} else {
    echo "No flashcards found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Note cards - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/user_style.css">

    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{margin-top:20px;}
        .container {
        margin-left: 250px; /* Adjust this value according to the width of your sidebar */
        float: right;
    }
.card-big-shadow {
    max-width: 320px;
    position: relative;
}

.coloured-cards .card {
    margin-top: 30px;
}

.card[data-radius="none"] {
    border-radius: 0px;
}
.card {
    border-radius: 8px;
    box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
    background-color: #FFFFFF;
    color: #252422;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}


.card[data-background="image"] .title, .card[data-background="image"] .stats, .card[data-background="image"] .category, .card[data-background="image"] .description, .card[data-background="image"] .content, .card[data-background="image"] .card-footer, .card[data-background="image"] small, .card[data-background="image"] .content a, .card[data-background="color"] .title, .card[data-background="color"] .stats, .card[data-background="color"] .category, .card[data-background="color"] .description, .card[data-background="color"] .content, .card[data-background="color"] .card-footer, .card[data-background="color"] small, .card[data-background="color"] .content a {
    color: #FFFFFF;
}
.card.card-just-text .content {
    padding: 50px 65px;
    text-align: center;
}
.card .content {
    padding: 20px 20px 10px 20px;
}
.card[data-color="blue"] .category {
    color: #7a9e9f;
}

.card .category, .card .label {
    font-size: 14px;
    margin-bottom: 0px;
}
.card-big-shadow:before {
    background-image: url("http://static.tumblr.com/i21wc39/coTmrkw40/shadow.png");
    background-position: center bottom;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    bottom: -12%;
    content: "";
    display: block;
    left: -12%;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 0;
}
h4, .h4 {
    font-size: 1.5em;
    font-weight: 600;
    line-height: 1.2em;
}
h6, .h6 {
    font-size: 0.9em;
    font-weight: 600;
    text-transform: uppercase;
}
.card .description {
    font-size: 16px;
    color: #66615b;
}
.content-card{
    margin-top:30px;    
}
a:hover, a:focus {
    text-decoration: none;
}

/*======== COLORS ===========*/
.card[data-color="blue"] {
    background: #b8d8d8;
}
.card[data-color="blue"] .description {
    color: #506568;
}

.card[data-color="green"] {
    background: #d5e5a3;
}
.card[data-color="green"] .description {
    color: #60773d;
}
.card[data-color="green"] .category {
    color: #92ac56;
}

.card[data-color="yellow"] {
    background: #ffe28c;
}
.card[data-color="yellow"] .description {
    color: #b25825;
}
.card[data-color="yellow"] .category {
    color: #d88715;
}

.card[data-color="brown"] {
    background: #d6c1ab;
}
.card[data-color="brown"] .description {
    color: #75442e;
}
.card[data-color="brown"] .category {
    color: #a47e65;
}

.card[data-color="purple"] {
    background: #baa9ba;
}
.card[data-color="purple"] .description {
    color: #3a283d;
}
.card[data-color="purple"] .category {
    color: #5a283d;
}

.card[data-color="orange"] {
    background: #ff8f5e;
}
.card[data-color="orange"] .description {
    color: #772510;
}
.card[data-color="orange"] .category {
    color: #e95e37;
}
/* hena */




.card-big-shadow {
    position: relative;
    perspective: 1000px; /* Enables 3D flipping */
}

.card-flip {
    transform-style: preserve-3d; /* Maintains 3D effect for children */
    transition: transform 0.6s ease-in-out; /* Smooth flipping animation */
    position: relative;
}

.card-flip.is-flipped {
    transform: rotateY(180deg); /* Flipping effect */
}

.card-front,
.card-back {
    backface-visibility: hidden; /* Hides the back face when not visible */
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.card-front {
    /* Ensure the front card is shown initially */
    display: flex; /* Enable flexbox for alignment */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
    box-sizing: border-box;
}

.card-back {
    /* Make sure the back card is hidden initially */
    transform: rotateY(180deg); /* Rotate back card to hide it */
    display: flex; /* Enable flexbox for alignment */
    flex-direction: column; /* Stack elements vertically */
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
    text-align: center; /* Center text alignment */
    padding: 20px; /* Add spacing inside the back card */
    height: 100%; /* Ensure it takes up full height of the card */
    box-sizing: border-box; /* Include padding in height/width calculations */
    background-color: #f4f4f4; /* Light background color for better readability */
    color: #333; /* Dark text color for readability */
}

.card-back .title, .card-back .description {
    color: #333; /* Ensure text is readable */
    font-size: 16px;
}

.card-back .category {
    color: #555; /* Subtle color for category text */
    font-size: 14px;
}


    </style>
</head>
<body>
<?php include '../includes/sidebar.php'; ?>

<!-- Display Flashcards -->
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <?php foreach ($flashcards as $card): ?>
            <div class="col-md-4 col-sm-6 content-card">
                <div class="card-big-shadow">
                    <div class="card-flip">
                        <!-- Front of the Card (Question) -->
                        <div class="card card-just-text" data-background="color" data-color="blue" data-radius="none">
                            <div class="content">
                                <h6 class="category"><?php echo htmlspecialchars($card['name']); ?></h6>
                                <h4 class="title"><a href="#">Flashcard #<?php echo $card['id']; ?></a></h4>
                                <p class="description">
                                    <?php echo htmlspecialchars($card['question']); // Display question on the front ?>
                                </p>
                            </div>
                        </div>
                        <!-- Back of the Card (Answer) -->
                        <div class="card card-back">
                            <h6 class="category">Answer</h6>
                            <p>
                                <?php echo htmlspecialchars($card['answer']); // Display answer on the back ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cardContainers = document.querySelectorAll(".card-big-shadow");

    cardContainers.forEach(container => {
        container.addEventListener("click", function () {
            const cardFlip = this.querySelector(".card-flip");
            cardFlip.classList.toggle("is-flipped");
        });
    });
});

</script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/flashcards.js"></script>

<!-- Core JS Files -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!-- Notifications Plugin -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard -->
<script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
</body>
</html>



