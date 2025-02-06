<?php
session_start();
require 'loadenv.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $dbname = getenv('CONTACTDB');
    // Collect the form data
    $name = $_POST['name']; // The 'Name' field from the form
    $email = $_POST['email']; // The 'Email' field from the form
    $contact= $_POST['contact']; // The 'Subject' field from the form
    $message = $_POST['message']; // The 'Message' textarea from the form
      
    //$mailTo="suvanshigupta@gmail.com";

   // $headers="From:".$email;
   // $txt="You have recieved an e-mail from".$name.".\n\n".$message;
    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO contacttb(name, email, contact, message) VALUES (:name, :email, :contact, :message)");

        // Bind parameters to statement variables
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':message', $message);

        // Execute the prepared statement
        
$stmt->execute();

 $_SESSION['form_submitted'] = true;
    
 // Redirect to the same page
    header("Location: contact.php");
  exit;    

        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
} 


if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted']) {
    echo '<script>
        setTimeout(function() {
            window.location.href = window.location.href;
        }, 1500);
        unset($_SESSION["form_submitted"]);
    </script>';
}
