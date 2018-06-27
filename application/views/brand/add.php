<style>
    .alert-info {
        height:40px;
        line-height: 10px;
        border-radius: 0px;
        background: #3C8DBC !important;
    }

    .img-thumbnail {
        height: 158px !important;
    }

    #brand_content {
        display: block;
    }

    #dose_content {
        display: none;
    }

    #ingredient_content {
        display: none;  
    }

    table, td {
        border: none !important;
    }
</style>

<div id="brand_content">
    <div class="row">
        <p class="alert alert-info">Brand Setup</p>
        <?php echo form_open(); ?>
        <div class="form-group col-md-3">
            <label for="usr">Brand name</label>
            <?php echo form_input(array('name' => 'brand_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Generic name</label>
            <?php echo form_input(array('name' => 'generic_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Therapeutic Name</label>
            <?php echo form_input(array('name' => 'therapeutic_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Manufacturer name</label>
            <?php echo form_input(array('name' => 'manufacturer_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Origin</label>
            <?php echo form_input(array('name' => 'manufacturer_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Trade Name</label>
            <?php echo form_input(array('name' => 'manufacturer_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Presentation</label>
            <?php echo form_input(array('name' => 'manufacturer_name', 'class' => 'form-control input-sm', 'value' => set_value('MEETING_SUBJECT'))); ?>
        </div>
        <div class="form-group col-md-1" style="padding-top: 20px;">
            <label for="usr">ATC ?</label>
            <?php echo form_checkbox('ambience[]', 'value', set_checkbox('ambience', 'value')); ?>
        </div>
        <div class="form-group col-md-1" style="padding-top: 20px;">
            <label for="usr">OTC</label>
            <?php echo form_checkbox('ambience[]', 'value', set_checkbox('ambience', 'value')); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <level>Medicine Packet</level>
            <img src="http://localhost/MaterialsManagement.com/uploads/gallery/thumb/2016012314535484012677835.jpg" class="img-thumbnail" alt="Cinque Terre" width="304" height="100"> 
        </div>
        <div class="form-group col-md-3">
            <level>Shape</level>
            <div class="img-thumbnail icon-circle icon-6" style="width:304px; height:100px"><i class="">&nbsp;</i></div>
        </div>
        <div class="form-group col-md-3">
            <level>Color</level>
            <div class="img-thumbnail icon-circle icon-6" style="width:304px; height:100px"><i class="">&nbsp;</i></div>
    <!-- <img src="http://localhost/MaterialsManagement.com/uploads/gallery/thumb/2016012314535484012677835.jpg" class="img-thumbnail" alt="Cinque Terre" width="304" height="100"> -->
        </div>
        <div class="form-group col-md-3">
            <level>Imprint</level>
            <div class="img-thumbnail icon-circle icon-6" style="width:304px; height:100px"><i class="">&nbsp;</i></div>
    <!-- <img src="http://localhost/MaterialsManagement.com/uploads/gallery/thumb/2016012314535484012677835.jpg" class="img-thumbnail" alt="Cinque Terre" width="304" height="100"> -->
        </div>
    </div>
    <div class="row">
        <center>
            <input type="button" class="btn btn-primary" id="first_form_next" value="Next">
        </center>
    </div>
</div>


<div id="dose_content">
    <div class="row">
        <p class="alert alert-info">Add New Used Formula</p>
        <div class="row container table-responsive" style="padding: 0 50px 0 30px;">
            <table class="table table-ingredient table-striped">
                <thead>
                    <tr>
                        <th class="col-md-4">Dose Form</th>
                        <th>Str. Val</th>
                        <th>S Unit</th>
                        <th>Strength</th>
                        <th>Mnemonic Code</th>
                        <th>Dispense Form</th>
                        <th>ATC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="" style="width: 100%"></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                    <tr>
                        <td><input type="text"  name="" style="width: 100%"></td>
                        <td><input type="text" name="" ></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="" style="width: 100%"></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <center>
                <input type="button" class="btn btn-primary" id="second_form_previous" value="Previous" >
                <input type="button" name="" value="Next" id="second_form_next" class="btn btn-primary">
            </center>
        </div>
    </div>
</div>



<div id="ingredient_content">
    <div class="row">
        <p class="alert alert-info">Etch Medicine Content</p>
        <div class="row container table-responsive" style="padding: 0 50px 0 30px;"> 
            <table class="table table-ingredient table-striped">
                <thead>
                    <tr>
                        <th class="col-md-4">Ingredient Name</th>
                        <th>Med Formu</th>
                        <th>Strength</th>
                        <th>S Unit</th>
                        <th>Active</th>
                        <th>SI/NO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="" style="width: 100%"></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="" style="width: 100%"></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="" style="width: 100%"></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input class="ckbox" type="checkbox" name=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <center>
                <input type="button" class="btn btn-primary" id="third_form_previous" value="Previous" >
                <input type="button" name="" id="secssond_form_next" class="btn btn-primary" value="Submit">
            </center>
        </div>
    </div>
</div>



<script>
    
    //===================Requard information setup========================================
    $("#first_form_next").click(function(){
        $("#dose_content").show();
        $("#brand_content").hide();
        $("#ingredient_content").hide();
    });
    
    
    //===================dose information setup========================================
    $("#second_form_previous").click(function(){
        $("#brand_content").show();
        $("#dose_content").hide();
        $("#ingredient_content").hide();
    });
    $("#second_form_next").click(function(){
        $("#ingredient_content").show();
        $("#brand_content").hide();
        $("#dose_content").hide();
    });
    
    
    //===================dose information setup========================================
    $("#third_form_previous").click(function(){
        $("#dose_content").show();
        $("#brand_content").hide();
        $("#ingredient_content").hide();
    });
    
</script>