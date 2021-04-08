<?php
require_once '../../templates/header.php';

// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once '../../classes/user.php';

if (!isset($_SESSION['username'])) {
    $objUser->redirect('../../index.php');
}

$objUser = new User();
// POST
if (isset($_POST['btn_save'])) {
    $dept_id   = strip_tags($_POST['dept_id']);
    $dept_name  = strip_tags($_POST['dept_name']);

    try {
        $sql = "INSERT INTO department (dept_id,dept_name) VALUES($dept_id,'$dept_name')";
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
                <label for="dept_id">ID *</label>
                <input type="text" name="dept_id" id="dept_id" autofocus placeholder="ID" required>
            </div>
            <div>
                <label for=”dept_name” placeholder="dept_name">แผนก/ฝ่าย</label>
                <input type="text" name="dept_name" id="dept_name" placeholder="แผนก/ฝ่าย" required>
            </div>

            <input type="submit" name="btn_save" value="Save">
        </form>
    </div>


    <?php 
require_once '../../templates/footer.php';
?>