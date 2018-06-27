<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/setup/create" method="post" id="addForm" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                            <input type="number" id="num1" required="required" value="" name="fld_ledger_page"  placeholder="Page No" class="form-control">
                        </div>
                        <label  class="col-sm-2 control-label"
                                for="item">Entry Date</label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" name="receive_date" value="24/02/2016" />
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
                            <input type="text" id="num1" required="required" value="" name="fld_item_name"  placeholder="Enter Item Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="description" >Description</label>
                        <div class="col-sm-9">
                            <textarea name="fld_description" required="required" placeholder="Description Here" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="quantity" >Unit</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_unit', $unit, '', 'id="item_unit" class="form-control searchSelect" required'); ?>
                        </div>
                        <label class="col-sm-1 control-label"
                               for="quantity" >Type</label>
                        <div class="col-sm-4">
                            <?php echo form_dropdown('fld_type', $type, '', 'id="item_unit" class="form-control searchSelect" required'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"
                               for="quantity" >Item Picture</label>
                        <div class="col-sm-4">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>

                    <input type="submit" id="addItemForm"  value="Save" class="btn btn-primary">
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
