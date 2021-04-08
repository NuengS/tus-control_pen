<?php
require_once './classes/user.php';
$objUser = new User();

$id = $_POST['id'];
$tabel = $_POST['tabel'];

if (isset($_POST['btn_sub'])) {
    try {
        $sql = "DELETE FROM employee WHERE $tabel = '$id' ";
        $stmt = $objUser->runQuery($sql);
        $stmt->execute();
        // header("Refresh:0");
    } catch (PDOException $e) {
        echo $sql . "
" . $e->getMessage();
    }
}


?>