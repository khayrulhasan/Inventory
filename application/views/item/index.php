<script>
    // confirm delete function
    function confirmFunction(id){
        $.ajax({
            type: "POST",
            dataType: "HTML",
            url: "<?php echo base_url() ?>index.php/setup/deleteItem",
            data: ({
                itemid: id
            }),
            success: function(data){
                $("tr td button[data-id='" + id + "']").parents('tr').remove();
            }
        });
    }

    $(document).ready(function () {
        $(".deleteFunction").click(function () {
            $.fn.nbDialogBox({
                id :$(this).attr('data-id'),
                isConfirm: true,
                body: "Are you sure, want to Delete This Item ? "
            });
        });

    });
</script>

<style>
    #message_confirmation {
        color: green;
        display: none;
    }
    .btn-warning, .btn-success, .btn-danger {
        border: none;
    }
</style>
<center><h4 id="message_confirmation">&nbsp;</h4></center>
    <div class="row">
        <a style="margin-left: 20px" href="#" data-toggle="tooltip"  title="Download CSV Format" onClick ="$('#example1').tableExport({type:'csv',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel_csv.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download XLS Format" onClick ="$('#example1').tableExport({type:'excel',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download json Format" onClick ="$('#example1').tableExport({type:'json',escape:'false'});"><img src="<?php echo base_url() ?>uploads/json.png" height="40" width="40"></a>&nbsp;
        <a href="<?php echo base_url() ?>index.php/reports/itemReportPDF" data-toggle="tooltip"  title="Download PDF Format" target="_blank"><img src="<?php echo base_url() ?>uploads/pdf.png" height="40" width="40"></a>
        <span style="float: right; margin-right: 20px"><button type="button"  data-action="<?php echo site_url("index.php/setup/create"); ?>"   data-toggle="tooltip"  title="Add Item" modal-head="Add Item Form" class="dynamicFormModal btn btn-success"><i class="fa fa-plus"></i></button></span>
    </div>
    <div class="box" id="tableContent">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 100px">Serial No.</th>
                        <th style="width: 100px">Ledger Page No</th>
                        <th>Name</th>
                        <th style="width: 80px">Unit</th>
                        <th style="width: 80px">Type</th>
                        <th style="width: 120px">Date</th>
                        <th style="width: 70px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value->fld_ledger_page; ?></td>
                            <td><?php echo $value->fld_item_name; ?></td>
                            <td><?php echo $value->unit; ?></td>
                            <td><?php echo $value->type; ?></td>
                            <td><?php echo $value->fld_cre_date; ?></td>
                            <td>
                                <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/viewItem/<?php echo $value->fld_id; ?>"   data-toggle="tooltip"  title="View Item" modal-head="View Item Form" class="dynamicFormModal btn-xs  btn-success"><i class="fa fa-eye"></i></button>
                                <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/editItem/<?php echo $value->fld_id; ?>"   data-toggle="tooltip"  title="Edit Item" modal-head="Edit Item Form" class="dynamicFormModal btn-xs  btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                                <button type="button" data-id="<?php echo $value->fld_id; ?>"  class="btn-xs btn-danger deleteFunction" data-toggle="tooltip"  title="Delete Item"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
        </div>
    </div>
<script type="text/javascript">
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
        } );
    });
</script>