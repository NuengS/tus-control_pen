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
    $work_type_id   = strip_tags($_POST['work_type_id']);
    $work_type  = strip_tags($_POST['work_type']);

    try {
        $sql = "INSERT INTO work_type (work_type_id,work_type) VALUES($work_type_id,'$work_type')";
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
                <label for="work_type_id">work_type_id *</label>
                <input type="text" name="work_type_id" id="work_type_id" autofocus placeholder="work_type_id" required>
            </div>
            <div>
                <label for=”work_type” placeholder="work_type">work_type</label>
                <input type="text" name="work_type" id="work_type" placeholder="work_type" required>
            </div>

            <input type="submit" name="btn_save" value="Save">
        </form>
    </div>



<?php 
require_once '../../templates/footer.php';
?>