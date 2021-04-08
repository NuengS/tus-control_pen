<?php
require_once './templates/header.php';
require_once './classes/user.php';
$objUser = new User();

if (!isset($_SESSION['username'])) {
    $objUser->redirect('index.php');
}

?>

<script>
    $(document).ready(function() {
        $('.table_id').DataTable();
    });
</script>

<?php
require_once './templates/sidebar.php';
?>

<div class="mt-3">

    <div class=" mx-auto" style="margin-top: 30px; text-align: center;">
        <div class="card p-3 mx-auto">
            <table class="display table_id" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">เพศ</th>
                        <th scope="col">แผนก/ฝ่าย</th>
                        <th scope="col">ประเภทงาน</th>
                        <th scope="col">ประเภทพนักงาน</th>
                        <th scope="col">ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT *,CASE
                                WHEN gender = 'M'
                                   THEN 'ชาย'
                                   ELSE 'หญิง'
                           END as sex FROM employee 
                    inner join department on employee.dept_id = department.dept_id
                    inner join work_type on employee.work_type_id = work_type.work_type_id
                    inner join emp_type on employee.emp_type_id = emp_type.emp_type_id";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tr>
                                <th scope="row"><?php print($rows['emp_id']) ?></th>
                                <td><?php print($rows['emp_name']) ?></td>
                                <td><?php print($rows['sex']) ?></td>
                                <td><?php print($rows['dept_name']) ?></td>
                                <td><?php print($rows['work_type']) ?></td>
                                <td><?php print($rows['emp_type']) ?></td>
                                <td><a class="btn btn-warning" href="./classes/edit/emp_form.php?id=<?php echo $rows["emp_id"]; ?>"">Edit</a>
                            <a class=" btn btn-danger" href="./classes/del/del_emp.php?id=<?php echo $rows["emp_id"]; ?>" onclick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')">Del</a>
                                    <a class="btn btn-warning" href="./genbar.php?id=<?php echo $rows["emp_id"]; ?>"" target=" _blank">barcode</a>
                                    <form action="" method="post">
                                    <input type="text" name="id" value="<?php echo $rows["emp_id"]; ?>">
                                    <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        demo
                                    </button>
                                    </form>
                                    <!-- Button trigger modal -->
                                    
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success mt-3" style="Width : 100px;" href="./classes/add/emp_form.php" role="button">Add</a>

            </div>

        </div>
    </div>

</div>
</div>
</div>

<!-- Modal -->
<form method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คุณแน่ใจหรือไม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    คุณแน่ใจหรือไม่ที่จะลบ ID <?php echo $_POST['id'] ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_sub" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>



<?php
require_once './templates/footer.php';
?>