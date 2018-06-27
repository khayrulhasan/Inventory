<style>
    h3, h4 {
        padding-bottom: -15px !important;
        color: #585858;
    }
    .table-header{
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid black;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        font-family:sans-serif; transform: scaleX(1.14799);
    }
    th {
        background-color: #BDBDBD;
        font-size: 14px;
        color: #FFFFFF;
    }

    th, td {
        text-align: left;
        padding: 6px;
        font-size: 12px;
    }

    tr:nth-child(even){background-color: #f2f2f2}
    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }
</style>
<?php
foreach ($category as $key => $valueCat) {
    echo '<div class="table-header"><h3><i class="fa fa-asterisk" aria-hidden="true"><img src="http://localhost/inventory/uploads/fclose.png" height="25" width="25" style="position:relative; top:15px">' . $valueCat->cat_name . '</h3>';
    getSubCategory($valueCat->fld_category_id);
}

function getSubCategory($cat) {
    $CI = & get_instance();
    $CI->load->database();
    $CI->load->model('reportsModel');
    $subCategory = $CI->reportsModel->getSubCategoryName($cat);
    //var_dump($subCategory);
    foreach ($subCategory as $key => $valueSubCat) {
        echo '<h4><i class="fa fa-asterisk" aria-hidden="true"><img src="http://localhost/inventory/uploads/fopen.png" height="25" width="25" style="position:relative; top:15px">' . $valueSubCat->subCategoryName . '</h4></div>';
        getItem($valueSubCat->fld_item_id);
    }
    echo '<br/><br/>';
}

function getItem($subCat) {
    $CI = & get_instance();
    $CI->load->database();
    $CI->load->model('reportsModel');
    $item = $CI->reportsModel->getItemName($subCat);
    echo '<table>';
    echo '<tr>
    <th>Item Name</th>
    <th>Lastname</th>
    <th>Savings</th>
    <th>Savings</th>
    </tr>';
    foreach ($item as $key => $valueItem) {
        echo '<tr>';
        echo '<td>' . $valueItem->fld_item_name . '</td>';
        echo '<td>' . $valueItem->fld_description . '</td>';
        echo '<td>' . $valueItem->fld_unit . '</td>';
        echo '<td>' . $valueItem->fld_item_name . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</br/>';
}
?>