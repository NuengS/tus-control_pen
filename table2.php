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

<script type="text/javascript">
    function load_id(id, tabel) {
        var post = new Object();
        post.id = id
        post.tabel = tabel

        $('#contianer_modals').load('del.php', post, function() {
            $("#exampleModal").modal('show');
        });
    }
</script>

<div id="contianer_modals"></div>

<?php
require_once './templates/sidebar.php';
?>

<div class="mt-3">

    <div class=" mx-auto" style="margin-top: 30px; text-align: center;">

        <div class="row">
            <div class="col w-50">
                <div class="card w-50 p-3 mx-auto" style="margin-top: 50px;">
                    <table class="display table_id" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">แผนก/ฝ่าย</th>
                                <th scope="col">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM department";
                            $stmt = $objUser->runQuery($sql);
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php print($rows['dept_id']) ?></th>
                                        <td><?php print($rows['dept_name']) ?></td>
                                        <td><a class="btn btn-warning" href="./classes/edit/dept_form.php?id=<?php echo $rows["dept_id"]; ?>"">Edit</a>
                                            <button class=" btn btn-danger" onclick="load_id ('<?php echo $rows['dept_id']; ?>','department') ">
                                                Del
                                                </button>
                                        </td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-success mt-3" style="Width : 100px;" href="./classes/add/dept_form.php" role="button">Add</a>
                    </div>
                </div>
            </div>

        </div>







    </div>



    <?php
    require_once './templates/footer.php';
    ?>