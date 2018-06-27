<input type="text" id="category_id" value="<?php echo (!empty($category_id)?$category_id:0); ?>">
<input type="text" id="subcategory_id" value="<?php echo (!empty($subcategory_id)?$subcategory_id:0); ?>">
<input type="text" id="item_id" value="<?php echo (!empty($item_id)?$item_id:0); ?>">
<input type="text" id="daterange" value="<?php echo (!empty($daterange)?$daterange:0); ?>">

<script>
    ///--------------------------------------
    // confirm delete function
    function confirmFunction(id){
        $.ajax({
            type: "POST",
            dataType: "HTML",
            url: "<?php echo base_url() ?>index.php/setup/deleteGoodsReceiveItem",
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
    .modal-dialog {
        width: 55% !important;
    }
    .btn-success {
        border: none
    }
    .btn-danger {
        border: none
    }
    .btn-warning {
        border: none
    }
    /* Glyph, by Harry Roberts */

    /* Inset, by Dan Eden */

    hr.style-six {
        border: 0;
        height: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
    <div class="row">
        <span style="margin-left: 20px"><button class="btn btn-info dynamicFormModal" type="button"  data-action="<?php echo base_url() ?>index.php/setup/getFilteringForm"   data-toggle="tooltip"  title="Data Filtering" modal-head="Data Filtering Form"><i class="fa fa-filter"></i></button></span>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download CSV Format" onClick ="$('#example1').tableExport({type:'csv',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel_csv.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download XLS Format" onClick ="$('#example1').tableExport({type:'excel',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download json Format" onClick ="$('#example1').tableExport({type:'json',escape:'false'});"><img src="<?php echo base_url() ?>uploads/json.png" height="40" width="40"></a>&nbsp;
        <a id="printPdf" data-toggle="tooltip"  title="Download PDF Format" target="_blank"><img src="<?php echo base_url() ?>uploads/pdf.png" height="40" width="40"></a>&nbsp;
        <span style="float: right; margin-right: 20px"><button type="button"  data-action="<?php echo base_url() ?>index.php/setup/getGoodsReceiveForm"   data-toggle="tooltip"  title="Goods Receive" modal-head="Goods Receive Form" class="dynamicFormModal btn-sm btn-success"><i class="fa fa-plus"></i></button></span>
    </div>
    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th style="width: 70px">Serial#</th>
                        <th style="width: 150px">Category</th>
                        <th style="width: 150px">Sub Category</th>
                        <th style="width: 150px">Ledger Page</th>
                        <th style="width: 150px">Item Name</th>
                        <th style="width: 50px">Quantity</th>
                        <th>Unit</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $key => $value) { ?>
                        <tr>
                            <?php $sum +=$value->fld_history_quantity; ?>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value->parent; ?></td>
                            <td><?php echo $value->category; ?></td>
                            <td><?php echo $value->fld_ledger_page; ?></td>
                            <td><?php echo $value->fld_item_name; ?></td>
                            <td><?php echo $value->fld_history_quantity; ?></td>
                            <td><?php echo $value->unit; ?></td>
                            <td><?php echo $value->fld_last_receive_date; ?></td>
                            <td style="width: 70px">
                                <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/viewGoodsReceiveItem/<?php echo $value->fld_id; ?>"   data-toggle="tooltip"  title="View Goods Received Item" modal-head="View Goods Item Form" class="dynamicFormModal btn-xs  btn-success"><i class="fa fa-eye"></i></button>
                                <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/editGoodsReceiveItem/<?php echo $value->fld_id; ?>"   data-toggle="tooltip"  title="Edit Goods Received Item" modal-head="Edit Goods Item Form" class="dynamicFormModal btn-xs  btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                                <button type="button" data-id="<?php echo $value->fld_id; ?>"  class="btn-xs btn-danger deleteFunction" data-toggle="tooltip"  title="Delete Goods Received Item"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right; font-weight: 900">Total Quantity</td>
                        <td style="font-weight: 900" ><?php echo number_format($sum); ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>  
        </div>
    </div>

<script type="text/javascript">
    
    $('#printPdf').on('click',function(){
        var catId = $('#category_id').val();
        var subCatId = $('#subcategory_id').val();
        var itemId = $('#item_id').val();
        var dateRange = $('#daterange').val();
        
        //console.log('cat id '+catId+'  subcat id '+subCatId+'  item id '+itemId+'  date Range '+dateRange);
        window.open("<?php echo base_url() ?>index.php/reports/goodsReceiveReportPDF"+'/'+catId+'/'+subCatId+'/'+itemId+'/'+dateRange, '_blank');
    });
    
    $(document).ready(function(){
        $("#id_category").select2();
        $("#id_subcategory").select2();
        $("#id_item").select2();
    });
    
    // data table
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
        } );
    });
    
    
    
</script>