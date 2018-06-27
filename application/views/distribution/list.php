<style>
    .btn-info {
        border: none;
    }    
    .modal-dialog {
        width: 55% !important;
    }
</style>
    <div class="row">
        <span style="margin-left: 20px"><button class="btn btn-info dynamicFormModal" type="button"  data-action="<?php echo base_url() ?>index.php/setup/getFilteringFormForDistribution"   data-toggle="tooltip"  title="Data Filtering" modal-head="Data Filtering Form"><i class="fa fa-filter"></i></button></span>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download CSV Format" onClick ="$('#example1').tableExport({type:'csv',escape:'false'});"><img src="<?php echo base_url()?>uploads/excel_csv.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download XLS Format" onClick ="$('#example1').tableExport({type:'excel',escape:'false'});"><img src="<?php echo base_url()?>uploads/excel.png" height="40" width="40"></a>&nbsp;
        <a href="#" data-toggle="tooltip"  title="Download json Format" onClick ="$('#example1').tableExport({type:'json',escape:'false'});"><img src="<?php echo base_url()?>uploads/json.png" height="40" width="40"></a>&nbsp;
        <a href="<?php echo base_url() ?>index.php/reports/stockReportPDF" data-toggle="tooltip"  title="Download PDF Format" target="_blank"><img src="<?php echo base_url()?>uploads/pdf.png" height="40" width="40"></a>&nbsp;
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
                    <?php
                    foreach ($result as $key => $value) {
                        if ($value->fld_quantity > 0) {
                            ?>
                            <tr>
                                <?php $sum +=$value->fld_quantity; ?>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $value->parent; ?></td>
                                <td><?php echo $value->category; ?></td>
                                <td><?php echo $value->fld_ledger_page; ?></td>
                                <td><?php echo $value->fld_item_name; ?></td>
                                <td><?php echo $value->fld_quantity; ?></td>
                                <td><?php echo $value->unit; ?></td>
                                <td><?php echo $value->fld_last_receive_date; ?></td>
                                <td style="width: 60px">
        <!--                                <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/getDistributionForm/<?php echo $value->fld_parent_id ?>/<?php echo $value->fld_category_id ?>/<?php echo $value->fld_item_id ?>"   data-toggle="tooltip"  title="Distribution" modal-head="Distribution This Item" class="dynamicFormModal btn-xs btn-info"><i class="fa fa-arrow-circle-o-right"></i></button>-->
                                    <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/getDistributionForm/<?php echo $value->fld_id ?>"   data-toggle="tooltip"  title="Distribution" modal-head="Distribution This Item" class="dynamicFormModal btn-xs btn-info"><i class="fa fa-arrow-circle-o-right"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
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
    // data table
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
        } );
    });
    
    
    //Onchange Main Menu
    $('#multi-field-wrapper').on('change', '.mainManu', function() {
        var main_manu_id = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>index.php/setup/getCategoryListSelect",
            data: ({
                main_manu_id: main_manu_id
            }),
            success: function(data){
                $('#id_category').html(data);
            }
        });
    });
    
    //Onchange category
    $('#multi-field-wrapper').on('change', '.category', function() {
        var category_id = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>index.php/setup/getItemListSelect",
            data: ({
                category_id: category_id
            }),
            success: function(data){
                $('#id_item').html(data);
            }
        });
    });
    
    //search select
    $(document).ready(function(){
        $(".searSelect").select2();
    });
    
</script>
