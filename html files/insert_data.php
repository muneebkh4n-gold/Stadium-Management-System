<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html {
            /* background: linear-gradient(to right top, #0c008c, #002a8d, #003c82, #134971, #45535e) ; */

            max-height: 768px;
            height: 100%;
            color: black;
            /* background-image: linear-gradient(to bottom, #00132e, #27485a, #648085, #acbbb7, #f7f8f7); */
        }

        form {
            margin: 10px auto;
            max-width: 350px;
            width: 100%;
            border: 2px solid lightgrey;
            background: white;
            /* box-shadow: 1px 2px  1px 3px  lightgrey; */
            height: 300px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 0px;
        }

            form div {
                height: 50px;
                color: #002a8d;
                text-align: center;
                padding: 10px auto;
                margin-top: -10px !important;
                border-bottom: 2px solid transparent;
                border-bottom: 2px solid #002a8d;
                margin-bottom: 10px;
            }

                form div h3 {
                    margin-top: 50px;
                    margin-bottom: 0px;
                }

            form label {
                padding-left: 5px;
                float: left;
                margin: 13px auto;
            }

            form input {
                padding: 5px;
                border-radius: 5px;
                border: 2.5px solid grey;
                border-radius: 5px;
                max-width: 160px;
                margin: 10px auto;
                margin-right: 10px;
                float: right;
            }

        .submit {
            height: 40px;
            font-size: 16px;
            border: 2px solid transparent;
            border-radius: 5px;
            background: #002a8d;
            font-weight: bold;
            color: white;
            margin-top: 20px;
            margin-right: 100px !important;
            width: 120px;
        }

        table {
            max-width: 600px;
            width: 80%;
            border: 2px solid black;
            margin-top: 30px;
            text-align: center;
            padding: 5px;
            background: white;
            color: black;
            border-collapse: collapse;
            margin: 30px auto 0px;
        }

            table thead {
                font-size: 20px;
                font-weight: bold;
                border: 1px solid black;
                width: 200px;
                color: black;
            }

            table tr {
                border: 1px solid black;
                color: black;
            }

                table tr td {
                    color: black;
                    font-weight: bold;
                    border: 1px solid black;
                }

        h2 {
            margin: 30px auto 10px;
            width: 200px;
        }

        h1 {
            width: 800px;
            margin: 30px auto 0px;
            text-align: center;
        }
    </style>
</head>
<body>


    <h1>CRUD APPLICATION</h1>
    <?php
    $conn= mysqli_connect("localhost", "root", "", "mafaza");
    //    $sql1= "delete from students where std_id=04";
    $sql= "select * from students";

    //    if(mysqli_query($conn, $query))
    //    {
    //        echo "Record inserted successfully!";
    //    }
    //    else{
    //        echo "Error inserting record ".mysqli_connect_error();
    //    }
    $result= mysqli_query($conn, $sql);
    if(isset($_POST['submit']))
    {
    if(!empty($_POST['id'] && $_POST['name']))
    {
    $name =$_POST['name'];
    $id=$_POST['id'];
    $sql= "Update students set std_name ='$name' where std_id ='$id';";

    if(mysqli_query($conn, $sql))
    {
    echo "record inserted successfully!";

    }
    else {
    echo "Error inserting records!".mysqli_connect_error();
    }

    }

    }


    ?>
    <form action="#" method="POST">
        <div><h3>Records Table</h3></div>

        <label for="id">Enter your ID:</label>
        <input type="number" name="id">
        <br>
        <label for="name">Enter your Name:</label>
        <input type="text" name="name">
        <br>
        <input type="submit" name="submit" class="submit" value="Add Record">
    </form>
    <h2 margin="0px auto" color="Black">Students Table</h2>
    <table cellpadding="1" cellspacing="1">
        <tr>
        <thead>
        <td>ID</td>
        <td>Name</td></thead></tr>

        <tr>
            <?php

            while ($rows= mysqli_fetch_assoc($result))
            {

            ?>
            <td><?php echo $rows['std_id'] ?></td>
            <td><?php echo $rows['std_name'] ?></td>
        </tr>

        <?php } ?>

    </table>
</body>
</html>