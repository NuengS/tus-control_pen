<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>
    <script>
    $(document).ready(function() {
        $('.employee_data').DataTable();
    });
    </script>
</head>

<body>


    <?php

// Create connection
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM (((employee 
    INNER JOIN department
    ON employee.dept_id = department.dept_id)
    INNER JOIN work_type
    ON employee.work_type_id = work_type.work_type_id)
    INNER JOIN emp_type
    ON employee.emp_type_id = emp_type.emp_type_id);";
$result = mysqli_query($connect, $sql);
?>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered employee_data">
                <thead>
                    <td>id</td>
                    <td>name</td>
                    <td>เพศ</td>
                    <td>แผนก/ฝ่ายขาย</td>
                    <td>ประเภทของงาน</td>
                    <td>ประเภทของพนักงงาน</td>
                    <td>action</td>
                </thead>
        </div>
    </div>
    <?php
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    
    while($row = mysqli_fetch_assoc($result)) {
        if($row["gender"]=="M"){
            $row["gender"]="ชาย";
        }else {
            $row["gender"]="หญิง";
        }
        echo '
        <tr>
        <td>'. $row["emp_id"].'</td>
        <td>'. $row["emp_name"].'</td>
        <td>'. $row["gender"].'</td>
        <td>'. $row["dept_name"].'</td>
        <td>'. $row["work_type_name"].'</td>
        <td>'. $row["emp_type"].'</td>
        <td><a href="#?'. $row["emp_id"].'">Edit</a></td>
        </tr>
        ';
    }
} else {
    echo "0 results";
}


mysqli_close($connect);
?>
    </table>
    <div class="container-login100-form-btn">
        </br><a href="emp_form.php">ADD</a>
    </div>
    <?php
    // Create connection
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM department";
$result = mysqli_query($connect, $sql);
?>
    <div class="container">
        <div class="table-responsive" style="width:500px">
            <table class="table table-striped table-bordered employee_data">
                <thead>
                    <td>id</td>
                    <td>name</td>

                </thead>
        </div>
    </div>
    <?php

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
        <td>'. $row["dept_id"].'</td>
        <td>'. $row["dept_name"].'</td>
        </tr>
        ';
    }
} else {
    echo "0 results";
}


mysqli_close($connect);

?>
    </table>

    <div class="container-login100-form-btn">
        </br><a href="emp_form.php">ADD</a>
    </div>
    <?php
    // Create connection
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM emp_type";
$result = mysqli_query($connect, $sql);
?>
    <div class="container">
        <div class="table-responsive" style="width:400px; padding:5px">
            <table class="table table-striped table-bordered employee_data">
                <thead>
                    <td>id</td>
                    <td>type</td>
                </thead>
        </div>
    </div>
    <?php
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
        <td>'. $row["emp_type_id"].'</td>
        <td>'. $row["emp_type"].'</td>
        </tr>
        ';
    }
} else {
    echo "0 results";
}


mysqli_close($connect);
?>
    </table>
    <div class="container-login100-form-btn">
        </br><a href="emp_form.php">ADD</a>
    </div>
    <?php
    // Create connection
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM work_type";
$result = mysqli_query($connect, $sql);
?>
    <div class="container">
        <div class="table-responsive" >
            <table class="table table-striped table-bordered employee_data">
                <thead>
                    <td>id</td>
                    <td>name</td>

                </thead>
        </div>
    </div>
    <?php
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '
        <tr>
        <td>'. $row["work_type_id"].'</td>
        <td>'. $row["work_type_name"].'</td>
        </tr>
        ';
    }
    
} else {
    echo "0 results";
}


mysqli_close($connect);
?>
    </table>
    <div class="container-login100-form-btn">
        </br><a href="emp_form.php">ADD</a>
    </div>

</body>

</html>