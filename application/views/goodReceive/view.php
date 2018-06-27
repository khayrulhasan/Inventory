<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/saveStock" method="post" class="form-horizontal" role="form">
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
                <div id="multi-field-wrapper">
                    <div class="modal-body multi-fields" id="addGoodsReceive">
                        <div class="multi-field">
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">Store</label>
                                <div class="col-sm-3">
                                    <?php echo form_dropdown('store', $store, $result->fld_store_id, 'disabled="disabled" required="required" class="form-control searchSelect"'); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Receive Date</label>
                                <div class="col-sm-3">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type="text" disabled="disabled" class="form-control" name="receive_date" value="<?php echo $result->fld_last_receive_date; ?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr class="style-six" style="position: relative; top: -8px" />
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">Category</label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $result->parent ?>" >
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Sub Category</label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $result->category ?>" >
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">Item</label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $result->fld_item_name ?>" >
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Quantity</label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" value="<?php echo $result->fld_history_quantity ?>" >
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description[]" id="description1" disabled="disabled"  class="form-control"><?php echo $result->fld_description ?></textarea>
                                </div>
                                <div class="col-sm-1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">&nbsp;</label>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-info" id="hideImage">Hide Image</button>
                                    <button type="button" class="btn btn-info" id="showImage">Show Image</button>
                                </div>
                                <div id="imageHideShow">
                                    <label  class="col-sm-3 control-label"
                                            for="item">Item Image</label>
                                    <div class="col-sm-3">
                                        <?php if($image->image_path) {?>
                                        <img src="<?php echo base_url(); ?>uploads/item/thumb/<?php echo $image->image_path; ?>" class="img-thumbnail" height="80" width="80" />
                                        <?php }else{ echo "No Image";} ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#hideImage').hide();
        $('#imageHideShow').hide();
    });
    
    $('#showImage').on('click', function(){
        $('#hideImage').show();
        $('#showImage').hide();
        $('#imageHideShow').show();
    });
    $('#hideImage').on('click', function(){
        $('#showImage').show();
        $('#hideImage').hide();
        $('#imageHideShow').hide();
    });
</script>