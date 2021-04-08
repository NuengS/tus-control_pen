<?php
require_once '../../templates/header.php';

// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../user.php';

if (!isset($_SESSION['username'])) {
    $objUser->redirect('../../index.php');
}

$objUser = new User();
// POST
if (isset($_POST['btn_up'])) {
    $emp_id   = strip_tags($_POST['emp_id']);
    $emp_name  = strip_tags($_POST['emp_name']);
    $gender   = strip_tags($_POST['gender']);
    $dept_id  = strip_tags($_POST['dept_id']);
    $work_type_id   = strip_tags($_POST['work_type_id']);
    $emp_type_id  = strip_tags($_POST['emp_type_id']);

    try {
        $sql = "UPDATE employee SET emp_id = '$emp_id', emp_name = '$emp_name', gender = '$gender', dept_id ='$dept_id',work_type_id = '$work_type_id', emp_type_id = '$emp_type_id' WHERE emp_id ='" . $_GET["id"] . "' ";
        $stmt = $objUser->runQuery($sql);
        $stmt->execute();
        if ($stmt) {
            $objUser->redirect('../../pen_index.php');
        } else {
            $objUser->redirect('emp_index.php?error');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
require_once '../../templates/sidebar.php';
?>


    <div class="container">
        <form method="post">
            <div>
                <label for="emp_id">รหัสพนักงาน *</label>
                <?php

                $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="emp_id" id="emp_id" autofocus placeholder="รหัสตามบัตรพนักงาน" required value="<?php print($rows['emp_id']) ?>">
                <?php
                    }
                }
                ?>
            </div>
            <div>
                <label for=”emp_name” placeholder="ชื่อนามสกุล พนักงาน">ชื่อ นามสกุล</label>
                <?php

                $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="emp_name" id="emp_name" placeholder="ชื่อนามสกุล พนักงาน" required value="<?php print($rows['emp_name']) ?>">
                <?php
                    }
                }
                ?>

            </div>
            <div>
                <?php

                $sql = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <label for="gender">เพศ *</label><br>
                        <input type="radio" id="female" name="gender" value="F" <?php echo ($rows['gender'] == 'F') ? 'checked' : '' ?>>
                        <label for="female">หญิง</label><br>
                        <input type="radio" id="male" name="gender" value="M" <?php echo ($rows['gender'] == 'M') ? 'checked' : '' ?>>
                        <label for="male">ชาย</label><br>
                <?php
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="dept_id">แผนก/ฝ่าย *</label>
                <select name="dept_id" id="dept_id" class="form-control">
                    <?php
                    $sql = "SELECT * FROM department";
                    $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                    $stmt = $objUser->runQuery($sql);
                    $stmt2 = $objUser->runQuery($sql2);
                    $stmt->execute();
                    $stmt2->execute();
                    if ($stmt2->rowCount() > 0) {
                        while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            if ($stmt->rowCount() > 0) {
                                while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                                    <option value="<?php print($rows['dept_id']) ?>" <?php if ($rows2['dept_id'] == $rows['dept_id']) {echo "selected='selected'";} ?>><?php print($rows['dept_name']) ?></option>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dept_id">work_type *</label>
                <select name="work_type_id" id="work_type_id" class="form-control">
                    <?php
                    $sql = "SELECT * FROM work_type";
                    $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                    $stmt = $objUser->runQuery($sql);
                    $stmt2 = $objUser->runQuery($sql2);
                    $stmt->execute();
                    $stmt2->execute();
                    if ($stmt2->rowCount() > 0) {
                        while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            if ($stmt->rowCount() > 0) {
                                while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                                    <option value="<?php print($rows['work_type_id']) ?>" <?php if ($rows2['work_type_id'] == $rows['work_type_id']) {echo "selected='selected'";} ?>><?php print($rows['work_type']) ?></option>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dept_id">emp_type *</label>
                <select name="emp_type_id" id="emp_type_id" class="form-control">

                    <?php
                    $sql = "SELECT * FROM emp_type";
                    $sql2 = "SELECT * FROM employee WHERE emp_id='" . $_GET["id"] . "'";
                    $stmt = $objUser->runQuery($sql);
                    $stmt2 = $objUser->runQuery($sql2);
                    $stmt->execute();
                    $stmt2->execute();
                    if ($stmt2->rowCount() > 0) {
                        while ($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            if ($stmt->rowCount() > 0) {
                                while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                                    <option value="<?php print($rows['emp_type_id']) ?>" <?php if ($rows2['emp_type_id'] == $rows['emp_type_id']) {echo "selected='selected'";} ?>><?php print($rows['emp_type']) ?></option>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="btn_up" value="Save">
    </div>
    </form>
    </div>


    <?php 
require_once '../../templates/footer.php';
?>