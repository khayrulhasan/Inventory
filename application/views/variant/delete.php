<div class="modal fade" id="myModalAddItem" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ?>index.php/lookUp/deleteCategory/<?php echo $id?>" method="post" class="form-horizontal" role="form">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" 
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Distributor
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>Are You Sure ?</p>
                    
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" id="addItemForm"  value="Delete" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

