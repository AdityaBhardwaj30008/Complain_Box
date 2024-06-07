<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password is set for the database
$dbname = "student_complaint_box";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the POST request
$uname = $_POST['uname'];
$psw = $_POST['psw'];

// Query to check if the provided credentials are correct
$sql = "SELECT * FROM user WHERE username='$uname'";
$result = $conn->query($sql);

// Check if there is a row with the provided credentials
if ($result->num_rows > 0) {
    // Redirect to home.html if credentials are correct
    $row = $result->fetch_assoc();

    if ($psw == $row['password']) { 
        header('Location: home.html');
        exit(); 
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$conn->close();
?>
