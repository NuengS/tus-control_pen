<head>
<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
    </script>
</head>
    <body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5>Popover in a modal</h5>
        <p>This <a href="#" role="button" class="btn btn-secondary popover-test" title="Popover title" data-content="Popover body content is set in this attribute.">button</a> triggers a popover on click.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<body>
<?php
require_once 'user.php';

$objUser = new User();

if(isset($_SESSION['username'])){
    $objUser -> redirect ('index.php');
}
 try{
    $sql = "DELETE FROM employee WHERE emp_id='".$_GET['id']."'";

    $stmt = $objUser->runQuery($sql);
    $stmt -> execute();
    $objUser -> redirect('emp_index.php');


 }catch(PDOException $e)
 {
     echo $sql."
     ". $e->getMessage();
 }


$conn = null;
?>
