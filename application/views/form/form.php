<style>
    .leftside {
        background: #F4F5F7;
        height: auto;
        padding: 20px;
    }

    .rightPanel {
        background: #F4F5F7;
        height: auto;
    }

    .upDownIcon {
        display: inline-block;
    }

    .leftPnel {
        height: 500px;
        background: rgba(34, 45, 50, 0.77);
        border-radius:3px;
    }
    .box:first-child {
        margin-top: 0px;
    }

    .box {
        height: 120px;
        margin-top: 20px;
        position: relative;
        border-radius: 3px;
        background: #2196F3;
        border-top: 3px solid #2196F3;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0px 1px 1px rgba(158, 158, 158, 0.84);
        border: 1px solid rgba(158, 158, 158, 0.44);
    }

    .table {
        border : none;
    }

    .table thead th,.table thead td  {
        font-size: 12px;
        font-weight: bolder !important;
        margin: 0px; padding: 0px;
    }

    .btn-info {
        background: #2196F3 !important;
    }

    table input {
        width: 100% !important;
    }

    ul li{
        list-style: none
    }


    /*    .ckbox{
            position: relative; left: -10px; 
        }*/

    table, td {
        border: none
    }

    .btn {
        width: 100%;
        border-radius:2px;
        box-shadow: 0px 1px 1px #898C95;
    }

    table th {
        background: rgba(105, 105, 105, 0.27);
        color: black;
        text-shadow: 1px 1px 1px #F4F5F7;
    }

    html input[type=button] {
        background: #607D8B;
        color: white;
        text-shadow: 1px 1px 1px black;
    }
    html input[type=button]:hover {
        color: white; background: #009688
    }

    .selecComobox {
        padding: 20px;
        color: white;
    }
    
     .modal-image-list {
        text-align: center;
    }

</style>


