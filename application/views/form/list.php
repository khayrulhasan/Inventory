<style>
    #dialog-overlay {
        display: none;
        opacity: 0.25;
        position: fixed;
        top: 0px;
        left: 0px;
        background: #000;
        width: 100%;
        z-index: 100;
    }
    #dialog-box {
        display: none;
        position: fixed;
        background: #FFF;
        width: 550px;
        z-index: 101;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -webkit-box-shadow: 4px 4px 3px 3px rgba(0, 0, 0, 0.35);
        -moz-box-shadow: 4px 4px 3px 3px rgba(0, 0, 0, 0.35);
        box-shadow: 4px 4px 3px 3px rgba(0, 0, 0, 0.35);
    }
    #dialog-box > div {
        background:#FFF;
        margin:8px;
    }
    #dialog-box > div > #dialog-box-head {
        background: #FFF;
        font-size: 19px;
        padding: 10px;
        color: #000;
    }
    #dialog-box > div > #dialog-box-body {
        background: #FFF;
        padding: 20px;
        color: #000;
    }
    #dialog-box > div > #dialog-box-foot {
        background: #FFF;
        padding: 10px;
        text-align: right;
    }
</style>

<section class="content">
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
                                   <a  href="<?php echo base_url() ?>index.php/lookUp/editForm/<?php echo $values->id ?>"><i class="fa fa-pencil-square-o" title="Edit" style="font-size: 22px; color: orange"></i></a>  &nbsp; | &nbsp;
                                   <a  href="<?php echo base_url() ?>index.php/lookUp/view/<?php echo $values->id ?>"><i class="fa fa-eye" title="View" style="font-size: 18px; color: #3c8dbc">&nbsp;</i></a> 
                                <?php if ($values->status == !0) { ?> &nbsp; | &nbsp;
                                    <div class="kc-toggle"><input name="checkbox-1451299696318" toggle="true" required="false" type="checkbox" id="checkbox-1451299696318"><div class="kct-inner"><div class="kct-on">On</div><div class="kct-handle"></div><div class="kct-off">Off</div></div></div>
                                    &nbsp; | &nbsp;
                                    <a onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url() ?>index.php/lookUp/deleteForm/<?php echo $values->id ?>"><i class="fa fa-times" title="Delete" style="font-size: 22px; color: orange">&nbsp;&nbsp;&nbsp;</i></a> 
                                <?php } else { ?>
                                    &nbsp; | &nbsp;
                                    <a onclick="return confirm('Are you sure to Delete?')" href="<?php echo base_url() ?>index.php/lookUp/deleteFormInactivate/<?php echo $values->id ?>"><i class="fa fa-times" title="Delete" style="font-size: 22px; color: orange">&nbsp;&nbsp;&nbsp;</i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>  
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    function onLoadDocFunction() {
        //        $.ajax({
        //            type: 'POST',
        //            dataType: 'json',
        //            url: "<?php echo base_url() ?>index.php/mm/getActivateDataByAjax", // Get all for actve form,
        //            success: function(data){
        //                console.log(data);
        //            }
        //        })

        alert('dfsdf')
    };

</script>