<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/saveDistributionItem" method="post" class="form-horizontal" role="form">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Distributor
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="quantity" >User</label>
                        <div class="col-sm-3">
                            <?php echo form_dropdown('user_id', $user, '', 'class="form-control" required'); ?>
                        </div>
                        <label  class="col-sm-2 control-label"
                                for="item">Receive Date</label>
                        <div class="col-sm-3">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" name="receive_date" value="24/02/2016" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="item">Item Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="item_name" disabled="disabled" value="<?php echo $result->fld_item_name ?>" placeholder="Enter Item Name" id="item_name" class="form-control">
                            <input type="hidden" name="id" value="<?php echo $result->fld_id ?>">
                            <input type="hidden" name="image_id" value="<?php echo $image_id ?>">
                            <input type="hidden" name="item_id" value="<?php echo $result->fld_item_id ?>">
                            <input type="hidden" name="category_id" value="<?php echo $result->fld_category_id ?>">
                            <input type="hidden" name="parent_id" value="<?php echo $result->fld_parent_id ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="description" >Description</label>
                        <div class="col-sm-8">
                            <textarea name="description" required="required" disabled="disabled" placeholder="No Description" class="form-control"><?php echo $result->fld_description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="quantity" >Current Quantity</label>
                        <div class="col-sm-4">
                            <input type="number"  id="subt" name="current_quantity" readonly="readonly" value="<?php echo $result->fld_quantity ?>"   placeholder="Enter Quantity" class="form-control current_quantity">
                            <input type="hidden" id="num2"  value="<?php echo $result->fld_quantity ?>"  placeholder="Enter Quantity" class="form-control current_quantity">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" value="<?php echo $result->unit ?>"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="quantity" >Issue Quantity</label>
                        <div class="col-sm-4">
                            <input type="number" onkeyup="existNumber()" id="num1" required="required" value="" name="issue_quantity"  placeholder="Enter Quantity" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" value="<?php echo $result->unit ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"
                               for="description" >Remarks</label>
                        <div class="col-sm-8">
                            <textarea name="remarks" required="required"  placeholder="Remarks Here !" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"
                                for="item">&nbsp;</label>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-info" id="hideImage">Hide Image</button>
                            <button type="button" class="btn btn-info" id="showImage">Show Image</button>
                        </div>
                        <div id="imageHideShow">
                            <label  class="col-sm-3 control-label"
                                    for="item">Item Image</label>
                            <div class="col-sm-2">
                                <?php if ($image->image_path) { ?>
                                    <img src="<?php echo base_url(); ?>uploads/item/thumb/<?php echo $image->image_path; ?>" class="img-thumbnail" height="80" width="80" />
                                    <?php
                                } else {
                                    echo "No Image";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>

                    <input type="submit" id="addItemForm"  value="Confirm" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //this calculates values automatically 
        sum();
        $("#num1, #num2").on("keydown keyup", function() {
            sum();
            
            console.log('dd');
        });
    });
    
    

    function sum() {
        var num1 = $('#num1').val();
        var num2 = $('#num2').val();
        var result1 = parseInt(num2) - parseInt(num1);
        if (!isNaN(result1) || result1 ==='' ) {
            $('#subt').val(result1);
        }
    }
    
    
    
    //Image shoe Hide
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
    
    
    // prevent text input into quantity field
    function existNumber(){
        var num1 = Number($('#num1').val())
        var num2 = Number($('#num2').val())
        if ( num1 > num2) {
            $('#num1').val(num2);
            return false;
        } 
    }
    
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
    
    
    // For Numeric
     $(document).ready(function () {
        $('#num1').numeric(); 
        
    });
</script>