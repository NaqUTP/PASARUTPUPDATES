<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
<h2>Add Product</h2>

<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// User's email retrieved from the session
$user_email = $_SESSION['email'];
?>

<form action="PROCESSSELL.php" method="POST" enctype="multipart/form-data">
    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required><br><br>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>

    <input type="hidden" name="user_email" value="<?php echo $user_email; ?>"> <!-- Add user's email as a hidden input -->

    <input type="submit" value="Submit">
</form>

<!-- Button to go to My Listings page -->
<a href="VIEWSELL.php">My Listings</a>
</body>
</html>
