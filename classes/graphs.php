<?php
 
 $connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
 // Check connection
 if (!$connect) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 $a = $sql = "SELECT COUNT(*) FROM employee WHERE dept_id = 01 AND work_type_id = 01 ";
 $dataPoints1 = array(
	array("label"=> "บัญชีรายวัน", "y"=> $a),
	array("label"=> "บัญชีรายเดือน", "y"=> $quere = "SELECT COUNT(*) as number FROM employee WHERE dept_id = 02 AND work_type_id = 01 "),
    array("label"=> "ขายรายวัน", "y"=> $sql = "SELECT COUNT(*) FROM employee WHERE dept_id = 01;"),
	array("label"=> "ขายรายเดือน", "y"=> 4),
    array("label"=> "บุคคลรายวัน", "y"=> 4),
	array("label"=> "บุคคลรายเดือน", "y"=> 4),
);

	
?>
<!DOCTYPE HTML>
<html>

<head>
    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "กราฟแสดงจำนวนของแผนกตามประเภทของพนักงาน"
            },
            axisY: {
                includeZero: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "Real Trees",
                indexLabel: "{y}",
                yValueFormatString: "$#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
    </script>
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
</head>
<?php
 require_once 'sidebar.php';
?>

<body>
    <div id="chartContainer" style="height: 370px; width: 60%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>