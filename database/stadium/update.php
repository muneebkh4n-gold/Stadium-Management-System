<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$name = $type = $capacity = $loc_id = "";
$name_err = $type_err = $capacity_err = $loc_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["stadium_id"]) && !empty($_POST["stadium_id"])){
    // Get hidden input value
    $id = $_POST["stadium_id"];
    
    // Validate name
    $input_name = trim($_POST["stadium_name"]);
    if(empty($input_name)){
        $name_err = "Please enter a stadium name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate stadium type
    $input_type = trim($_POST["stadium_type"]);
    if(empty($input_type)){
        $type_err = "Please enter an stadium type  (football/cricket/hockey).";     
    } else{
        $type = $input_type;
    }
    
    // Validate stadium capacity
    $input_capacity = trim($_POST["stadium_capacity"]);
    if(empty($input_capacity)){
        $capacity_err = "Please enter the capacity.";     
    } elseif(!ctype_digit($input_capacity)){
        $capacity_err = "Please enter a positive integer value.";
    } else{
        $capacity = $input_capacity;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($type_err) && empty($capacity_err)){
        // Prepare an update statement
        $sql = "UPDATE stadium SET stadium_name=?, stadium_type=?, stadium_capacity=? WHERE stadium_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_type, $param_capacity, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_type = $type;
            $param_capacity = $capacity;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["stadium_id"]) && !empty(trim($_GET["stadium_id"]))){
        // Get URL parameter
        $id =  trim($_GET["stadium_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM stadium WHERE stadium_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["stadium_name"];
                    $type = $row["stadium_type"];
                    $capacity = $row["stadium_capacity"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the stadium record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Stadium Name</label>
                            <input type="text" name="stadium_name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stadium Type</label>
                            <textarea name="stadium_type" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>"><?php echo $type; ?></textarea>
                            <span class="invalid-feedback"><?php echo $type_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stadium Capacity</label>
                            <input type="text" name="stadium_capacity" class="form-control <?php echo (!empty($capacity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $capacity; ?>">
                            <span class="invalid-feedback"><?php echo $capacity_err;?></span>
                        </div>
                        <input type="hidden" name="stadium_id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>