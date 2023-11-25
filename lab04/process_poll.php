<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // $question = $_POST["questions"];
    // $answers = explode(",", $_POST["answers"]);

    // Save survey data to a file or database
    // Example: Save to a text file
    // $pollData = "Question: $question\n";
    // $pollData .= "Answers: " . implode(", ", $answers) . "\n";
    // file_put_contents("poll.txt", $pollData, FILE_APPEND);

    // Redirect back to the survey creation page or another page
    header("Location: dashboard.html");
    exit;
}
?>
