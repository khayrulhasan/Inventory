<style>
    #message_confirmation {
        color: green;
        display: none;
    }
    .btn-warning, .btn-success, .btn-danger {
        border: none;
    }
</style>

<script>
    ///--------------------------------------
    // confirm delete function
    function confirmFunction(id){
        $.ajax({
            type: "POST",
            dataType: "HTML",
            url: "<?php echo base_url() ?>index.php/lookUp/deleteUser",
            data: ({
                itemid: id
            }),
            success: function(data){
                $("tr td button[data-id='" + id + "']").parents('tr').remove();
            }
        });
    }

    $(document).ready(function () {
        $(".deleteFunction").click(function () {
            $.fn.nbDialogBox({
                id :$(this).attr('data-id'),
                isConfirm: true,
                body: "Are you sure, want to Delete This User ? "
            });
        });

    });
</script>


<div class="row">
    <span style="float: right; margin-right: 20px"><button type="button"  data-action="<?php echo base_url() ?>index.php/lookUp/getUserForm"   data-toggle="tooltip"  title="Create User" modal-head="Create User Form" class="dynamicFormModal btn btn-success"><i class="fa fa-plus"></i></button></span>
</div>
<div class="box">
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>User Name</th>
                    <th>Full Name</th>
                    <th>User Type</th>
                    <th style="width: 80px">User Status</th>
                    <th style="width: 80px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td class="user_status"><?php echo $value->name; ?></td>
                        <td><?php echo $value->fullName; ?></td>
                        <td>
                        <?php echo $value->userType; ?>
                        </td>
                        <td style="text-align: center">
                            <?php echo ($value->active_status == 1) ? '<span class="btn btn-xs btn-success waves-effect waves-button">Active</span>' : '<span class="btn btn-xs btn-danger waves-effect waves-button waves-float">Inactive</span>'; ?>
                        </td>
                        <td style="text-align: center">
                            <button type="button"  data-action="<?php echo base_url() ?>index.php/lookUp/editUser/<?php echo $value->id; ?>"   data-toggle="tooltip"  title="Edit Item" modal-head="Edit Item Form" class="dynamicFormModal btn-xs  btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                            <button type="button" data-id="<?php echo $value->id; ?>"  class="btn-xs btn-danger deleteFunction" data-toggle="tooltip"  title="Delete Item"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>  
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
    
    $('input[type="checkbox"].user_status').on('change',function(){
        alert('khayrul hasan');
    });
</script>