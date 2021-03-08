<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'user.php';

$objUser = new User();
// POST
if(isset($_POST['btn_save'])){
    $emp_type_id  = strip_tags($_POST['emp_type_id']);
    $emp_type  = strip_tags($_POST['emp_type']);
  
    try{
        $sql = "INSERT emp_type (emp_type_id,emp_type) VALUE ($emp_type_id,'$emp_type')"
        $stmt = $objUser->runQuery($sql);
        $stmt -> excute();
        }if($stmt){
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
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">

</head>

<body>
<div class="card" style="width =400px   ">
<form >
  <div class="form-group row">
  <label class="col-6 col-form-label for="emp_type_id">emp_type_id *</label> 
    <div class="col-6">
    <input class="form-control" type="text" name="emp_type_id" id="emp_type_id" autofocus placeholder="emp_type_id" required>
    </div>
  </div>
  <div class="form-group row">
  <label class="col-6 col-form-label for="emp_type_id" placeholder="emp_type_id">emp_type</label>
    <div class="col-6">
    <input class="form-control" type="text" name="emp_type" id="emp_type" autofocus placeholder="emp_type" required>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-6 col-6">
      <button name="btn_save" type="submit" class="login100-form-btn">ADD</button>
    </div>
  </div>
</form>
</div>
</body>

</html>