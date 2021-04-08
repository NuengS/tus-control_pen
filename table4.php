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
        <div class="card w-50 p-3 mx-auto" style="margin-top: 50px;">
            <table class="display table_id" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ประเภทงาน</th>
                        <th scope="col">ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM work_type";
                    $stmt = $objUser->runQuery($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tr>
                                <th scope="row"><?php print($rows['work_type_id']) ?></th>
                                <td><?php print($rows['work_type']) ?></td>
                                <td><a class="btn btn-warning" href="./classes/edit/work_type_form.php?id=<?php echo $rows["work_type_id"]; ?>"">Edit</a> 
                            <a class=" btn btn-danger" href="./classes/del/del_work_type.php?id=<?php echo $rows["work_type_id"]; ?>" onclick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')">Del</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success mt-3" style="Width : 100px;" href="./classes/add/work_type_form.php" role="button">Add</a>
            </div>

        </div>

    </div>

</div>



<?php
require_once './templates/footer.php';
?>