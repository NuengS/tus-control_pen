<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/emp.php';

$objUser = new Emp();
// POST
if(isset($_POST['btn_save'])){
    $emp_type_id  = strip_tags($_POST['emp_type_id']);
    $emp_type  = strip_tags($_POST['emp_type']);
  
    try{
        if($objUser->insert($emp_type_id,$emp_type)){
          $objUser->redirect('emp_index.php?inserted');
        }else{
          $objUser->redirect('emp_index.php?error');
        }
   }catch(PDOException $e){
     echo $e->getMessage();
   }
 }
 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

</head>

<body>

    <form method="post" class="emform">
        <div class="    ">
            <label for="emp_type_id">emp_type_id *</label>
        </div>
        <div class="col-75">
            <input type="text" name="emp_type_id" id="emp_type_id" autofocus placeholder="emp_type_id" required>
        </div>
        <div class="col-25">
            <label for="emp_type" placeholder="emp_type">emp_type</label>
        </div>
        <div class="col-75">
            <input type="text" name="emp_type" id="emp_type" autofocus placeholder="emp_type" required>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="btn_save" value="Save">
                Save
            </button>
        </div>
    </form>
</body>

</html>