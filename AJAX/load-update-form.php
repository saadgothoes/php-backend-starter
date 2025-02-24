<?php 
$student_id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "test1") or die("Connection failed.");

$sql = "SELECT * FROM students WHERE id = {$student_id}";
$result = mysqli_query($conn, $sql);

$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "          
            <tr>
                <td>First Name</td>
                <td><input type='text' id='edit-fname' value='{$row['FIRST_NAME']}'></td>
              <td><input type='text' id='edit-id' hidden value='{$row['ID']}'></td>

            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type='text' id='edit-lname' value='{$row['LAST_NAME']}'></td>
            </tr>
            <tr>
                <td></td>
                <td><input type='submit' id='edit-submit' value='Update'></td>
            </tr>";
    }

    mysqli_close($conn);

    echo $output;
} else {
    echo "<h2>No record found</h2>";
}
?>
