<style>
    .modal-dialog {
        width: 55% !important;
    }
    .btn-info {
        border: none;
    }
</style>
<div class="row">
    <span style="margin-left: 20px"><button class="btn btn-info dynamicFormModal" type="button"  data-action="<?php echo base_url() ?>index.php/setup/getFilteringFormForConsuming"   data-toggle="tooltip"  title="Data Filtering" modal-head="Data Filtering Form"><i class="fa fa-filter"></i></button></span>&nbsp;
    <a href="#" data-toggle="tooltip"  title="Download CSV Format" onClick ="$('#example1').tableExport({type:'csv',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel_csv.png" height="40" width="40"></a>&nbsp;
    <a href="#" data-toggle="tooltip"  title="Download XLS Format" onClick ="$('#example1').tableExport({type:'excel',escape:'false'});"><img src="<?php echo base_url() ?>uploads/excel.png" height="40" width="40"></a>&nbsp;
    <a href="#" data-toggle="tooltip"  title="Download json Format" onClick ="$('#example1').tableExport({type:'json',escape:'false'});"><img src="<?php echo base_url() ?>uploads/json.png" height="40" width="40"></a>&nbsp;
    <a href="<?php echo base_url() ?>index.php/reports/consumingReportPDF/<?php echo $user_id; ?>" data-toggle="tooltip"  title="Download PDF Format" target="_blank"><img src="<?php echo base_url() ?>uploads/pdf.png" height="40" width="40"></a>&nbsp;
</div>
<div class="box">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $value) { ?>
                    <tr>
                        <?php $sum+=$value->quantity; ?>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value->parentName; ?></td>
                        <td><?php echo $value->categoryName; ?></td>
                        <td><?php echo $value->fld_item_name; ?></td>
                        <td><?php echo $value->quantity; ?></td>
                        <td><?php echo $value->unitName; ?></td>
                        <td><?php echo $value->cre_date; ?></td>
                        <td>
                            <button type="button"  data-action="<?php echo base_url() ?>index.php/setup/viewConsumeForm/<?php echo $value->id ?>"   data-toggle="tooltip"  title="View Item" modal-head="View Consume Form" class="dynamicFormModal btn-xs btn-info"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: 600">Total Quantity</td>
                    <td style="font-weight: 900"><?php echo $sum ?></td>
                    <td colspan="3">&nbsp</td>
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