<section class="content" style="margin-right: 50px">
    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value->item_name; ?></td>
                            <td><?php echo $value->item_quantity; ?></td>
                            <td><?php echo $value->unit_name; ?></td>
                            <td>
                                <a href="" class="btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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
        $("#example1").DataTable( {
            "lengthMenu": [[10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        } );
    });
</script>