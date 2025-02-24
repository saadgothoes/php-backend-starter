<?php
$conn = mysqli_connect("localhost", "root", "", "test1") or die("Connection Failed");

$student_id = $_POST["id"];

$sql = "DELETE FROM students WHERE id = {$student_id}";

if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
?>
