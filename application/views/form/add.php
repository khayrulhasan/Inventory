<style>
    .save {
        display: none
    }
    .frmb-xml {
        height: 500px !important; overflow: scroll;
    }
    #message_alert {
        display: none;
    }
    ul.frmb {
        list-style-type: none;
        min-height: 200px;
        margin: 0 0 5px;
        padding: 5px 5px 0;
    }
    
    .view-xml {
        display: none
    }
    
</style>

<div id="main_content_wrap" class="outer">
    <section id="main_content" class="inner">
        <div class="build-form">
            <p class="alert alert-success" id="message_alert"></p>
            <form action="" id="commentAsForm">
                <div class="row container-fluid">    
                    <div class="col-md-4" style="margin-left: -10px;"><level>Enter Form Name</level><input type="text" id="titleValue" placeholder="Enter Form Name" name="formName" required="4" class="col-md-4 form-control input-sm"></div>
                    <div class="col-md-3">   
                        <level>Select Item Name</level>
                        <select class="form-control input-sm" required="1" name="variant_option" id="variant_option">
                            <?php foreach ($variant as $key => $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name ?></option>
                            <?php } ?>
                        </select><br/>
                    </div>
                    <div class="col-md-5">&nbsp;</div>
                </div>
                <textarea name="form-builder-template" id="form-builder-template" cols="30" rows="10"></textarea>
                <input  onclick="confirm('Are You Sure')" type="submit" class="btn btn-primary" style="position: relative; top: 65px" value="Save Form" />
            </form>
            <br style="clear:both">
        </div>

        <div class="render-form">
            <br/>
            <h2><strong>Render The Form</strong></h2>
            <form id="rendered-form">
                <p class="cta">Add some fields to the formBuilder above and render them here.</p>
            </form>
            <div class="render-description">
                <h3>Try it out</h3>
                <button id="render-form-button" class="btn btn-primary">Render form</button>
            </div>
        </div>
        <br style="clear:both">
    </section>
</div>


<script>
    
//    For Form Builder===================================================================================
    
    jQuery(document).ready(function($) {
        'use strict';
        var template = document.getElementById('form-builder-template'),
        formContainer = document.getElementById('rendered-form'),
        renderBtn = document.getElementById('render-form-button');
        $(template).formBuilder();

        $(renderBtn).click(function(e) {
            e.preventDefault();
            $(template).formRender({
                container: $(formContainer)
            });
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




//For Ajax Request by save form =======================================================

    $(function(){
        $("#commentAsForm").submit(function(){
            dataString = $("#commentAsForm").serialize();
            var title = $('#titleValue').val();
            var variant_option = $('#variant_option').val();
            var textXml = $('#form-builder-template').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/lookUp/saveForm",
                data: ({
                    name: title,
                    variant_option: variant_option,
                    xml_text: textXml
                }),
                success: function(data){
                    $("#message_alert").html("Form Saved Sucessfully !");
                    $( "#message_alert" ).fadeIn( "slow", function() {
                        $('#message_alert').show();
                    });
                    setInterval(function(){ 
                        $( "#message_alert" ).fadeOut( "slow", function() {
                            $('#message_alert').hide();
                            $('#myModal').modal('hide');
                            location.reload();
                        }); 
                    },3000);
                    $('#commentAsForm')[0].reset();
                    location.reload();
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
    
    //ui-dialog ui-dialog-content
    var manson=$(".ui-dialog-content").text();
    console.log(manson);
         
         
    
</script>


