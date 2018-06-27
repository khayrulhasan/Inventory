<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/lookUp/createUser" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                                <label class="col-sm-3 control-label"
                                       for="description" >User Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="user_name" placeholder="Enter User Name" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Password</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="fld_password" placeholder="Enter Password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" id="confirm_password" required name="confirm_password" placeholder="Enter Confirm Password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" placeholder="Enter Full Name" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >User Type</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown('fld_user_type', $user_type, '', 'id="item_unit" class="form-control searchSelect select2" required'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Active</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="active_status" class="flat-red" checked>
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
        </form>
    </div>
</div>


<script>
    
    
    var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    
    
    
    //select 2
     $(document).ready(function(){
        $('.searchSelect').select2();
    });
    
</script>