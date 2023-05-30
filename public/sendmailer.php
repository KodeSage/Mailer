<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body data
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $contact = $data['contact'];
    $message = $data['message'];

    // Prepare the email content
    $subject = 'New Customer Notification From Auctus Magnum';
    $body = "Email: $email\nContact: $contact\nMessage: $message";

    // Set up the email headers
    $headers = "From: contact@auctusmagnum.com"; // Replace with your email address
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    // Send the email
    $success = mail('contact@auctusmagnum.com', $subject, $body, $headers);

    if ($success) {
        // Prepare the response
        $response = [
            'success' => true,
            'message' => 'Data received and email sent successfully.',
        ];
    } else {
        // Prepare the response in case of failure
        $response = [
            'success' => false,
            'message' => 'Failed to send email.',
        ];
    }

    echo json_encode($response);
}
?>
