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
<center>
    <h2 style="text-decoration: underline">Item :</h2>
</center>
<br/>
<center><h3 style="text-decoration: underline">Consumable List</h3></center>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 100px">Serial</th>
            <th style="width: 100px">Page</th>
            <th>Name</th>
            <th style="width: 80px">Unit</th>
            <th style="width: 80px">Type</th>
            <th style="width: 120px">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listc as $key => $value) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value->fld_ledger_page; ?></td>
                <td><?php echo $value->fld_item_name; ?></td>
                <td><?php echo $value->unit; ?></td>
                <td><?php echo $value->type; ?></td>
                <td><?php echo $value->fld_cre_date; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>  
<br/>
<br/>
<br/>
<br/>
<center><h3 style="text-decoration: underline">Inconsumable List</h3></center>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 100px">Serial</th>
            <th style="width: 100px">Page</th>
            <th style="float: left">Item-ID</th>
            <th>Name</th>
            <th style="width: 80px">Unit</th>
            <th style="width: 80px">Type</th>
            <th style="width: 120px">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listi as $key => $value) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value->fld_ledger_page; ?></td>
                <td style="float: left"><?php echo $item['fld_item_serial_number']; ?></td>
                <td><?php echo $value->fld_item_name; ?></td>
                <td><?php echo $value->unit; ?></td>
                <td><?php echo $value->type; ?></td>
                <td><?php echo $value->fld_cre_date; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>  