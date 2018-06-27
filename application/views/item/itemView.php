<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" id="addForm" class="form-horizontal" role="form">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        &nbsp;
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"
                                for="item">Ledger Page No.</label>
                        <div class="col-sm-3">
                            <input type="text" id="num1" disabled="disabled" value="<?php echo $row->fld_ledger_page ?>" name="fld_item_name"  placeholder="Enter Item Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"
                                for="item">Item Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="num1" disabled="disabled" value="<?php echo $row->fld_item_name ?>" name="fld_item_name"  placeholder="Enter Item Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="description" >Description</label>
                        <div class="col-sm-9">
                            <textarea name="fld_description" disabled="disabled" placeholder="Description Here" class="form-control"><?php echo $row->fld_description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="quantity" >Unit</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_unit', $unit, $row->fld_unit, 'disabled="disabled" id="item_unit" class="form-control select2" required'); ?>
                        </div>
                        <label class="col-sm-1 control-label"
                               for="quantity" >Type</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_type', $type, $row->fld_type, 'disabled="disabled" id="item_unit" class="form-control" required'); ?>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>

                    
                </div>
            </div>
        </form>

    </div>
</div>

