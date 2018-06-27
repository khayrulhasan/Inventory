<style>
    h5{
        font-weight: 400
    }

</style>

<?php
if ($views[0]->status == !0) {
    echo "<h5>Activate <span style='text-transform: capitalize; color:#3C8DBC; font-weight: bold;'>" . $views[0]->name . '</span> Form  View' . "</h5>";
} else {
    echo "<h5>Inactivate <span style='text-transform: capitalize; color:#3C8DBC; font-weight: bold;'>" . $views[0]->name . '</span> Form  View' . "</h5>";
}
?>
<div id="main_content_wrap" class="outer">
    <section id="main_content" class="inner">
        <div class="build-form" style="display: none">
            <h2><strong>Build The Form</strong></h2>
            <form action="">
                <input type="hidden" id="tableId" value="<?php echo $views[0]->id; ?>">
                <input type="hidden" id="tableName" value="<?php echo $views[0]->name; ?>">
                <textarea name="form-builder-template" id="form-builder-template" cols="30" rows="10"><?php echo $views[0]->xml_text; ?></textarea>
            </form>
            <br style="clear:both">
        </div>
        <!--Text Bellow Hello-->
        <div class="render-form">
            <!--            form rndr-->
            <form id="rendered-form" method="post"></form>
            
            <div class="render-description">
                <button id="render-form-button" style="display: none">&nbsp;</button><br/><br/><br/>
                <?php if ($views[0]->status == 0) { ?>
                    <button id="submit-form-button" class="btn btn-primary" style="margin-left: 50px">Activate This Form</button>
                <?php } ?>
            </div>
            
        </div>
        <br style="clear:both">
    </section>
</div>


<script>
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
</script>


<script>
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
    
    //rndr the file as form
    $(window).load(function (){
        $( "#render-form-button" ).trigger( "click" );
    });
</script>



<!--Generate Query For create Table-->



<script>
    $(document).ready(function(){
        $("#submit-form-button").click(function(){
            var elements = [];
            var items = $("#rendered-form :input").map(function(index, elm) {
                return {name: elm.name, type:elm.type, value: $(elm).val()};
            });
            
            $.each(items, function(i, d){
                if ($.inArray(" "+"`"+d.name+"`"+" "+((d.type==='date')? "DATE": "VARCHAR(50)"), elements) == -1) elements.push(" "+"`"+d.name+"`"+" "+((d.type==='date')? "DATE": "VARCHAR(50)"));
            });
            var tableId= $('#tableId').val();
            var tableName= $('#tableName').val();
            var fieldName= elements.toString();
            
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/lookUp/createTables",
                type: "POST",
                data: ({
                    tableId: tableId,
                    tableName: tableName,
                    tableField: fieldName
                }),
                success: function(data){
                    window.location.replace("<?php echo base_url(); ?>index.php/lookUp/activateFormList");
                    window.location.href("<?php echo base_url(); ?>index.php/lookUp/activateFormList");
                }
                
            });
        });
    });
    
</script>