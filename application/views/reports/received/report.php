<style>
    .btn-info {
        border: none;
    } 
    table.table-bordered tfoot td {
        border-top: 1px solid black
    }
    table.table-bordered tbody tr:trnth-child(even) {background: #CCC; border: 1px solid red;}
    table.table-bordered tbody tr:nth-child(odd) {background: #FFF}
</style>

<center><h2 style="text-decoration: underline">Received :</h2></center><br/>

<?php
foreach ($category as $key => $value) {
    $result = $this->db->query("SELECT a.*, (SELECT d.LOOKUP_DATA_NAME FROM sa_lookup_data d WHERE d.LOOKUP_DATA_ID = c.fld_unit ) AS unit,  c.fld_item_name , c.fld_ledger_page  FROM im_distribution a LEFT JOIN sa_item c ON c.fld_id = a.item_id  WHERE  c.fld_type=215 AND a.category_id = {$value->category_id} AND a.user_id = {$id}")->result_array();
    if (!empty($result)) {
        ?>
        <center><h3 style="text-decoration: underline">Consumable List</h3></center>
        <h3><?php echo "<br/><br/> -------" . "   " . $value->parentName . " ---------<br/>"; ?></h3>
        <h3><?php echo " -------" . "   " . $value->categoryName . " " . "---------<br/><br/>"; ?></h3>
        <table id="example1" class="table table-bordered table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th style="float: left">Serial</th>
                    <th style="float: left">Page</th>
                    <th style="float: left">Item-Name</th>
                    <th style="float: left">Description</th>
                    <th style="float: left">Quantity</th>
                    <th style="float: left">Unit</th>
                    <th style="float: left; margin-left: 10px">Date</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($result as $serial => $item) {
                    ?>
                    <tr>
                        <?php $sum +=$item['quantity']; ?>
                        <td style="float: left;"><?php echo $serial + 1 ?></td>
                        <td style="float: left"><?php echo $item['fld_ledger_page']; ?></td>
                        <td style="float: left"><?php echo $item['fld_item_name']; ?></td>
                        <td style="float: left"><?php echo $item['remarks']; ?></td>
                        <td style="float: left"><?php echo $item['quantity']; ?></td>
                        <td style="float: left"><?php echo $item['unit']; ?></td>
                        <td style="float: left; margin-left: 10px"><?php echo $item['cre_date']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: 900">Total Quantity</td>
                    <td style="font-weight: 900" ><?php
        echo number_format($sum);
        $sum = "0"
                ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>      
    <?php }
}
?>

<br/>
<br/>
<br/>


<?php
foreach ($category as $key => $value) {
    $result = $this->db->query("SELECT a.*, (SELECT d.LOOKUP_DATA_NAME FROM sa_lookup_data d WHERE d.LOOKUP_DATA_ID = c.fld_unit ) AS unit,  c.fld_item_name, c.fld_ledger_page  FROM im_distribution a LEFT JOIN sa_item c ON c.fld_id = a.item_id  WHERE  c.fld_type=216 AND a.category_id = {$value->category_id} AND a.user_id = {$id}")->result_array();
    if (!empty($result)) {
        ?>
        <center><h3 style="text-decoration: underline">Inconsumable List</h3></center>
        <h3><?php echo "<br/><br/> -------" . "   " . $value->parentName . " ---------<br/>"; ?></h3>
        <h3><?php echo " -------" . "   " . $value->categoryName . " " . "---------<br/><br/>"; ?></h3>
        <table id="example1" class="table table-bordered table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th style="float: left">Serial</th>
                    <th style="float: left">Page</th>
                    <th style="float: left">Item-ID</th>
                    <th style="float: left">Item-Name</th>
                    <th style="float: left">Description</th>
                    <th style="float: left">Quantity</th>
                    <th style="float: left">Unit</th>
                    <th style="float: left; margin-left: 10px">Date</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($result as $serial => $item) {
                    ?>
                    <tr>
            <?php $sum +=$item['quantity']; ?>
                        <td style="float: left;"><?php echo $serial + 1 ?></td>
                        <td style="float: left"><?php echo $item['fld_ledger_page']; ?></td>
                        <td style="float: left"><?php echo $item['fld_item_serial_number']; ?></td>
                        <td style="float: left"><?php echo $item['fld_item_name']; ?></td>
                        <td style="float: left"><?php echo $item['remarks']; ?></td>
                        <td style="float: left"><?php echo $item['quantity']; ?></td>
                        <td style="float: left"><?php echo $item['unit']; ?></td>
                        <td style="float: left; margin-left: 10px"><?php echo $item['cre_date']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: 900">Total Quantity</td>
                    <td style="font-weight: 900" ><?php
        echo number_format($sum);
        $sum = "0"
                ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>      
    <?php }
} ?>


