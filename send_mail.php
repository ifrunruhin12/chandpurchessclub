<?php
// send_mail.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate the input
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect to an error page or handle errors as needed
        header("Location: error.html");
        exit;
    }

    // Recipient email
    $recipient = "email@chandpurchessclub.site";

    // Email subject
    $subject = "New Contact Form Message from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirect to the thank you page
        header("Location: thank_you.html");
    } else {
        // Redirect to an error page or handle errors as needed
        header("Location: error.html");
    }
} else {
    // If the form wasn't submitted via POST, redirect to the contact page
    header("Location: index.html#contact");
}
?>