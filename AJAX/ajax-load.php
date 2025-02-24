<?php
$conn = mysqli_connect("localhost", "root", "", "test1") or die("Connection failed.");

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Update</th>
                      <th>Delete</th>
                  </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
                        <td>{$row["ID"]}</td>
                        <td>{$row["FIRST_NAME"]} {$row["LAST_NAME"]}</td>
                        <td>
                            <button class='edit-btn btn btn-warning btn-sm' data-eid='{$row["ID"]}'>✏Edit</button>
                        </td>
                        <td>
                            <button class='delete-btn btn btn-danger btn-sm' data-id='{$row["ID"]}'>🗑Delete</button>
                        </td>
                    </tr>";
    }

    $output .= "</table>";
    mysqli_close($conn);

    echo $output;
} else {
    echo "<h2>No record found</h2>";
}
