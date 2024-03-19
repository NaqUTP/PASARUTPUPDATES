<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pasarutpreg";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in and has an email in the session
    session_start();
    if (!isset($_SESSION['email'])) {
        echo "Error: User is not logged in.";
        exit();
    }

    // Retrieve user's email from the session
    $user_email = $_SESSION['email'];

    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name']; // Name of the uploaded image file

    // Sanitize input (optional)
    $description = mysqli_real_escape_string($conn, $description);
    $price = mysqli_real_escape_string($conn, $price);
    $quantity = mysqli_real_escape_string($conn, $quantity);

    // Move uploaded image to designated folder
    $target_dir = "uploads/"; // Directory where uploaded images will be stored
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into the database
    $sql = "INSERT INTO products (description, price, quantity, image, email) VALUES ('$description', '$price', '$quantity', '$image', '$user_email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
