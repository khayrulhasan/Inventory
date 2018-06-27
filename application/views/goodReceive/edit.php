<style>
    #itemSerial {
        display: none;
    }
</style>

<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/editGoodsReceiveItem" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">


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
                                    <input type="hidden" name="fld_id" value="<?php echo $result->fld_id ?>" class="form-control">
                                    <input type="hidden" name="prnt_name" value="<?php echo $result->fld_parent_id ?>" class="form-control">
                                    <input type="hidden" name="cat_name" value="<?php echo $result->fld_category_id ?>" class="form-control">
                                    <input type="hidden" name="itm_name" value="<?php echo $result->fld_item_id ?>" class="form-control">
                                    <?php echo form_dropdown('store', $store, $result->fld_store_id, 'required="required" class="form-control searchSelect"'); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Receive Date</label>
                                <div class="col-sm-3">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type="text" class="form-control" name="receive_date" data-toggle="tooltip" value="<?php echo $result->fld_last_receive_date; ?>"  title="<?php echo $result->fld_last_receive_date; ?>" />
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
                                    <?php echo form_dropdown('mainmenu', $main_manu, $result->fld_parent_id, 'required="required" id="id_menu1" class="form-control mainManu searchSelect"'); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Sub Category</label>
                                <div class="col-sm-3">
                                    <?php echo form_dropdown('category', $category, $result->fld_category_id, 'required="required" id="id_category" class="form-control category searchSelect"'); ?>
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">Item</label>
                                <div class="col-sm-3">
                                    <?php echo form_dropdown('item', $items, $result->fld_item_id, 'required="required" id="id_item" class="searchSelect form-control itemId" '); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Quantity</label>
                                <div class="col-sm-3">
                                    <input type="hidden" name="stock_quantity" value="<?php echo $result->fld_quantity; ?>">
                                    <input type="hidden" name="history_quantity" value="<?php echo $result->fld_history_quantity; ?>">
                                    <input type="number" name="quantity" data-toggle="tooltip"  title="<?php echo " History Qnt : ".$result->fld_history_quantity; ?>" id="quantity1" value="<?php echo $result->fld_history_quantity ?>" placeholder="Quantity" class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group" id="itemSerial">
                                <label  class="col-sm-3 control-label"
                                        for="item">Item Serial Number</label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="itemSerialNumber" type="text" value="<?php echo $result->fld_item_serial_number; ?>" placeholder="Serial Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="description1" required="required" placeholder="Description Here" class="form-control"><?php echo $result->fld_description ?></textarea>
                                </div>
                                <div class="col-sm-1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Current Image</label>
                                <div class="col-sm-3">
                                    <?php if ($image->image_path) { ?>
                                        <img src="<?php echo base_url(); ?>uploads/item/thumb/<?php echo $image->image_path; ?>" class="img-thumbnail" height="50" width="50" />
                                        <?php
                                    } else {
                                        echo "No Image";
                                    }
                                    ?>
                                </div>
                                <label class="col-sm-2 control-label"
                                       for="description" >Image Upload</label>
                                <div class="col-sm-3">
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-sm-1">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" id="addItemForm"  value="Update" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    
    
    //Select 2 
    $(document).ready(function(){
        $('.searchSelect').select2();
        // auto load serial number field
         var typeId = $('#id_item').val();
        //alert(id)
        
        $.ajax({
            type : "POST",
            dataTYpe: "JSON",
            url: "<?php echo base_url() ?>index.php/setup/checkItemType/"+typeId,
            success: function(data){
                var response =  eval(data);
                var objLength = response.length;
                for(var i=0; i<objLength; i++){
                    var valueName = response[i]['fld_type'];
                }
                if(valueName === '216'){
                    $("#itemSerial").show();
                }else{
                    $("#itemSerial").hide();
                }
            }
        });
        
    });
    
    
    //Onchange Main Menu
    $('#multi-field-wrapper').on('change', '.mainManu', function() {
        var main_manu_id = $(this).val();
        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>index.php/setup/getCategoryList",
            data: ({
                main_manu_id: main_manu_id
            }),
            success: function(data){
                $('#id_category').html(data);
            }
        });
    });
    
    
    //Item select by serial number
    $('#multi-field-wrapper').on('change', '.itemId', function() {
        var typeId = $(this).val();
        //alert(id)
        
        $.ajax({
            type : "POST",
            dataTYpe: "JSON",
            url: "<?php echo base_url() ?>index.php/setup/checkItemType/"+typeId,
            success: function(data){
                var response =  eval(data);
                var objLength = response.length;
                for(var i=0; i<objLength; i++){
                    var valueName = response[i]['fld_type'];
                }
                if(valueName === '216'){
                    $("#itemSerial").show();
                }else{
                    $("#itemSerial").hide();
                }
            }
        });
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