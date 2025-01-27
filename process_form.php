<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $rating = htmlspecialchars($_POST['rating']);

    // Email configuration
    $to = "your-email@example.com";  // Replace with your email
    $subject = "New Form Submission";
    $message = "
        Name: $name\n
        Email: $email\n
        Age: $age\n
        Feedback: $feedback\n
        Rating: $rating\n
    ";

    // Send the email
    $headers = "From: $email";
    if (mail($to, $subject, $message, $headers)) {
        echo "Form submitted successfully! Thank you for your feedback.";
    } else {
        echo "There was an error submitting the form. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
