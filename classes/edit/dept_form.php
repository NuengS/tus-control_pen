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
    $dept_id   = strip_tags($_POST['dept_id']);
    $dept_name  = strip_tags($_POST['dept_name']);

    try {
        $sql = "UPDATE department SET dept_id = '$dept_id', dept_name = '$dept_name' WHERE dept_id ='" . $_GET["id"] . "' ";
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
    <div class="col-sm">
        <form method="post">
            <div class="md-3">
                <label for="dept_id" class="form-label">ID *</label>
                <?php

                $sql = "SELECT * FROM department WHERE dept_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="dept_id" id="dept_id" class="form-control" autofocus placeholder="ID" required value="<?php print($rows['dept_id']) ?>">
                <?php
                    }
                }
                ?>
            </div>
            <div class="md-3 mt-2">
                <label for=”dept_name” class="form-label" placeholder="dept_name">แผนก/ฝ่าย</label>
                <?php

                $sql = "SELECT * FROM department WHERE dept_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="แผนก/ฝ่าย" required value="<?php print($rows['dept_name']) ?>">
                <?php
                    }
                }
                ?>

            </div>

            <input type="submit" name="btn_up" value="Save" class="btn btn-primary mt-3">
        </form>
    </div>

</div>


<?php
require_once '../../templates/footer.php';
?>