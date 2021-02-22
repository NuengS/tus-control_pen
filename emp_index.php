<!DOCTYPE html>
<html>
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

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["emp_id"]. 
        " - Name: " . $row["emp_name"]. "gender" . $row["gender"]. 
        "แผนก/ฝ่าย" . $row["dept_name"]. 
        "ประเภทของงาน" . $row["work_type_name"].
        "ประเภทของพนักงงาน" . $row["emp_type"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($connect);
?>

</body>
</html>
