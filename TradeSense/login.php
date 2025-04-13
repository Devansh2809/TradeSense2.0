<?php
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tradesense";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo json_encode(['success' => false, 'message' => "Email or password missing."]);
        exit;
    }
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => "Email and password cannot be empty."]);
        exit;
    }
    
    // Prepare SQL query
    $stmt = $conn->prepare("SELECT UserID, Password FROM Users WHERE Email = ?");
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => "Prepare statement failed: " . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $stored_password);
        $stmt->fetch();
        
        // Compare passwords directly (no hashing)
        if ($password === $stored_password) {
            $_SESSION['user_id'] = $userID;
            echo json_encode(['success' => true, 'message' => "Login successful"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Incorrect password."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "No user found with that email."]);
    }
    
    $stmt->close();
}

$conn->close();
?>