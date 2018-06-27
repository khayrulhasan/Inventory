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
        <?php echo form_open('index.php/lookUp/saveGroupIitem', 'id="save_group_data"', array('class' => 'form-horizontal', 'style' => 'padding-top:50px; padding-bottom:20px')); ?>
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
                            <label class="col-sm-3 control-label">Item Name</label>
                            <a class="help-icon" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                <i class="fa fa-question-circle"></i>
                            </a>
                            <div class="col-sm-6">
                                <?php echo form_input(array('name' => 'LOOKUP_DATA_NAME', 'id' => 'LOOKUP_DATA_NAME', 'class' => 'form-control', 'placeholder' => "Item  Name", 'required' => 'required')); ?>
                                <input type="hidden" name="LOOKUP_GRP_ID" id="LOOKUP_GRP_ID" value="<?php echo $lkp_grp_id; ?>" class="form-control input-sm">
                                <input type="hidden" name="USE_CHAR_NUMB" id="USE_CHAR_NUMB" value="<?php echo $USE_CHAR_NUMB; ?>" class="form-control input-sm">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Short Name</label>
                            <a class="help-icon" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                <i class="fa fa-question-circle"></i>
                            </a>
                            <div class="col-sm-6">
                                <?php
                                if ($USE_CHAR_NUMB == 'N') {
                                    echo form_input(array('name' => 'NUMB_LOOKUP', 'id' => 'NUMB_LOOKUP', 'class' => 'form-control', 'placeholder' => "Short Name", 'required' => 'required'));
                                } else {
                                    echo form_input(array('name' => 'CHAR_LOOKUP', 'id' => 'CHAR_LOOKUP', 'class' => 'form-control', 'placeholder' => "Short Name", 'required' => 'required'));
                                }
                                ?>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group self">
                            <label class="col-sm-3 control-label">Active</label>
                            <div class="col-sm-6">
                                <?php echo form_checkbox('ACTIVE_FLAG', 1, TRUE, 'id="ACTIVE_FLAG" class="flat-red"'); ?>
                                <label for="is_active"></label>
                            </div>
                        </div>
                        <br/>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#CHAR_LOOKUP').alpha(); 
        $('#NUMB_LOOKUP').numeric(); 
        
    });
    
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>


