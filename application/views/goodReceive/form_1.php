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
</style>

<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal" role="form">
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
                <div class="multi-field-wrapper">
                    <div class="modal-body multi-fields" id="addGoodsReceive">
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"
                                    for="item">Main Menu</label>
                            <div class="col-sm-3">
                                <?php echo form_dropdown('shirts', '', '', 'class="form-control"'); ?>
                            </div>
                            <label  class="col-sm-2 control-label"
                                    for="item">Category</label>
                            <div class="col-sm-3">
                                <?php echo form_dropdown('shirts', '', '', 'class="form-control"'); ?>
                            </div>
                            <div class="col-sm-1">
                                &nbsp;
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"
                                    for="item">Item Name</label>
                            <div class="col-sm-3">
                                <?php echo form_dropdown('shirts', '', '', 'class="form-control"'); ?>
                            </div>
                            <label  class="col-sm-2 control-label"
                                    for="item">Item Quantity</label>
                            <div class="col-sm-3">
                                <?php echo form_input('username', 'johndoe', 'class="form-control"'); ?>
                            </div>
                            <div class="col-sm-1">
                                &nbsp;
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"
                                   for="description" >Description</label>
                            <div class="col-sm-8">
                                <textarea name="description" required="required" placeholder="Description Here" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-1">&nbsp;</div>
                        </div>
                    </div>
                    <button type="button" class="btn-xs btn-success" id="addItem"   style="position: relative; top: -50px;right: 20px; float: right"><span class="fa fa-plus"></span></button>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" id="addItemForm"  value="Confirm" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    /**Dynamic Culmn and row add or delete**/
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $("#addItem", $(this)).click(function(e) {
            $('#addGoodsReceive').append('<div class="multi-field"><div class="form-group"><label  class="col-sm-3 control-label"for="item">Main Menu</label><div class="col-sm-3"><select name="" class="form-control"><option>Select</option></select></div>\n\
    <label  class="col-sm-2 control-label"for="item">Category</label><div class="col-sm-3"><select name="" class="form-control"><option>Select</option></select></div><div class="col-sm-1"><button type="button" class="btn-xs btn-danger remove-field" style="position:relative; left:7px"><i class="fa fa-minus"></i></button></div></div><div class="form-group"><label  class="col-sm-3 control-label"for="item">Item</label><div class="col-sm-3"><select name="" class="form-control"><option>Select</option></select></div>\n\
    <label  class="col-sm-2 control-label"for="item">Quantity</label><div class="col-sm-3"><input type="text" name="" class="form-control"></div></div><div class="form-group"><label  class="col-sm-3 control-label"for="item">Description</label><div class="col-sm-8"><textarea name="description" required="required" placeholder="Description Here" class="form-control"></textarea></div></div>');
        });
        
        
        $('.multi-field .remove-field', $wrapper).click(function() {
            alert('dsfsdfs');
            if ($('.multi-fields', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });
    
    
    
    
    
    
</script> 
