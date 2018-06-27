

<span style="float: right;"><button type="button"  data-action="<?php echo base_url() ?>index.php/lookUp/addGroup"   data-toggle="tooltip"  title="Add New Group" modal-head="Add New Group Form" class="dynamicFormModal btn btn-success"><i class="fa fa-plus"></i></button></span>
<br clear="all" />
<div class="bs-example" data-example-id="collapse-accordion">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php foreach ($result as $value) { ?>
            <div class="panel panel-default">
                <div class="panel-heading collapsed" role="tab" id="headingThree"
                     role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $value->LOOKUP_GRP_ID; ?>">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $value->LOOKUP_GRP_ID; ?>" aria-expanded="false" aria-controls="collapseThree">
                            <?php echo $value->LOOKUP_GRP_NAME; ?>
                        </a>
                    </h4>
                </div>
                <div id="<?php echo $value->LOOKUP_GRP_ID; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <span style="float: right;"><button type="button"  data-action="<?php echo site_url("index.php/lookUp/addGroupItem/" . $value->LOOKUP_GRP_ID . "/" . $value->USE_CHAR_NUMB); ?>"   data-toggle="tooltip"  title="Add Group Item" modal-head="Add Group Item Form" class="dynamicFormModal btn-xs btn btn-info"><i class="fa fa-plus"></i></button></span>
                            </div> 
                        </div> 
                        <br/>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th><?php
                        if ($value->USE_CHAR_NUMB == 'N') {
                            echo "SHORT NAME(N)";
                        } else {
                            echo "SHORT NAME(C)";
                        }
                            ?></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="child<?php echo $value->LOOKUP_GRP_ID ?>">
                                <?php
                                $result = $this->utilities->findAllByAttribute('sa_lookup_data', array('LOOKUP_GRP_ID' => $value->LOOKUP_GRP_ID));
                                if (!empty($result)) {
                                    $sr = 1;
                                    foreach ($result as $group_item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sr++; ?></td>
                                            <td><?php echo $group_item->LOOKUP_DATA_NAME; ?></td>
                                            <td><?php
                            if ($value->USE_CHAR_NUMB == 'N') {
                                echo $group_item->NUMB_LOOKUP;
                            } else {
                                echo $group_item->CHAR_LOOKUP;
                            }
                                        ?></td>
                                            <td><?php echo ($group_item->ACTIVE_FLAG == 1) ? '<span class="btn-xs btn-success waves-effect waves-button waves-float">Active</span>' : '<span class="btn-xs btn-danger waves-effect waves-button waves-float">Inactive</span>';
                                        ?></td>
                                            <td>
                                                <button type="button"  data-action="<?php echo base_url() ?>index.php/lookUp/editGroupItem/<?php echo $group_item->LOOKUP_DATA_ID; ?>"   data-toggle="tooltip"  title="Edit Item Group" modal-head="Edit Item Group Form" class="dynamicFormModal btn-xs btn btn-info"><i class="fa fa-pencil-square-o"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // for Group Item data saved
        $(document).on('submit', '#save_group_data', function (e) {
            e.preventDefault();
            if ($("#LOOKUP_DATA_NAME").val() == '') {
                alert("Field is required");
                $("#LOOKUP_DATA_NAME").focus();
            } else {
                var LOOKUP_DATA_NAME = $("#LOOKUP_DATA_NAME").val();
                var LOOKUP_GRP_ID = $("#LOOKUP_GRP_ID").val();
                var USE_CHAR_NUMB = $("#USE_CHAR_NUMB").val();
                var NUMB_LOOKUP = $("#NUMB_LOOKUP").val();
                var CHAR_LOOKUP = $("#CHAR_LOOKUP").val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('index.php/lookUp/saveGroupIitem'); ?>',
                    data: {
                        LOOKUP_DATA_NAME: LOOKUP_DATA_NAME,
                        LOOKUP_GRP_ID: LOOKUP_GRP_ID,
                        USE_CHAR_NUMB: USE_CHAR_NUMB,
                        NUMB_LOOKUP: NUMB_LOOKUP,
                        CHAR_LOOKUP: CHAR_LOOKUP,
                        ACTIVE_FLAG: ($('#ACTIVE_FLAG').is(':checked')) ? 1 : 0
                    },
                    success: function (data) {
                        $("#child" + LOOKUP_GRP_ID).html(data);
                        $("#myModalAddItem").modal("hide");
                    }
                });
            }
        });
        
        
        // update Group Item data 
        $(document).on('submit', '#update_group_data', function (e) {
            e.preventDefault();
            if ($("#LOOKUP_DATA_NAME").val() == '') {
                alert("Field is required");
                $("#LOOKUP_DATA_NAME").focus();
            } else {
                var LOOKUP_DATA_NAME = $("#LOOKUP_DATA_NAME").val();
                var LOOKUP_DATA_ID = $("#LOOKUP_DATA_ID").val();
                var LOOKUP_GRP_ID = $("#LOOKUP_GRP_ID").val();
                var USE_CHAR_NUMB = $("#USE_CHAR_NUMB").val();
                var CHAR_LOOKUP = $("#CHAR_LOOKUP").val();
                var NUMB_LOOKUP = $("#NUMB_LOOKUP").val();
                var active_flag = ($('#active_flag').is(':checked')) ? 1 : 0;
                //alert(GRP_ID);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('index.php/lookUp/updateGroupItem'); ?>',
                    data: {
                        LOOKUP_DATA_NAME: LOOKUP_DATA_NAME,
                        LOOKUP_GRP_ID: LOOKUP_GRP_ID,
                        USE_CHAR_NUMB: USE_CHAR_NUMB,
                        CHAR_LOOKUP: CHAR_LOOKUP,
                        NUMB_LOOKUP: NUMB_LOOKUP,          
                        active_flag: active_flag,
                        LOOKUP_DATA_ID: LOOKUP_DATA_ID
                    },
                    success: function (data) {
                        $("#child" + LOOKUP_GRP_ID).html(data);
                        $("#myModalAddItem").modal("hide");
                    }
                });
            }

        });
    });
</script>