<div class="row">


    <!-- Modal for all images show-->
    <div class="modal fade" id="imagesModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Show All Images</h4>
                </div>
                <div class="modal-image-list"></div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for all images show-->


    <!--    side part-->
    <div class="col-md-3 leftside">

        <div class="box">
            <div class="row container">

                <div class="row selecComobox">

                    <ul style="float: left; clear: right">
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                    </ul>
                    <ul style="float: left; margin-left: 50px;">
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                        <li>
                        <level>By Brand</level>&nbsp;&nbsp;
                        <input type="checkbox" name="byBrand">
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-md-12 leftPnel">
            <br/>
            <select id="itemSelect" data-atleast="1">
                <?php

                function createTree($variant_list) {
                    foreach ($variant_list as $key => $cat) {
                        $cat_id = $cat['id'];
                        echo '<option value="' . $cat_id . '"data-level="' . $cat['level'] . '">' . $cat['name'];
                        if (!empty($cat['children'])) {
                            createTree($cat['children']);
                        }
                        echo "</option>";
                    }
                }

                createTree($variant_list);
                ?>
            </select>

        </div>
    </div>
    <!--side part -->

    <!--    middle part-->
    <div class="col-md-7 rightPanel">

        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <label for="usr">Generic Name</label>
                    <input type="text" value="" name="quantity" class="form-control input-sm" id="usr">
                </div>
                
                <div class="col-md-4">
                    <label for="usr">&nbsp;</label>
                    <input type="button" value="Preview" name="quantity" class="btn btn-neutral" id="usr">
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <label for="usr">Brand Name</label>
                    <input type="text" value="" name="quantity" class="form-control input-sm" id="usr">
                </div>
                <div class="col-md-4">
                    <label for="usr">&nbsp;</label>
                    <input type="button" value="Generic Setup" name="quantity" class="btn btn-neutral" id="usr">
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <label for="usr">Therapeutic Group</label>
                    <textarea cols="80" class="col-md-10" style="min-width: 510px;" rows="4"></textarea>
                </div>
                <div class="col-md-0">
                    <span style="position: relative; top: 30px; left: -5px;">
                        <label for="usr">Act ?&nbsp;</label>
                        <input type="checkbox" value="Generic Setup" name="quantity" id="usr"><br/>
                        <label for="usr">OTC ?</label>
                        <input type="checkbox"   class="" id="usr">
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <label for="usr">Manufacturer</label>
                    <input type="text" value="" name="quantity" class="form-control" id="usr">
                </div>
                <div class="col-md-3">
                    <label for="usr">Origin</label>
                    <input type="text" value="Bangladesh" name="quantity" class="form-control input-sm" id="usr">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="button" class="btn btn-neutral" style=" margin-top: 20px; margin-bottom: 20px;" value="Add New Used Formula">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table--formula table-striped">
                        <thead>
                            <tr>
                                <th>Dose Form</th>
                                <th>Str. Val</th>
                                <th>S Unit</th>
                                <th>Strength</th>
                                <th>Mnemonic</th>
                                <th>Dispense</th>
                                <th>ACT?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input class="ckbox" type="checkbox" name=""></td>
                            </tr>
                            <tr>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input class="ckbox" type="checkbox" name=""></td>
                            </tr>
                            <tr>
                                <td><input type="text" name=""></td>
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
            </div>

            <div class="row">
                <div class="col-md-12">
                    <level>Trade Name</level>
                    <input type="text" class="col-md-12 form-control" name="userName">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <level>Trade Name</level>
                    <textarea rows="2" class="col-md-12" cols="85"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="col-md-12 table table-ingredient table-striped" style="margin-top: 25px;">
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
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input class="ckbox" type="checkbox" name=""></td>
                            </tr>
                            <tr>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input class="ckbox" type="checkbox" name=""></td>
                            </tr>
                            <tr>
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
            </div>

        </div>

    </div>

    <!--middle part-->


    <!--right side part-->
    <div class="col-md-2 leftside">
        <div class="box">
            <a id="imageMore" type="button" class="btn btn-info btn-lg" style="font-size: 22px; width: 10px; height: 10px;" href="#"><img id="itemImage" style=" border-radius:2px ; position: relative; top: 10px;  left: 14px;" height="98" width="117"><span style="z-index: 999999; position: relative; top: -28px; left: 115px; text-shadow: 1px 2px 1px white">+</span></a>
        </div>
        <div class="box">
            <span style="overflow: hidden; position: relative; top: 15px;" class="html5colorpicker"></span>
        </div>
        <div class="box">
           <img id="canvasImage" style=" border-radius:2px ; position: relative; top: 10px;  left: 14px;" height="98" width="117">
        </div>

    </div>
    <!--side part-->

</div>


