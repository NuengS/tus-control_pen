<?php
require_once './templates/header.php';
?>
<div class="text-center">
<svg class="barcode" jsbarcode-value="<?php echo $_GET["id"] ?>" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold">></svg>
</div>
    <script type="text/javascript">
        JsBarcode(".barcode").init();
    </script>

</div>
</div>
<?php
require_once './templates/footer.php';
?>