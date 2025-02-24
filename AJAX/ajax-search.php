<?php
$conn = mysqli_connect("localhost", "root", "", "test1") or die("Connection failed. Try again.");

if (isset($_POST['sebtn'])) {
    $searchTerm = $_POST['sebtn'];
    
    // SQL query to only show records where the search term exists in either FIRST_NAME or LAST_NAME
    $sql = "SELECT * FROM students WHERE FIRST_NAME LIKE '%$searchTerm%' OR LAST_NAME LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $output = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>
                        <td>{$row["ID"]}</td>
                        <td>{$row["FIRST_NAME"]} {$row["LAST_NAME"]}</td>
                        <td><button class='delete-btn btn btn-danger btn-sm' data-id='{$row["ID"]}'>Delete</button></td>
                    </tr>";
        }
        echo $output;
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
    }
}
?>
