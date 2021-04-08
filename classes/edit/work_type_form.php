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
    $work_type_id   = strip_tags($_POST['work_type_id']);
    $work_type  = strip_tags($_POST['work_type']);

    try {
        $sql = "UPDATE work_type SET work_type_id = '$work_type_id', work_type = '$work_type' WHERE work_type_id ='" . $_GET["id"] . "' ";
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
                <?php

                $sql = "SELECT * FROM work_type WHERE work_type_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="work_type_id" id="work_type_id" autofocus placeholder="work_type_id" required value="<?php print($rows['work_type_id']) ?>">
                <?php
                    }
                }
                ?>
            </div>
            <div>
                <label for=”work_type” placeholder="work_type">work_type</label>
                <?php

                $sql = "SELECT * FROM work_type WHERE work_type_id='" . $_GET["id"] . "'";
                $stmt = $objUser->runQuery($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <input type="text" name="work_type" id="work_type" placeholder="work_type" required value="<?php print($rows['work_type']) ?>">
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