
<?php
require_once 'user.php';

$objUser = new User();

if(isset($_SESSION['username'])){
    $objUser -> redirect ('index.php');
}
 try{
    $sql = "DELETE FROM employee WHERE emp_id='".$_GET['id']."'";

    $stmt = $objUser->runQuery($sql);
    $stmt -> execute();
    $objUser -> redirect('emp_index.php');


 }catch(PDOException $e)
 {
     echo $sql."
     ". $e->getMessage();
 }


$conn = null;
?>
