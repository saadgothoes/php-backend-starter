<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add & Delete Record with PHP and AJAX</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="file.css">


</head>

<body>

    <!-- Heading -->
    <div class="bg-secondary p-1">

        <div class="container text-center mt-3 p-2">
            <form class="form">
                <input type="search" placeholder="Search" aria-label="Search" id="searchInput">
            </form>


            <h2 class="text-white bg-secondary">ADD & DELETE RECORD WITH PHP AND AJAX</h2>

        </div>
    </div>

    <!-- Navbar with Input Fields and Save Button -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-center">
            <input type="text" id="firstName" class="form-control" placeholder="First Name">
            <input type="text" id="lastName" class="form-control" placeholder="Last Name">
            <button id="saveBtn">Save</button>
        </div>
    </nav>

    <!-- Error & Success Messages -->
    <div class="container mt-3">
        <div id="error-messege"></div>
        <div id="success-messege"></div>
    </div>


    <div id="modal">
        <h2>Edit form</h2>
        <div id="modal-form">
            <table cellpadding="0" width="100%">
                <tr>
                    <td>First Name</td>
                    <td><input type="text" id="edit-fname"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" id="edit-lname"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" id="edit-submit"></td>
                </tr>
            </table>
            <div id="close-btn">
                <i class="fas fa-times"></i> <!-- FontAwesome close icon -->
            </div>




        </div>
    </div>

    <!-- Table Section -->
    <div class="container mt-4">
        <table class="table table-bordered text-white">
            <thead class="table-dark">
                <tr>
                    <th width="100px">ID</th>
                    <th>Name</th>
                    <th width="100px">Update</th> <!-- Delete column -->
                    <th width="100px">Action</th> <!-- New Update Column -->
                </tr>
            </thead>
            <tbody id="tableData">
                <!-- Data will be dynamically loaded here with Update and Action (Delete) buttons -->
            </tbody>
        </table>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "ajax-load.php", // Ensure your "ajax-load.php" file loads data
                    type: "POST",
                    success: function(data) {
                        $("#tableData").html(data);
                    }
                });
            }

            loadTable(); // Initial load of data

            // Insert Data
            $(document).ready(function() {

                $(document).ready(function() {

                    // Load table data
                    function loadTable() {
                        $.ajax({
                            url: "ajax-load.php",
                            type: "POST",
                            success: function(data) {
                                $("#tableData").html(data);
                            }
                        });
                    }

                    loadTable(); // Load data on page load
                });

                $(document).on("click", ".edit-btn", function(e) {
                    $("#modal").show();
                    var studentId = $(this).data("eid");
                    $.ajax({
                        url: "load-update-form.php",
                        type: "POST",
                        data: {
                            id: studentId
                        },
                        success: function(data) {
                            $('#modal-form table').html(data);

                        }
                    })

                });
                $("#close-btn").on("click", function() {
                    $("#modal").hide();

                });

                // `EDIT METHOD PART
                $(document).on("click", "#edit-submit", function() {
                    var stuid = $("#edit-id").val();
                    var fname = $("#edit-fname").val();
                    var lname = $("#edit-lname").val();
                    $.ajax({
                        url: "ajax-update-form.php",
                        type: "POST",
                        data: {
                            id: stuid,
                            First_name: fname,
                            Last_name: lname
                        },
                        success: function(data) {

                            if (data == 1) {
                                $("#modal").hide();
                                loadTable();
                                $("#firstName").val("");
                                $("#lastName").val("");
                                $("#success-messege").html("Data Updated successfully.").fadeIn().delay(3000).fadeOut();
                                $("#error-messege").fadeOut();

                            } else {
                                alert("Update failed! Please try again.");
                                $("#error-messege").html("Can't update the  record.").fadeIn().delay(3000).fadeOut();
                                $("#success-messege").fadeOut();
                            }
                        }
                    })
                })



                // load method  Load the table with records (function already used in your script)
                function loadTable() {
                    $.ajax({
                        url: 'ajax-load.php',
                        type: 'POST',
                        success: function(data) {
                            $('#tableData').html(data);
                        }
                    });
                }
                loadTable();
            });
            // insert data function method
            $("#saveBtn").on("click", function(e) {
                e.preventDefault();

                var fname = $("#firstName").val().trim();
                var lname = $("#lastName").val().trim();

                if (fname === "" || lname === "") {
                    $("#error-messege").html("All fields are required.").fadeIn().delay(3000).fadeOut();
                    $("#success-messege").fadeOut();
                } else {
                    $.ajax({
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {
                            first_name: fname,
                            last_name: lname
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                                $("#firstName").val("");
                                $("#lastName").val("");
                                $("#success-messege").html("Data inserted successfully.").fadeIn().delay(3000).fadeOut();
                                $("#error-messege").fadeOut();
                            } else {
                                $("#error-messege").html("Can't save record.").fadeIn().delay(3000).fadeOut();
                                $("#success-messege").fadeOut();
                            }
                        }
                    });
                }
            });

            // Search functionality
            $("#searchInput").on("keyup", function() {
                var searchTerm = $(this).val().trim();

                if (searchTerm != "") {
                    $.ajax({
                        url: "ajax-search.php", // Your AJAX search file
                        type: "POST",
                        data: {
                            sebtn: searchTerm
                        },
                        success: function(data) {
                            $("#tableData").html(data);
                        }
                    });
                } else {
                    loadTable(); // Load all records if search term is empty
                }
            });

            // Delete Data
            $(document).on("click", ".delete-btn", function() {
                var studentId = $(this).data("id");

                if (confirm("Are you sure you want to delete this record?")) {
                    $.ajax({
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {
                            id: studentId
                        },
                        success: function(response) {
                            if (response == 1) {
                                loadTable();
                                $("#success-messege").html("Record deleted successfully.").fadeIn().delay(3000).fadeOut();
                            } else {
                                $("#error-messege").html("Failed to delete record.").fadeIn().delay(3000).fadeOut();
                            }
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>