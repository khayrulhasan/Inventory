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
    .daterangepicker select.yearselect {
        color: black;
        width: 40%;
    }
    .daterangepicker select.monthselect {
        color: black;
        width: 40%;
    }

    /* Glyph, by Harry Roberts */

    /* Inset, by Dan Eden */

    hr.style-six {
        border: 0;
        height: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    #itemSerial1 {
        display: none;
    }
</style>


<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/saveStock" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                                    <?php echo form_dropdown('store', $store, '', 'required="required" class="form-control searchSelect"'); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Receive Date</label>
                                <div class="col-sm-3">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type="text" class="form-control" name="receive_date" value="24/2/2016" />
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
                                    <?php echo form_dropdown('mainmenu[]', $main_manu, '', 'required="required" id="id_menu1" class="form-control mainManu searchSelect"'); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Sub Category</label>
                                <div class="col-sm-3">
                                    <?php echo form_dropdown('category[]', '', '', 'required="required" id="id_category1" class="form-control category searchSelect"'); ?>
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label"
                                        for="item">Item</label>
                                <div class="col-sm-3">
                                    <?php echo form_dropdown('item[]', $items, '', 'required="required" id="id_item1" class="searchSelect itemId form-control" '); ?>
                                </div>
                                <label  class="col-sm-2 control-label"
                                        for="item">Quantity</label>
                                <div class="col-sm-3">
                                    <input type="number" name="quantity[]" id="quantity1" required="required" placeholder="Quantity" class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="form-group" id="itemSerial1">
                                <label  class="col-sm-3 control-label"
                                        for="item">Item Serial Number</label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="itemSerialNumber[]" type="text" placeholder="Serial Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description[]" id="description1" required="required" placeholder="Description Here" class="form-control"></textarea>
                                </div>
                                <div class="col-sm-1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Image Upload</label>
                                <div class="col-sm-8">
                                    <input type="file" name="image0" class="form-control">
                                </div>
                                <div class="col-sm-1">&nbsp;</div>
                            </div>


                        </div>
                    </div>
                    <button type="button" class="btn-xs btn-success" id="addItem"  data-toggle="tooltip"  title="Add" style="position: relative; top: -50px;right: 20px; float: right"><span class="fa fa-plus"></span></button>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" id="addItemForm"  value="Save" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    //Select 2 
    $(document).ready(function(){
        $('.searchSelect').select2();
    });
    

    /**Dynamic Culmn and row add or delete**/
    var id_menu = 1;
    var id_category = 1;
    var id_item = 1;
    var item_serial = 1;
    var imageId = 1;
    $("#addItem", $('#multi-field-wrapper')).click(function(e) {
        $('#addGoodsReceive').append('<div class="multi-field"><hr style="position: relative; top: -8px" /><div class="form-group"><label  class="col-sm-3 control-label"for="item">Category</label><div class="col-sm-3"><select name="mainmenu[]" id="id_menu' + (++id_menu) + '" required="required"  class="form-control mainManu"><?php foreach ($main_manu as $key => $value) { ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php } ?></select></div>\n\
    <label  class="col-sm-2 control-label"for="item">Sub Category</label><div class="col-sm-3"><select name="category[]" required="required" id="id_category' + (++id_category) + '"  class="form-control category"></select></div><div class="col-sm-1"><button type="button" class="btn-xs btn-danger remove-field" data-toggle="tooltip"  title="Remove" style="position:relative; left:7px"><i class="fa fa-minus"></i></button></div></div><div class="form-group"><label  class="col-sm-3 control-label"for="item">Item</label><div class="col-sm-3"><select name="item[]" required="required" id="id_item' + (++id_item) + '"  class="form-control itemId  searchSelect"><?php foreach ($items as $key => $value) { ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php } ?></select></div>\n\
    <label  class="col-sm-2 control-label"for="item">Quantity</label><div class="col-sm-3"><input  type="number" required="required" name="quantity[]" placeholder="Quantity" class="form-control"></div></div>\n\
    <div class="form-group" id="itemSerial'+(++item_serial)+'"><label  class="col-sm-3 control-label" for="item">Item Serial Number</label><div class="col-sm-3"><input class="form-control" type="text" name="itemSerialNumber[]" placeholder="Serial Number"></div></div>\n\
    <div class="form-group"><label  class="col-sm-3 control-label"for="item">Description</label><div class="col-sm-8"><textarea  name="description[]" required="required" placeholder="Description Here" class="form-control"></textarea></div></div><div class="form-group"><label class="col-sm-3 control-label" for="description" >Image Upload</label><div class="col-sm-8"><input type="file" name="image'+(imageId++)+'"  class="form-control"></div><div class="col-sm-1">&nbsp;</div></div>');
        
        $(document).ready(function(){
            $('#id_menu'+id_menu).select2();
            $('#id_category'+id_category).select2();
            $('#id_item'+id_item).select2();
            $("#itemSerial"+item_serial).hide();
        });
    });
    
    /**  Remove This div**/
    $(document).on('click', '.remove-field', function(e) {
        $(this).parents('.multi-field').remove();
    });
    //===================================================================
   
   
   
      
   
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
                $('#id_category'+id).html(data);
            }
        });
    });
    
    
    //Item select by serial number
    $('#multi-field-wrapper').on('change', '.itemId', function() {
        var typeId = $(this).val();
        var pattern = /[0-9]+/g;
        var id = $(this).attr('id').match(pattern);
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
                    $("#itemSerial"+id).show();
                }else{
                    $("#itemSerial"+id).hide();
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

