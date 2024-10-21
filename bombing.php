<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['phoneNumber'])) {
        $phoneNumber = $_POST['phoneNumber'];
        $apiUrl = "http://103.174.153.202/~rsbdxyz/Api/sms/main.php?num=" . urlencode($phoneNumber);
        
        $response = file_get_contents($apiUrl);
        
        if ($response !== FALSE) {
            // Successfully sent
            echo "Bombing Successful!";
        } else {
            // Error occurred
            http_response_code(500);
            echo "Error: Unable to send message.";
        }
    } else {
        http_response_code(400);
        echo "Error: Phone number not provided.";
    }
} else {
    http_response_code(405);
    echo "Error: Invalid request method.";
}
?>
