<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 800px;
            margin: 0 auto;
        }
	#dashboard {
	    padding-left: 80px;
	    padding-top: 50px;
	}

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <h1 id='dashboard' class="text-inverse-secondary bg-secondary">Admin Dashboard</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Stadium Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Stadium</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../../config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM stadium, location where stadium.location_id = location.location_id";
                    if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                    echo '<table class="table table-bordered table-striped">
                        ';
                        echo "
                        <thead>
                            ";
                            echo "
                            <tr>
                                ";
                                echo "
                                <th>Stadium ID</th>";
                                echo "
                                <th>Stadium Name</th>";
                                echo "
                                <th>Stadium Type</th>";
                                echo "
                                <th>Capacity</th>";
                                echo "
                                <th>Location ID</th>";
                                echo "
                                <th>Location Address</th>";
                                echo "
                                <th>City</th>";
                                echo "
                                <th>Action</th>";
                                echo "
                            </tr>";
                            echo "
                        </thead>";
                        echo "
                        <tbody>
                            ";
                            while($row = mysqli_fetch_array($result)){
                            echo "
                            <tr>
                                ";
                                echo "
                                <td>" . $row['stadium_id'] . "</td>";
                                echo "
                                <td>" . $row['stadium_name'] . "</td>";
                                echo "
                                <td>" . $row['stadium_type'] . "</td>";
                                echo "
                                <td>" . $row['stadium_capacity'] . "</td>";
                                echo "
                                <td>" . $row['location_id'] . "</td>";
                                echo "
                                <td>" . $row['address'] . "</td>";
                                echo "
                                <td>" . $row['city'] . "</td>";
                                echo "
                                <td>
                                    ";
                                    echo '<a href="read.php?stadium_id='. $row['stadium_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="update.php?stadium_id='. $row['stadium_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="delete.php?stadium_id='. $row['stadium_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "
                                </td>";
                                echo "
                            </tr>";
                            }
                            echo "
                        </tbody>";
                        echo "
                    </table>";
                    // Free result set
                    mysqli_free_result($result);
                    } else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                    } else{
                    echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>