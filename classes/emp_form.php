<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'user.php';

$objUser = new User();
// POST
if(isset($_POST['btn_save'])){
    $emp_id   = strip_tags($_POST['emp_id']);
    $emp_name  = strip_tags($_POST['emp_name']);
    $gender   = strip_tags($_POST['gender']);
    $dept_id  = strip_tags($_POST['dept_id']);
    $work_type_id   = strip_tags($_POST['work_type_id']);
    $emp_type_id  = strip_tags($_POST['emp_type_id']);
  
    try{
        if($objUser->insert($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)){
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

    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">

</head>

<body>
<div class="container">
    <form method="post">
        <div class="form-group">
            </br>
            <div class="form-group row">
                <div class="col-3 col-form-label">
                    <label for="emp_id">รหัสพนักงาน *</label>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" name="emp_id" id="emp_id" autofocus
                        placeholder="รหัสตามบัตรพนักงาน" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-3 col-form-label">
                    <label for=”emp_name” placeholder=”ชื่อนามสกุล พนักงาน”>ชื่อ นามสกุล</label>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" name="emp_name" id="emp_name" autofocus
                        placeholder="ชื่อ นามสกุล" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-3" for="gender">เพศ *</label>
                <div class="col-4">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input class="custom-control" type="radio" id="female" checked name="gender" value="F">

                        <label for="female">หญิง</label>
                    </div>


                    <div class="custom-control custom-radio custom-control-inline">

                        <input class="custom-control" type="radio" id="male" name="gender" value="M">
                        <label for="male">ชาย</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-3 col-form-label" for="dept_id">แผนก/ฝ่าย *</label>
                <div class="col-9">
                    <select name="dept_id" id="dept_id" class="custom-select">
                        <?php    
                $sql = "select * from department";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <option value="<?php print($rows['dept_id']) ?>"><?php print($rows['dept_name']) ?></option>
                        <?php 
                    } 
                }
                ?>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="work_type_id">ประเภทของงาน *</label>
                <div class="col-9">
                    <select name="work_type_id" id="work_type_id" class="custom-select">
                        <?php    
                $sql = "select * from work_type";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <option value="<?php print($rows['work_type_id']) ?>">
                            <?php print($rows['work_type_name']) ?></option>

                        <?php 
                    } 
                }
                ?>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label" for="emp_type_id">ประเภทของพนักงาน *</label>
                <div class="col-9">
                    <select name="emp_type_id" id="emp_type_id" class="custom-select">
                        <?php    
                $sql = "select * from emp_type";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <option value="<?php print($rows['emp_type_id']) ?>"><?php print($rows['emp_type']) ?>
                        </option>
                        <?php 
                    } 
                }
                ?>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-3 col-9">
                    <button class="btn btn-primary" type="submit" name="btn_save" value="Save">
                        Save
                    </button>
                </div>
            </div>

        </div>
    </form>
    </div>
</body>

</html>