<script type="text/javascript">
    
    
    $(document).ready(function(){
        $("#imageMore").hide();
        
        $('.html5colorpicker').click(function() {
            var getColorVlaue = $(this).attr('value');
            console.log(getColorVlaue);
        });
        
        
        //=======Data Bind and get id==========================================================================
       
        $("select#itemSelect").smartselect({
            multiple: false,
            toolbar: {
                buttonView: 'level+selected'
            },
            style: {
                select: 'dropdown-toggle btn btn-info'
            }
        });
        
        //Get item id by click on this item
        var selectedGetItemId;
        $('.smartselect .dropdown-menu li').click(function() {
            selectedGetItemId =( $(this).attr('data-value') );
        });
        
        
        //=======On Select Function==========================================================================
         
        $(".ss-label").bind("DOMSubtreeModified", function() {
            $("#required_content").show("slide", { direction: "right" }, 1);
            $("#additional_content").hide("slide", { direction: "right" }, 1);
            $("#manufacture_content").hide("slide", { direction: "right" }, 1);
            $("#definition_content").hide("slide", { direction: "right" }, 1);
           
            $(".html5colorpicker").html("");// clear color container class 
           
            var txt = $(".dropdown-toggle > span.ss-label").text();
            $("#current_title").html(txt);
            
            var imagePath="<?php echo base_url() ?>uploads/gallery/thumb/";
           
            if(selectedGetItemId != 'selectedGetItemId'){    
                console.log();
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>index.php/mm/getVariantById", // Get all for variant data 
                    data: ({
                        ID: selectedGetItemId
                    }),
                    success: function(data){
                        $("#canvasImage").attr('src',data.canvas_image);
                        var multipleColor=(data.colorpicker); // bind multiple color for item 
                        var mulColor=multipleColor.split(', ');
                        $.each(mulColor, function(i, item) {
                            $(".html5colorpicker").append(function() {
                                return('<input type="color" title="Select This Color"  class="html5colorpicker" name="colorpicker" disabled="disabled" value="'+mulColor[i]+'" style="width:30px; height: 26px; margin-top:2px; margin-left:3px; ">');  
                            }); 
                        });
                        
                        $("#imageMore").attr('value',data.id);// Set image id by item id
                       
                        //show plus sign for view all images
                        if((data.gallery_path)!= null){
                            $("#imageMore").show();
                            $('#itemImage').attr('src', imagePath+data.gallery_path);
                            $('#imageMore').attr('class', 'showImageMoreButton'); 
                            $('#itemImage').attr('title', 'Item Image'); 
                        }else{
                            $("#imageMore").show();
                            $('#itemImage').attr('src', imagePath+'no_image.png'); 
                            $('#imageMore').attr('class', 'hideImageMoreButton'); 
                            $('#itemImage').attr('title', 'No Image'); 
                        }
                    }
                });
            }

        });
        
        
        //Image More Button showing for variant all image-------------------------
        $('#imageMore').click(function() {
            var selectedImageId =( $(this).attr('value') );
            $("#imagesModal").modal();//call modal
            if(selectedImageId != ''){    
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>index.php/mm/getVariantAllImages", // Get variant's all images  
                    data: ({
                        ID: selectedImageId
                    }),
                    success: function(data){
                        $.each(data, function(i, item) {
                            $(".modal-image-list").append(function() {
                                return('<img src="<?php echo base_url() ?>uploads/gallery/thumb/'+item.gallery_path+'">');  
                            }); 
                        });
                    }
                });
            }
            
        });
        // close image more button modal------------------------------------------
        $("#imagesModal").on("hidden.bs.modal", function() {
            $(".modal-image-list").html("");
        });
        
        //===================additional information setup========================================
        $("#additionalInfoSetup").click(function(){
            $("#additional_content").show("slide", { direction: "right" }, 1);
            $("#required_content").hide("slide", { direction: "right" }, 1);
            $("#manufacture_content").hide("slide", { direction: "right" }, 1);
            $("#definition_content").hide("slide", { direction: "right" }, 1);
            
            
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>index.php/mm/getFormById",
                data: ({
                    ID: selectedGetItemId
                }),
                success: function(data){
                    $("#tableName").val(data.name);   
                    $("textarea#form-builder-template").val(data.xml_text);   
                    $("#render-form-button").click();
                }
            });
            
            
            //Save requird data save to database
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>index.php/mm/saveRequirdDataByAjax",
                data: $("form#requiredForm").serialize(),
                success: function(data){
                    $("#item_id").val(data)
                }
            });
        });
        
        
        
        //====================manufacturer information setup=====================================
        $("#manufactureInfoSetup").click(function(){
            $("#manufacture_content").show("slide", { direction: "right" }, 1);
            $("#required_content").hide("slide", { direction: "right" }, 1);
            $("#additional_content").hide("slide", { direction: "right" }, 1);
            $("#definition_content").hide("slide", { direction: "right" }, 1);
            
            
            //Save additional data save to database
            var frmData= $("form#rendered-form").serializeArray();
            frmData.push({name: "item_id", value: $("#item_id").val()},{name: "table_name", value: $("#tableName").val()});
            
            console.log(frmData);
            
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>index.php/mm/saveAdditionalDataByAjax",
                data: frmData,
                success: function(data){
                    coonsole.log(data)
                }
            });
            
            
        });
        
        
        
        
        //==============================item definition setup===================================
        $("#itemDefinitionSetup").click(function(){
            $("#definition_content").show("slide", { direction: "right" }, 1);
            $("#required_content").hide("slide", { direction: "right" }, 1);
            $("#additional_content").hide("slide", { direction: "right" }, 1);
            $("#manufacture_content").hide("slide", { direction: "right" }, 1);
        });
        
    });
    
    
   
    
   
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-4784386-21', 'auto');
    ga('send', 'pageview');
        
        
</script>