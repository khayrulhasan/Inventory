<style>
    .nav li a:hover {
        cursor: pointer;
    }
    .container-filter {
        height: 200px;
        margin-left: 20px;
    }

    .tab-content {
        border-top: none;
        border-bottom: 1px solid #DDDDDD;
        border-left: 1px solid #DDDDDD;
        border-right: none;
        height: 140px;
        padding: 10px;
    }
    .modal-content {
        width: 85%;
    }
</style>
<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
            <div class="container-filter">
                <ul class="nav nav-tabs" id="myTab">
                    <li><a data-target="#date" data-toggle="tab">By Date Filtering</a></li>
                    <li class="active"><a data-target="#conternt" data-toggle="tab">By Name Filtering</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="date">
                        <div class="tab-pane active" id="type">
                            <div class="form-group">
                                <form action="<?php echo base_url() ?>index.php/setup/distributedItem/<?php echo $id?>" method="post">
                                    <label>Date range:</label>

                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="reservation" name="daterange" class="form-control pull-right">
                                    </div>
                                    <div class="input-group">
                                        <label for="item">&nbsp;</label>
                                        <input type="submit" class="btn btn-info" style="float: right; position: relative; top: 20px;"  value="Search">
                                    </div>
                                </form>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="conternt">
                        <div class="form-group" id="multi-field-wrapper">
                            <form action="<?php echo base_url() ?>index.php/setup/distributedItem/<?php echo $id?>" method="post">
                                <div style="margin-left: -5px;">
                                    <div class="form-group col-sm-4">
                                        <label  for="item">Category</label>
                                        <?php echo form_dropdown('category', $main_manu, '', 'class="form-control col-sm-2 mainManu searSelect"'); ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="item">Sub Category</label>
                                        <?php echo form_dropdown('subCategory', '', '', 'id="id_category" class="form-control col-sm-2 category searSelect"'); ?>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="item">Item Name</label>
                                         <select name="item" id="id_item" class="form-control col-sm-2 itemSelect">
                                            <?php foreach ($items as $value) { ?>
                                                <option value="<?php echo $value->fld_id ?>" data-image="<?php echo $value->image_path ?>"><?php echo $value->fld_item_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="item">&nbsp;</label>
                                        <input type="submit" class="btn btn-info" style="position: relative;  bottom: -2px" value="Search">
                                    </div>
                                </div>
                            </form>
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
    </div>
</div>

<script>
    jQuery(function () {
        jQuery('#myTab a:first').tab('show')
    })
    
    //
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
        $(".itemSelect").select2({
            formatResult: format, 
            formatSelection: format, 
            escapeMarkup: function(m) { return m; } 
        });
        function format(state) { 
            var originalOption = state.element; 
            if($(originalOption).data('image') !== ''){
                return "<img class='imageComboBox' src='<?php echo base_url() ?>/uploads/item/thumb/" + $(originalOption).data('image') + 
                    "' alt='" + $(originalOption).data('image') + "' />" + state.text; 
            }else{
                return "<img class='imageComboBox' src='<?php echo base_url() ?>/uploads/item/thumb/noimgavailable.jpg" + 
                    "' alt='" + $(originalOption).data('image') + "' />" + state.text; 
            }
        }
    });
    
    //date
    $(function() {
        $('input[name="daterange"]').daterangepicker(
        {
            format: 'DD/MM/YYYY',
            startDate: '01-01-2015',
            endDate: '01-12-2016'
        });
    });
</script>