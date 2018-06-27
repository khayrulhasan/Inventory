<style>
    .tree {
        min-height:20px;
        padding:19px;
        margin-bottom:20px;
        background-color:#fbfbfb;
        border:1px solid #999;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
    }
    .tree li {
        list-style-type:none;
        margin:0;
        padding:10px 5px 0 5px;
        position:relative
    }
    .tree li::before, .tree li::after {
        content:'';
        left:-20px;
        position:absolute;
        right:auto
    }
    .tree li::before {
        border-left:1px solid #999;
        bottom:50px;
        height:100%;
        top:0;
        width:1px
    }
    .tree li::after {
        border-top:1px solid #999;
        height:20px;
        top:25px;
        width:25px
    }
    .tree li span {
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #999;
        border-radius:2px;
        display:inline-block;
        padding:3px 8px;
        text-decoration:none
    }
    .tree li.parent_li>span {
        cursor:pointer
    }
    .tree>ul>li::before, .tree>ul>li::after {
        border:0
    }
    .tree li:last-child::before {
        height:30px
    }
    .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
        background:#eee;
        border:1px solid #94a0b4;
        color:#000
    }
</style>

<?php // print_r($tree) ?>


<div class="tree well">
    <?php

    function createTree($tree) {
        echo '<ul>';
        foreach ($tree as $key => $cat) {
            $cat_id = $cat['id'];

            echo '<li>' . '<span><i class="icon-minus-sign"></i><a>' . $cat['name'] . '</a></span>&nbsp;<a type="button" data-toggle="tooltip" title="Add Category" modal-head="Add Category Form" class="btn btn-success btn-xs dynamicFormModal" data-action="' . base_url('index.php/lookUp/addVariant') . '/' . $cat['id'] . '"><i class="fa fa-plus"></i>
' . '</a>' . '&nbsp;&nbsp;<a data-toggle="tooltip" title="Edit Category" modal-head="Edit Category Form" class="btn btn-warning btn-xs dynamicFormModal" data-action="' . base_url('index.php/lookUp//editVariant') . '/' . $cat['id'] . '"' . '><i class="edit_division glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;<a data-toggle="tooltip" title="Delete Category" class="dynamicFormModal btn btn-danger btn-xs" modal-head="Delete Category Form" data-action="' . base_url('index.php/lookUp//deleteVariant') . '/' . $cat['id'] . '">' . '<i class="glyphicon glyphicon-trash"></i>' . '</a>';


            if (!empty($cat['children'])) {
                createTree($cat['children']);
            }
            echo "</li>";
        }
        echo '</ul>';
    }

    createTree($tree);
    ?>  
</div>


<script>
    $(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
    });
</script>