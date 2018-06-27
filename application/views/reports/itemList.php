<style>
th {
   text-align: left
}
</style>
<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
    <thead>
        <tr>
            <th>Serial#</th>
            <th>L.Page</th>
            <th>Item Name</th>
            <th>Item Description</th>
            <th>Unit</th>
            <th>Type</th>
            <th>Date</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Serial#</th>
            <th>L.Page</th>
            <th>Item Name</th>
            <th>Item Description</th>
            <th>Unit</th>
            <th>Type</th>
            <th>Date</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($result as $key => $value) { ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value->fld_ledger_page; ?></td>
                <td><?php echo $value->fld_item_name; ?></td>
                <td><?php echo $value->fld_description; ?></td>
                <td><?php echo $value->unit; ?></td>
                <td><?php echo $value->type; ?></td>
                <td><?php echo $value->fld_cre_date; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table> 