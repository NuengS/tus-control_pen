<?php

$connect = mysqli_connect("localhost", "root", "", "tus-control_pen");
$query = "SELECT count(*) as present_absent_count, dept_id,
     case
         when dept_id = 01 then 'บัญชี'
         when dept_id = 02 then 'ขาย'
         when dept_id = 03 then 'บุคคล'
       end as dept_id FROM employee GROUP BY dept_id ;";
$result = mysqli_query($connect, $query);
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["dept_id"];
    $count[$i] = $row["present_absent_count"];
    $i++;
}

?>
<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graph</title>
    <style>
        body {
            width: 660px;
            margin: 0 auto;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
        $(document).ready(function() {
            $('.employee_data').DataTable();
        });
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawPieChart);

        function drawPieChart() {
            var pie = google.visualization.arrayToDataTable([
                ['attendancede', 'Numbder'],
                ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
                ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
                ['<?php echo $label[2]; ?>', <?php echo $count[2]; ?>],

            ]);
            var header = {
                title: 'Number of employees for each pass',
                slices: {
                    0: {
                        color: '#666666'
                    },
                    1: {
                        color: '#006EFF'
                    }
                }

            };
            var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
            piechart.draw(pie, header);
        }
    </script>
</head>
<?php
require_once 'sidebar.php';
?>

<body>

    </br>
    <h3>จำนวนพนักงานแต่ละฝ่าย</h3>
    <div id="piechart"></div>

    <div class="col-sm-12">
        <h3>List</h3>
        <table class="table table-striped" border="1" cellpadding="0" cellspacing="0" align="center">
            <thead>
                <tr class="table-primary">
                    <th width="20%">ลำดับ</th>
                    <th width="50%">ฝ่าย/แผนก</th>
                    <th width="10%">
                        <center>จำนวน</center>
                    </th>
                </tr>
            </thead>


            <?php

            $sql = "SELECT count(*) as present_absent_count, dept_id,
                    case
                        when dept_id = 01 then 'บัญชี'
                        when dept_id = 02 then 'ขาย'
                        when dept_id = 03 then 'บุคคล'
                      end as dept_id FROM employee GROUP BY dept_id ;";
            $result2 = mysqli_query($connect, $sql);
            $s = 1;
            while ($row2 = mysqli_fetch_array($result2)) {

            ?>

                <tr>

                    <td><?php echo $s++; ?></td>
                    <td><?php echo $row2['dept_id']; ?></td>
                    <td align="right"><?php echo number_format($row2['present_absent_count'], 0); ?></td>
                </tr>
            <?php
                @$present_absent_count_total += $row2['present_absent_count'];
            }
            ?>
            <tr class="table-danger">
                <td align="center"></td>
                <td align="center">รวม</td>
                <td align="right"><b>
                        <?php echo number_format($present_absent_count_total, 2); ?></b></td>
                </td>
            </tr>
        </table>




        <?php
        mysqli_close($connect);
        ?>
        <a href="MyReport.pdf" class="btn btn-primary">Dowload PDF </a>


</body>

</html>