<style>
    #message_alert {
        display: none;
    }
</style>

<div class="row content">
    <form action="" id="addType">
        <p id="message_alert"></p>
        <div class="col-md-3">
            <label for="usr">Type name</label>
            <input type="text" value=""  placeholder="Enter New Type" name="type_name" class="form-control input-sm" id="typeName">
        </div>
        <div class="col-md-3">
            <input type="submit" value="Submit" class="btn btn-primary" style="position: relative; top: 20px;">
        </div>
    </form>
</div>

<div class="row content" style="margin-top: -150px;">
    <h3>List Of Type</h3>
    <div class="box" onload="onLoadDocFunction()">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists as $key => $values) { ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $values->name; ?></td>
                            <td style="text-align: center">
                                <div class="kc-toggle"><input name="checkbox-1451299696318" toggle="true" required="false" type="checkbox" id="checkbox-1451299696318"><div class="kct-inner"><div class="kct-on">On</div><div class="kct-handle"></div><div class="kct-off">Off</div></div></div>
                                &nbsp; | &nbsp;
                                <a onclick="return confirm('Do you want to Delete to <?php echo $values->name?> ?')" href="<?php echo base_url() ?>index.php/mm/delete_type/<?php echo $values->id ?>"><i class="fa fa-times" title="Delete" style="font-size: 22px; color: orange">&nbsp;&nbsp;&nbsp;</i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
        </div>
    </div>
</div>

<script>
    
    
    $(document).ready(function (){
        
        $('#addType').on('submit',function(){
            
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?php echo site_url('index.php/mm/saveTypeByAjax') ?>",
                data: ({
                    name: $('#typeName').val()
                }),
                success: function (data){
                }
            
            });
        });
       
       
        
    });
    
</script>