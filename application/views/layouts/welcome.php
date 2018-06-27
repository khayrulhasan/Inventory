<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php
if ($total_stock[0]->totalQuantity) {
    echo $total_stock[0]->totalQuantity;
} else {
    echo "0";
}
?></h3>
                <p>Total Stock</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php
if ($total_given[0]->totalQuantity) {
    echo $total_given[0]->totalQuantity;
} else {
    echo "0";
}
?></h3>
                <p>Given Item</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php
if ($total_consume[0]->totalQuantity) {
    echo $total_consume[0]->totalQuantity;
} else {
    echo "0";
}
?></h3>
                <p>Inconsumable Item</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-star"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php
if ($total_inconsume[0]->totalQuantity) {
    echo $total_inconsume[0]->totalQuantity;
} else {
    echo "0";
}
?></h3>
                <p>Consumable Item</p>
            </div>
            <div class="icon">
                <i class="ion ion-trash-a"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
</div>
<div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area Chart</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="chart_div" style="width: 100%; height: 400px;"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-6 connectedSortable">
        <!-- solid sales graph -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Donut Chart</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="donutchart" style="width: 100%; height: 400px"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>






</div><!-- /.box -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    
    
    console.log(<?php echo $areaChart; ?>);
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Incosumable', 'Consumable'],
            ['Jan',  1000,      0],
            ['Feb',  1170,      0],
            ['Mar',  660,       1120],
            ['Apr',  1030,      540],
            ['May',  1030,      540],
            ['June',  1030,      540],
        ]);

        var options = {
            title: 'Stock Item',
            hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };
        //        var options = {
        //          isStacked: 'relative',
        //          height: 300,
        //          legend: {position: 'top', maxLines: 3},
        //          vAxis: {
        //            minValue: 0,
        //            ticks: [0, .3, .6, .9, 1]
        //          }
        //        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    
    
    var response = <?php echo $pieChart; ?>;
    var dataPieChart = [];
    dataPieChart.push(['Task', 'Hours per Day']);
    for(var x=0; x < response.length; x++){
        var valePie  = response[x].value;
        var levelPie  = response[x].label;
        dataPieChart.push([levelPie, Number(valePie)]);
    }
    console.log(dataPieChart);
    
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(dataPieChart);

        var options = {
            title: 'Item Quantity',
            pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>


