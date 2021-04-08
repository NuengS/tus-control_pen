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
    $emp_type_id   = strip_tags($_POST['emp_type_id']);
    $emp_type  = strip_tags($_POST['emp_type']);

    try {
        $sql = "UPDATE emp_type SET emp_type_id = '$emp_type_id', emp_type = '$emp_type' WHERE emp_type_id ='" . $_GET["id"] . "' ";
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
                <label for="emp_type_id">emp_type_id *</label>
                <?php

                $sql = "SELECT * FROM emp_type WHERE emp_type_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="emp_type_id" id="emp_type_id" autofocus placeholder="รหัสตามบัตรพนักงาน" required value="<?php print($rows['emp_type_id']) ?>">
                <?php
                    }
                }
                ?>
            </div>
            <div>
                <label for=”emp_type” placeholder="emp_type">emp_type</label>
                <?php

                $sql = "SELECT * FROM emp_type WHERE emp_type_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="emp_type" id="emp_type" placeholder="ชื่อนามสกุล พนักงาน" required value="<?php print($rows['emp_type']) ?>">
                <?php
                    }
                }
                ?>

            </div>

    <input type="submit" name="btn_up" value="Save">
    </form>
    </div>


    <?php 
require_once '../../templates/footer.php';
?>