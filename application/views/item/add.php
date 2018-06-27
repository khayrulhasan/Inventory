<style>
    .alert-info {
        height:40px;
        line-height: -10px;
        border-radius: 0px;
        background: #3C8DBC !important;
    }


    .required_content {
        width: auto; display: block; background: #EEE;  border-bottom: 1px solid #3C8DBC; min-height: 420px; z-index: -999
    }

    .contenTitle {
        position: relative; top: -13px
    }

    .btn-group:first-child:not(:last-child) > .dropdown-toggle {
        width: 45px;
    }

</style>


<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <form action="lookUp/itemSetup" method="post">
                <label for="email">Main Menu:</label>
                <?php echo form_dropdown('main_menu', $main_menu, '', 'id="mainMenu" class="form-control input-sm"'); ?>
            </form>
        </div>
    </div>


    <div class="col-md-9">
        <label for="Option">Item Select:</label>
        <select id="itemSelect" data-atleast="1">
            <?php

            function createTree($variant_list) {
                foreach ($variant_list as $key => $cat) {
                    $cat_id = $cat['id'];
                    echo '<option value="' . $cat_id . '"data-level="' . $cat['level'] . '">' . $cat['name'];
                    if (!empty($cat['children'])) {
                        createTree($cat['children']);
                    }
                    echo "</option>";
                }
            }

            createTree($variant_list);
            ?>
        </select>
    </div>
</div>





<div class="row">
    <!--        Required content form-->
    <div class="alert alert-info"> <div class="contenTitle"><span id="genericName">No Select Parent</span>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp; <span class="itemName">No Select Category</span>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp; Add Item <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAddItem"><span class="fa fa-plus fa-1x"></span></button></div></div>
    <h4 style="position: relative; left: 28px; top: 20px" class="itemName">No Select Item</h4>
    <div class="container" id="idTableList">
        <section class="content" style="margin-right: 50px">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $value->item_name; ?></td>
                                    <td><?php echo $value->item_quantity; ?></td>
                                    <td><?php echo $value->unit_name; ?></td>
                                    <td>
                                        <a href="" class="btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="" class="btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>  
                </div>
            </div>
        </section>
    </div>
</div>

<!--Modal for crud / Add-->
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
                    Enter Item Details
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="add_item_form" class="form-horizontal" role="form">
                    <input type="hidden" name="generic_id" id="genericID">
                    <input type="hidden" name="item_id" id="item_id">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"
                                for="item">Item Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="item_name" required="required" placeholder="Enter Item Name" id="item_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="description" >Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" required="required" placeholder="Enter Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="quantity" >Quantity</label>
                        <div class="col-sm-4">
                            <input type="number" name="item_quantity" required="required" id="item_quantity" placeholder="Enter Quantity" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label"
                               for="quantity" >Unit</label>
                        <div class="col-sm-3">
                            <?php echo form_dropdown('unit', $unit, '', 'id="item_unit" class="form-control" required'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="quantity" >Type</label>
                        <div class="col-sm-3">
                            <?php echo form_dropdown('unit', $type, '', 'id="item_unit" class="form-control" required'); ?><br/>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                    Close
                </button>

                <input type="button" id="addItemForm"  value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>
<!--Modal for crud-->



<script type="text/javascript">
    $(document).ready(function(){
        //=======Data Bind and get id==========================================================================
        $("select#itemSelect").smartselect({
            multiple: false,
            toolbar: {
                buttonView: 'level+selected'
            },
            style: {
                select: 'dropdown-toggle btn btn-info'
            }
        });
        
        
        //Get item id by click on this item
        var selectedGetItemId;
        var generic_id ;
        $('.smartselect .dropdown-menu li').click(function() {
            selectedGetItemId =( $(this).attr('data-value') );// get smart selected id get and set into selectedGetItemId as variable
            //generic_id = ( $(this).attr('parent_id') );
        });
        
        
        
        //=======On Select Function==========================================================================
        $(".ss-label").bind("DOMSubtreeModified", function() {
            var txt = $(".dropdown-toggle > span.ss-label").text();
            $(".itemName").html(txt);
            $("#itemId").val(selectedGetItemId);
            console.log(selectedGetItemId)
           
            if(selectedGetItemId != ''){    
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>index.php/lookUp/getVariantById", // Get all for variant data 
                    data: ({
                        ID: selectedGetItemId
                    }),
                    success: function(data){
                        $('#item_id').val(selectedGetItemId);
                        $('#genericID').val(((data.parent_id) != null) ? data.parent_id : '0');
                        $('#genericName').html(((data.parant_name) != null) ? data.parant_name : data.name+" Is Also Parent Name");
                    }
                });
            }
        });
        
    });
    
    
    
    //Form submit by ajax 
    $("#addItemForm").on('click',function(){
        var parentId = $('#genericID').val();
        var itemId = $('#item_id').val();
        var itemName = $('#item_name').val();
        var itemDescription = $('#description').val();
        var itemQuantity = $('#item_quantity').val();
        var itemUnit = $('#item_unit').val();
        $.ajax({
            type: "POST",
            dataType: 'html',
            data: ({
                parentId: parentId,
                itemId: itemId,
                itemName: itemName,
                itemDescription: itemDescription,
                itemQuantity: itemQuantity,
                itemUnit: itemUnit
            }),
            url: "<?php echo base_url() ?>index.php/lookUp/itemSaveByAjax", // Get all for variant data 
            success: function(data){
                $('#idTableList').html(data);
                $('#myModalAddItem').modal('hide');
                $('#add_item_form').trigger("reset");
            }
        });
    });
    
    
    
    // data table
    $(function() {
        $("#example1").DataTable( {
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        } );
    });
    
    
    
    $(document).ready(function(){
        $('.myColor').on('click', 'input[type="button"]', function () {
            $(this).closest('td').remove();
        })
        $('p input[type="button"]').click(function () {
            $('.myColor tr').append('<td><input type="color" value="#F3F3F3" class="html5colorpicker" name="colorpicker[]" /><input type="button" class="colorDelete" value="X" /></td>')
        });
    })
</script>