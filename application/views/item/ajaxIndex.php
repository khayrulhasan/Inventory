<div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $key => $value) { ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value->fld_item_name; ?></td>
                    <td><?php echo $value->fld_description; ?></td>
                    <td><?php echo $value->fld_type; ?></td>
                    <td>
                        <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/editForm/<?php echo $value->fld_id; ?>"   data-toggle="tooltip"  title="Edit Item" modal-head="Edit Item Form" class="dynamicFormModal btn-sm btn btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                        <button type="button"  data-action=""   data-toggle="tooltip"  title="Add Item" modal-head="Add Item Form" class="dynamicFormModal btn-sm btn btn-danger"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>  
</div>

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        } );
    });
</script>