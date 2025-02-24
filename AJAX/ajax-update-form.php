<?php 
$student_id = isset($_POST["id"]) ? trim($_POST["id"]) : null;
$firstName = isset($_POST["First_name"]) ? trim($_POST["First_name"]) : null;
$lastName = isset($_POST["Last_name"]) ? trim($_POST["Last_name"]) : null;

$conn = mysqli_connect("localhost", "root", "", "test1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate inputs
if ($student_id === null || $firstName === null || $lastName === null) {
    echo "Missing required fields!";
    exit();
}

// Prepare SQL statement to prevent SQL injection
$sql = "UPDATE students SET First_name = ?, Last_name = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssi", $firstName, $lastName, $student_id);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        echo 1; // Success response
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "SQL Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
