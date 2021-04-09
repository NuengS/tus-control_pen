<?php
require_once __DIR__ . '/vendor/autoload.php';
$connect = new mysqli('localhost', 'root', '', 'tus-control_pen');
// Check connection
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'format' => 'A4',
  'margin_left' => 15,
  'margin_right' => 15,
  'margin_top' => 16,
  'margin_bottom' => 16,
  'margin_header' => 9,
  'margin_footer' => 9,
  'mirrorMargins' => true,

  'fontDir' => array_merge($fontDirs, [
    __DIR__ . 'vendor/mpdf/mpdf/custom/font/directory',
  ]),
  'fontdata' => $fontData + [
    'thsarabun' => [
      'R' => 'THSarabunNew.ttf',
      'I' => 'THSarabunNew Italic.ttf',
      'B' => 'THSarabunNew Bold.ttf',
      'U' => 'THSarabunNew BoldItalic.ttf'
    ]
  ],
  'default_font' => 'thsarabun',
  'defaultPageNumStyle' => 1
]);

$mpdf->setFooter('{PAGENO}');

$tableh1 = '
	

	<h2 style="text-align:center">รายงานจำนวนพนักงาน</h2>
  <h3 style="text-align:center;padding-top:-20px">ณ วันที่ 7 เมษายน 2564</h3>

	<table id="bg-table"  style="border-collapse: collapse;font-size:12pt;margin-top:8px;width:100%">
	    <tr style="border:1px solid #000;padding:4px;" >
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;width:15%"   width="10%">ลำดับ</td>
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;width:40%"  width="15%">ฝ่าย/แผนก</td>
	        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;width:15%">&nbsp; จำนวน </td>
	    </tr>

	</thead>
		<tbody>';
$s = 1;

$query = "SELECT count(*) as present_absent_count, dept_id,
    case
        when dept_id = 01 then 'บัญชี'
        when dept_id = 02 then 'ขาย'
        when dept_id = 03 then 'บุคคล'
      end as dept_id FROM employee GROUP BY dept_id ;";
$result = mysqli_query($connect, $query);

$result = mysqli_query($connect, $query);

$content = "";

foreach ($result as $rs) {

  $tablebody .= '<tr style="border:1px solid #000;width:50%">
				<td style="border-right:1px solid #000;padding:3px;text-align:center;width:15%"  >' . $s++ . '</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;width:40%">' . $rs['dept_id'] . '</td>
				<td style="border-right:1px solid #000;padding:3px;text-align:center;width:15%">' . $rs['present_absent_count'] . '</td>
        
			</tr>';
  @$present_absent_count_total += $rs['present_absent_count'];
}


$tableend1 = "</tbody>
</table>";

$total = '

<h3 style="padding-left:500px">จำนวนพนักงงานทั้งหมด : ' . $present_absent_count_total . ' คน</h3>
';










$fordev22 = '
<style>
  div {}

  table {


    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    font-size: 18px;
    border: 1px solid #AED6F1;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #F5FFFA;
  }
</style>

<div style="text-align:center;">
  <img width="250" src="logo.jpg" style="vertical-align: middle; 
  width: 250px;">

</div>
</div>

';






$mpdf->WriteHTML($fordev22);


$mpdf->WriteHTML($tableh1);

$mpdf->WriteHTML($tablebody);




$mpdf->WriteHTML($tableend1);

$mpdf->WriteHTML($total);
$mpdf->Output($output, 'I');
