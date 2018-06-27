
<style>
    .modal-dialog {
        width: 45% !important;
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
</style>


<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open('index.php/lookUp/saveGroup', array('class' => 'form-horizontal', 'id' => 'dgdpMainForm')); ?>
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
                            <label class="col-sm-3 control-label">Group Name</label>
                            <a class="help-icon" data-container="body" data-toggle="popover" data-placement="right" data-content="Group Names">
                                <i class="fa fa-question-circle"></i>
                            </a>
                            <div class="col-sm-6">
                                <?php echo form_input(array('name' => 'LOOKUP_GRP_NAME', 'id' => 'LOOKUP_GRP_NAME', 'class' => 'form-control', 'placeholder' => "Group Name", 'required' => 'required')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Short Name</label>
                            <a class="help-icon" data-container="body" data-toggle="popover" data-placement="right" data-content="Short Name">
                                <i class="fa fa-question-circle"></i>
                            </a>
                            <div class="col-sm-6">
                                <?php
                                $options = array('' => '-- Select One --', 'C' => 'Character', 'N' => 'Number');
                                echo form_dropdown('short_name', $options, '', 'id="short_name" class="form-control" required');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"
                                   for="description" >Active</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="ACTIVE_FLAG" class="flat-red" checked>
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
                <input type="submit" id="addItemForm"  value="Save" class="btn btn-primary">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>
