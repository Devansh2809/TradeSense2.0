<?php
// Enable exception mode for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection (Make sure MySQL is running on XAMPP)
$host = "localhost";  // Default for XAMPP
$user = "root";       // Default username in XAMPP
$pass = "";           // Default password (empty)
$dbname = "tradesense"; // Your database name

try {
    // Create connection with exception mode
    $conn = new mysqli($host, $user, $pass, $dbname);
    $conn->set_charset("utf8mb4"); // optional but recommended

    // Get data from form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Store password without hashing

    $role_id = 2; // Default role for users

    // Check if email or username already exists
    $checkQuery = "SELECT * FROM Users WHERE Username=? OR Email=?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        // Insert new user
        $insertQuery = "INSERT INTO Users (Username, Email, Password, RoleID) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssi", $username, $email, $password, $role_id);

        // Try executing and catch trigger errors
        try {
            $insertStmt->execute();
            echo "Registration successful!";
        } catch (mysqli_sql_exception $e) {
            echo "Registration failed: " . htmlspecialchars($e->getMessage());
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();

} catch (mysqli_sql_exception $e) {
    // Catch connection or prep errors
    die("Database error: " . htmlspecialchars($e->getMessage()));
}
?>
