<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP WITH AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        #header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
        #main {
            width: 50%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        table {
            margin-top: 20px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div id="main" class="container">
        <div id="header" class="mb-3">
            <h1>PHP WITH AJAX</h1>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" id="load-button">Load Data</button>
        </div>
        <div id="table-id" class="mt-3">
            
    </div>
    </div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#load-button").on("click", function(e){

                $.ajax({
                    url:"ajax-load.php",
                    type: "POST",
                    success: function(data){
                        $("#table-id").html(data);  // This will update the content of #table-data with the response
                    }
                })
 
            });

        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
