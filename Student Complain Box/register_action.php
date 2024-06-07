<?php
// Database credentials
$servername = "localhost"; // Assuming database is hosted on the same server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "student_complaint_box"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $username = $_POST["uname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $school = $_POST["school"];
    $branch = $_POST["branch"];
    $password = $_POST["psw"];

    // Check if username or email already exists
    $check_query = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // User already registered
        echo "User already registered. <a href='login.html'>Login Here</a>";
    } else {
        // Insert data into database
        $sql = "INSERT INTO user(name, username, email, contact, school, branch, password) 
                VALUES ('$name', '$username', '$email', '$contact', '$school', '$branch', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            // Redirect to home page or any other page after successful registration
            header("Location: home.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
