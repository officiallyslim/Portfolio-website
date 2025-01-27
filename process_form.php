<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $job_description = $_POST['job_description'];
    $image_description = $_POST['image_description'];
    $previous_services = $_POST['previous_services'];
    $email = $_POST['email'];
    $discord = $_POST['discord'];

    // Handle file uploads
    $uploaded_files = [];
    if (!empty($_FILES['example_image']['name'][0])) {
        $upload_dir = "uploads/";
        foreach ($_FILES['example_image']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['example_image']['name'][$key]);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_files[] = $target_file;
            }
        }
    }

    // Prepare email content
    $to = "officiallyslim123@gmail.com";
    $subject = "New Hire Form Submission";
    $message = "Job Description: " . $job_description . "\n\n";
    $message .= "Example Image Description: " . $image_description . "\n\n";
    $message .= "Previous Services: " . $previous_services . "\n\n";
    $message .= "Email: " . $email . "\n\n";
    $message .= "Discord Username: " . $discord . "\n\n";

    // Attach the uploaded files
    if (!empty($uploaded_files)) {
        $message .= "\nFiles:\n";
        foreach ($uploaded_files as $file) {
            $message .= $file . "\n";
        }
    }

    // Send email
    $headers = "From: " . $email;
    if (mail($to, $subject, $message, $headers)) {
        echo "Form submitted successfully!";
    } else {
        echo "Failed to send the form. Please try again.";
    }
}
?>
