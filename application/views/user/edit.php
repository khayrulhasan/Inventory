<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/lookUp/editUser" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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

                            <input type="hidden" name="user_id" value="<?php echo $row->id ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >User Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row->name ?>" name="user_name" placeholder="Enter User Name" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group password_field">
                                <label class="col-sm-3 control-label"
                                       for="description" >Password</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="fld_password" placeholder="Enter New Password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group password_field">
                                <label class="col-sm-3 control-label"
                                       for="description" >Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" placeholder="Enter Full Name" value="<?php echo $row->fullName ?>" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >User Type</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown('fld_user_type', $user, $row->user_type, 'class="form-control searchSelect" required'); ?>
                                </div>
                                <div class="col-sm-5 password_button_off">
                                    <input type="button" value="Show Password Field" class="btn btn-default form-control"/>
                                </div>
                                <div class="col-sm-5 password_button_on">
                                    <input type="button" value="Hide Password Field" class="btn btn-default form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"
                                       for="description" >Active</label>
                                <div class="col-sm-9">
                                     <input type="checkbox" name="active_flag" id="active_flag" class="checkBoxStatus flat-red" <?php echo $row->active_status == 1 ? 'checked' : ''; ?>
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
        $('.password_field').hide();
        $('.password_button').show();
        $('.password_button_on').hide();
        $('.searchSelect').select2();
    });
    
    $('.password_button_off').on('click', function(){
        $('.password_field').show();
        $('.password_button_off').hide();
        $('.password_button_on').show();
    });
    $('.password_button_on').on('click', function(){
        $('.password_field').hide();
        $('.password_button_off').show();
        $('.password_button_on').hide();
    });
    
</script>