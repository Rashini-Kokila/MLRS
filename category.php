<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "rashinik97@gmail.com"; // Replace with the recipient's email address
    $subject = "Hello from your website";
    $message = "This is a test email sent from the website's contact button.";

    // Additional headers (optional)
    $headers = "From: rashiniwijayananda@gmail.com\r\n";
    $headers .= "Reply-To: rashinik97@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Button Example</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Email Button Example</h1>
        
        <!-- Button to trigger the email -->
        <button class="btn btn-primary" id="sendEmailBtn">Send Email</button>
    </div>
    <script>
        document.getElementById("sendEmailBtn").addEventListener("click", function() {
            // Send a POST request to the PHP script when the button is clicked
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "sendemail.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Show the response from the PHP script in an alert or a message div
                }
            };
            xhr.send();
        });
    </script>


    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
