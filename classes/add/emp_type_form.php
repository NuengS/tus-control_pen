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
    $emp_type_id   = strip_tags($_POST['emp_type_id']);
    $emp_type  = strip_tags($_POST['emp_type']);

    try {
        $sql = "INSERT INTO emp_type (emp_type_id,emp_type) VALUES($emp_type_id,'$emp_type')";
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

<body>
    <div class="container">
        <form method="post">
            <div>
                <label for="emp_type_id">emp_type_id *</label>
                <input type="text" name="emp_type_id" id="emp_type_id" autofocus placeholder="emp_type_id" required>
            </div>
            <div>
                <label for=”emp_type” placeholder="emp_type">emp_type</label>
                <input type="text" name="emp_type" id="emp_type" placeholder="emp_type" required>
            </div>

            <input type="submit" name="btn_save" value="Save">
        </form>
    </div>


</body>

</html>