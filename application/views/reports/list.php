<style>
    table.table-bordered tfoot td {
        border-top: 1px solid black
    }
</style>    
<section class="content">
         <div class="row">
        <a href="#" style="margin-left: 20px" class="btn btn-success" data-toggle="tooltip"  title="Download json Format" onClick ="$('#example1').tableExport({type:'json',escape:'false'});"><i class="fa fa-download"></i></a>&nbsp;
        <a href="#" class="btn btn-success" data-toggle="tooltip"  title="Download XLS Format" onClick ="$('#example1').tableExport({type:'excel',escape:'false'});"><i class="fa fa-download"></i></a>&nbsp;
        <a href="#" class="btn btn-success" data-toggle="tooltip"  title="Download CSV Format" onClick ="$('#example1').tableExport({type:'csv',escape:'false'});"><i class="fa fa-download"></i></a>&nbsp;
        <a href="<?php echo base_url() ?>index.php/reports/distributed" class="btn btn-success" data-toggle="tooltip"  title="Download PDF Format" target="_blank"><i class="fa fa-download"></i></a>&nbsp;
    </div>
        <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Parent Name</th>
                            <th>Category Name</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: 600">Total Quantity</td>
                            <td>455</td>
                            <td colspan="1" style="font-weight: 600"></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($result as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $value->parentName; ?></td>
                                <td><?php echo $value->categoryName; ?></td>
                                <td><?php echo $value->itemName; ?></td>
                                <td><?php echo $value->quantity; ?></td>
                                <td><?php echo $value->cre_date; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </section>
<script type="text/javascript">
    // data table
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
        } );
    });
</script>