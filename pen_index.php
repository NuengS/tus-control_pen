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
    <div class="row">
        <div class="col">
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Department', <?php $sql = "SELECT COUNT(*) as total FROM department";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Employee', <?php $sql = "SELECT COUNT(*) as total FROM employee";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Emp_type', <?php $sql = "SELECT COUNT(*) as total FROM emp_type";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Users', <?php $sql = "SELECT COUNT(*) as total FROM users";
                                    $stmt = $objUser->runQuery($sql);
                                    $stmt->execute();
                                    $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                    echo $total['total'];
                                    ?>],
                        ['Work_type', <?php $sql = "SELECT COUNT(*) as total FROM work_type";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                    ]);

                    var options = {
                        title: 'Demo'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
            </script>

            <div id="piechart" style="height: 500px;"></div>
        </div>

        <div class="col">
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Year', 'Sales'],
                        ['Department', <?php $sql = "SELECT COUNT(*) as total FROM department";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Employee', <?php $sql = "SELECT COUNT(*) as total FROM employee";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Emp_type', <?php $sql = "SELECT COUNT(*) as total FROM emp_type";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                        ['Users', <?php $sql = "SELECT COUNT(*) as total FROM users";
                                    $stmt = $objUser->runQuery($sql);
                                    $stmt->execute();
                                    $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                    echo $total['total'];
                                    ?>],
                        ['Work_type', <?php $sql = "SELECT COUNT(*) as total FROM work_type";
                                        $stmt = $objUser->runQuery($sql);
                                        $stmt->execute();
                                        $total = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $total['total'];
                                        ?>],
                    ]);

                    var options = {
                        chart: {
                            title: 'Demo',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="height: 500px;"></div>
        </div>
    </div>


</div>



<?php
require_once './templates/footer.php';
?>