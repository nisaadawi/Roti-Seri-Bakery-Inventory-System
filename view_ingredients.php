<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM ingredients where id =
" . $_GET['id'])->fetch_array();
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>
<div class="container-fluid">
    <table class="table">
        <tr>
            <th>Ingredient Code:</th>
            <td><b><?php echo ucwords($ingredient_code) ?></b></td>
        </tr>
        <tr>
            <th>Ingredient Name:</th>
            <td><b><?php echo $ingredient_name ?></b></td>
        </tr>
        <tr>
            <th>Category:</th>
            <td><b><?php echo $category ?></b></td>
        </tr>
        <tr>
            <th>Current Quantity:</th>
            <td><b><?php echo $current_quantity ?></b></td>
        </tr>
        <tr>
            <th>Measurement:</th>
            <td><b><?php echo $measurement ?></b></td>
        </tr>
        <tr>
            <th>Supplier Detail:</th>
            <td><b><?php echo $supplier_detail ?></b></td>
        </tr>
        <tr>
            <th>Expiration Date:</th>
            <td><b><?php echo date('Y-m-d', strtotime($expiration_date)) ?></b></td>
        </tr>
        <!-- <tr>
            <th>Track Status:</th>
            <td><b><?php echo $track_out ?></b></td>
        </tr> -->
    </table>
</div>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
    #uni_modal .modal-footer {
        display: none
    }

    #uni_modal .modal-footer.display {
        display: flex
    }
</style>