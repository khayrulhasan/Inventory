<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/editItem" method="post" id="addForm" class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Goods Receive
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label  class="col-sm-3 control-label"
                                for="item">Ledger Page No.</label>
                        <div class="col-sm-3">
                            <input type="text" value="<?php echo $row->fld_ledger_page ?>" name="fld_ledger_page"  placeholder="Page No" class="form-control">
                        </div>
                        <label  class="col-sm-2 control-label"
                                for="item">Entry Date</label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='datetimepicker1'>
                                 <input type="text" class="form-control" name="receive_date" data-toggle="tooltip" value="<?php echo $row->fld_cre_date; ?>"  title="<?php echo $row->fld_cre_date; ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"
                                for="item">Item Name</label>
                        <div class="col-sm-9">
                            <input type="hidden" id="num1"  value="<?php echo $row->fld_id; ?>" name="fld_id"  class="form-control">
                            <input type="text" id="num1" required="required" value="<?php echo $row->fld_item_name; ?>" name="fld_item_name"  placeholder="Enter Item Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="description" >Description</label>
                        <div class="col-sm-9">
                            <textarea name="fld_description" required="required" placeholder="" class="form-control"><?php echo $row->fld_description; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="quantity" >Unit</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_unit', $unit, $row->fld_unit, 'id="item_unit" class="form-control searchSelect" required'); ?>
                        </div>
                        <label class="col-sm-1 control-label"
                               for="quantity" >Type</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_type', $type, $row->fld_type, 'id="item_unit" class="form-control searchSelect" required'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="quantity" >Item Picture</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label"
                               for="quantity" >Photo</label>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url(); ?>uploads/item/thumb/<?php echo $row->image_path; ?>" height="50px" width="50px">
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>

                    <input type="submit" id="addItemForm"  value="Update" class="btn btn-primary">
                </div>
            </div>
        </form>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.searchSelect').select2();
    });
    
    
    //date
    $(function() {
        $('input[name="receive_date"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'DD/MM/YYYY'
        }, 
        function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
    });
</script>

