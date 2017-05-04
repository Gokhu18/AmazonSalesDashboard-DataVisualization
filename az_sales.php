<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <!-- importing boostrap libraries -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>        
    
    <script src="js/anychart.min.js"></script>
    <script src="js/anychart-ui.min.js"></script> 
<!--     <script src="http://cdn.anychart.com/samples-data/dashboards/acme-corp-sales-dashboard/data.js"></script> -->
    <script src="az_source.js"></script>
          <!-- 1. Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- 2. jQuery MUST come before the Bootstrap.min.js !!!!!!!! :)   --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  

    <!-- 3. Bootstrap core JavaScript --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.anychart.com/js/7.13.1/anychart-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.anychart.com/css/7.13.1/anychart-ui.min.css" />

        
        
        <title>Amazon Sales Dashboard</title>
        <style>
         html, body{
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }

        #container {
             width: 80%;
             height: 75%;
             position: relative;
             left: 10%;
             top: 0%;}

		#container_1 {
             width: 72%;
             height: 70%;
             position: relative;
             left: 14%;
             top: 0%;
    }
        </style>
    </head>
    <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Information Visualization</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="az_sales.php">Sales</a></li>
            <li><a href="az_products.php">Products</a></li>
<!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <!-- <li class="active"><a href="#"><span class="sr-only"></span></a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
  <br>
  <br>
  <br>
  <div style="text-align:center">
  <h3><b>Amazon Sales Dashboard</b></h3></div>
        <div align="right">
        <button onclick="myFunction('default')" type="button" class="btn btn-warning"> Default </button>
        <button onclick="myFunction('1998-2007')" type="button" class="btn btn-default">1998 - 2007</button>
        <button onclick="myFunction('2008-2014')" type="button" class="btn btn-default">2008 - 2014</button>
        </div>
</div>


        <div id="container"></div>
        <div id="container_1"></div>


  <script type="text/javascript">


/*anychart.onDocumentReady(*/

	function see_charts(year_val) {	

		var sales_pie_data = sub_sales_data(year_val);
		var previous_years_data = sub_sales_data_1(year_val);

		document.getElementById("container_1").innerHTML = "";

    // variable to help us define screen proportions
    var flag;
     
    // helper function to setup same settings for all Axis Titles
    var setupChartAxisTitles = function (chart, titleX, titleY) {
        chart.xAxis().labels().fontSize(11).padding([0, 0, 0, 0]);
        chart.yAxis().labels().fontSize(11).padding([0, 0, 0, 0]);
        if (titleX) chart.xAxis().title().enabled(true).text(titleX).fontSize(12).margin(0).padding([3, 0, 0, 0]);
        if (titleY) chart.yAxis().title().enabled(true).text(titleY).fontSize(12).margin(0).padding([0, 0, 3, 0]);
    };

    // helper function to setup same settings for all Charts
    var setupChartSettings = function (chart) {
        chart.container(stage);
        chart.margin(0);
        chart.padding([15, 30, 15, 15]);
        chart.title().fontColor('#212121').fontSize(13).padding([0, 0, 10, 0]);
        chart.draw();
    };

    // create stage for all charts
    stage = acgraph.create('container_1');

    var title = anychart.standalones.title();
    title.text('');
    title.background('#ffffff');
    title.padding(10);
    title.container(stage);
    title.draw();



    var areaChart = anychart.area();
    areaChart.title('Monthly New User Count');
    areaChart.area(previous_years_data.mapAs({value: [2], x: [0]})).tooltip().format(function () {
        return this.value + ' Thousand Users'
    });
    setupChartAxisTitles(areaChart, 'Month Name', 'New Users (1K)');
    setupChartSettings(areaChart);



    var barChart = anychart.bar();
    barChart.title('Average User Age by Category');
    barChart.bar(sales_pie_data.mapAs({value: [3], x: [0]})).name('Male');
    barChart.bar(sales_pie_data.mapAs({value: [2], x: [0]})).name('Female');
    setupChartAxisTitles(barChart, 'Category Name', 'Average Age in Years');
    setupChartSettings(barChart);



    var scatterChart = anychart.bubble();
    scatterChart.title('Customer Rating(1-5) Vs Sales');
    var bubble_series = scatterChart.bubble(sales_pie_data.mapAs({value: [4], x: [5], size: [1], name: [0]}));
    bubble_series.tooltip().useHtml(true).titleFormat(function () {
        return this.getData('name')
    }).format(function () {
        return '<span style="font-size: 11px;">Rating: ' + this.value + '<br/>Sales (M-$) : ' + this.x + '<br/>Orders (Million): ' + this.size + '</span>';
    });
    bubble_series.yScale()
            .minimum(0)
            .maximum(6);
    setupChartAxisTitles(scatterChart, 'Sales (M-$)', 'User Rating(0-5)');
    setupChartSettings(scatterChart);


    // Creates general layout table with two inside layout tables
    function configureChartsSize() {
        if (window.innerWidth > 768) {
            flag = 'wide';
			areaChart.bounds(0, 30, '33.3%', '47%');
            barChart.bounds('33.3%', 30, '33.3%', '47%');
            scatterChart.bounds('66.6%', 30, '33.3%', '47%');
        } else {
            flag = 'slim';
            areaChart.bounds(0, 30, '50%', '33.3%');
            barChart.bounds('50%', 30, '50%', '33.3%');
            scatterChart.bounds(0, '33.3%', '50%', '33.3%');
        }
    }

    configureChartsSize();


    // On resize change layout to mobile version or otherwise
    window.onresize = function () {
        if (flag == 'slim' && window.innerWidth > 767) {
            configureChartsSize('wide');
        } else if (flag == 'wide' && window.innerWidth <= 767) {
            configureChartsSize('slim');
        }
        title.parentBounds(0, 0, stage.width(), 130).draw();
    }
}


see_charts();

















var dataset = null;
var year_val = 2014

function myFunction(yearRange){ 
    var dataset = yearRange;
    mainChartLayout(dataset);
}


mainChartLayout(dataset);

    function mainChartLayout(dataset) {

    var productsData = getProductsData();
    var data = null;
    
    if (dataset=='1998-2007'){

        document.getElementById('container').innerHTML = "";
        data = getData_2();
        var totalDataMap = getTotalDataMap_2();
    }

    else if (dataset=='2008-2014'){

        document.getElementById('container').innerHTML = "";
        data = getData_3();
        var totalDataMap = getTotalDataMap_3();
    } 

    else if (dataset=='default'){
        document.getElementById('container').innerHTML = "";
        data = getData_1();
        var totalDataMap = getTotalDataMap();
    }  
    else {
        data = getData_1();
        var totalDataMap = getTotalDataMap();
    };

    // Variables for this dashboard
    var totalDataArray, detailCellName;
    var detailChart, detailPie;
    var selectedX = null;
    var totalSeries = null;
    var detailSeries_1 = null;
    var detailSeries_2 = null;

    layoutTable = anychart.standalones.table(5, 4);
    layoutTable.cellBorder(null);
    layoutTable.getCol(0).width('2.5%');
    layoutTable.getCol(1).width('55%');
    layoutTable.getCol(3).width('2.5%');
    layoutTable.getRow(0).height(20);
    layoutTable.getRow(2).height(50);
    layoutTable.getRow(4).height(20);
    detailCellName = layoutTable.getCell(2, 1);
    detailCellName.colSpan(2);
    detailCellName.hAlign('center').vAlign('bottom').padding(0, 0, 5, 0).fontSize(16);

    detailCellName.border().bottom('3 #EAEAEA');
    layoutTable.getCell(1, 1).colSpan(2).content(mainChart());
    layoutTable.getCell(3, 1).content(drawDetailChart());
    layoutTable.getCell(3, 2).content(drawDetailPie());
    layoutTable.container('container');
    layoutTable.draw();
    drillDown('2014');

    /**
     * Setting up main column chart
     * @return {chart} column chart
     */
    function mainChart() {
        var totalChart = anychart.column();
        totalChart.title('');
        totalDataArray = getValues(totalDataMap);
        totalSeries = totalChart.column(totalDataArray);
        totalChart.xAxis().title().enabled(true).text('Years').fontSize(12).margin(0).padding([3, 0, 0, 0])
        totalChart.yAxis().title().enabled(true).text('Sales $').fontSize(12).margin(0).padding([3, 0, 0, 0])

        // single select only
        var interactivity = totalChart.interactivity();
        interactivity.selectionMode("singleSelect");


        selectedMarkers = totalSeries.selectMarkers();
        selectedMarkers.enabled(true);
        selectedMarkers.fill("Gold");
        selectedMarkers.size(10);
        selectedMarkers.type("star5");

        totalSeries.listen('pointClick', function (e) {
            drillDown(e.iterator.get('x'));
            see_charts(e.iterator.get('x'));
        });
        totalChart.yAxis().labels().textFormatter(function () {
            return '$' + formatMoney(parseInt(this.value), 0, '.', ',');
        });
        totalSeries.tooltip(null);
        return totalChart
    }

    /**
     * Setting up detail stacked column chart
     * @return {chart} stacked column chart
     */
    function drawDetailChart() {
        detailChart = anychart.column();
        detailChart.title().fontSize(14);
        detailChart.yScale().stackMode('value');
        detailChart.xAxis().title().enabled(true).text('Month Name').fontSize(12).margin(0).padding([3, 0, 0, 0])
        detailChart.yAxis().title().enabled(true).text('Revenue-Profit').fontSize(12).margin(0).padding([3, 0, 0, 0])
        detailChart.yAxis().labels().textFormatter(function () {
            return '$' + formatMoney(parseInt(this.value), 0, '.', ',');
        });
        return detailChart
    }

    /**
     * Setting up detail pie chart
     * @return {chart} pie chart
     */
    function drawDetailPie() {
        detailPie = anychart.pie();
        detailPie.innerRadius(20);
        detailPie.stroke(null);
        detailPie.labels().fontSize(11);
        detailPie.title().fontSize(14);
        detailPie.tooltip().textFormatter(function () {
            return '$' + formatMoney(parseInt(this.value), 0, '.', ',');
        });
        detailPie.legend().paginator(false);
        return detailPie
    }

    /**
     * Drill down to year. Change detail stacked column chart data and pie chart data by year
     * @param {string} year Drill down year value.
     */
    function drillDown(year) {



    	year_val = year;

/*    	alert(year_val);*/

        var selectedData;
        if (selectedX) {
            selectedData = totalDataMap[selectedX];
            selectedData['hatchFill'] = null;
        }
        selectedX = year;
        selectedData = totalDataMap[selectedX];

        var detailData = data[selectedX];
        var dataSet = anychart.data.set(detailData);
        var data_1 = dataSet.mapAs({x: [0], value: [1]});
        var data_2 = dataSet.mapAs({x: [0], value: [2]});
        if (!detailSeries_1) detailSeries_1 = detailChart.column(data_1);
        else detailSeries_1.data(data_1);
        if (!detailSeries_2) detailSeries_2 = detailChart.column(data_2);
        else detailSeries_2.data(data_2);

        var opacity = 0.85;
        var hoverOpacity = 0.6;
        var stroke_thickness = 1.4;
        detailSeries_1.fill(detailSeries_1.color() + ' ' + opacity);
        detailSeries_1.hoverFill(detailSeries_1.color() + ' ' + hoverOpacity);
        detailSeries_1.stroke(stroke_thickness + ' ' + detailSeries_1.color() + ' ' + opacity);
        detailSeries_1.hoverStroke(stroke_thickness + ' ' + detailSeries_1.color() + ' 1');
        detailSeries_1.name('Revenue');
        detailSeries_1.tooltip().titleFormatter(function () {
            return this.x
        });
        detailSeries_1.tooltip().textFormatter(function () {
            return this.seriesName + ': $' + formatMoney(parseInt(this.value), 0, '.', ',');
        });

        detailSeries_2.fill(detailSeries_2.color() + ' ' + opacity);
        detailSeries_2.hoverFill(detailSeries_2.color() + ' ' + hoverOpacity);
        detailSeries_2.stroke(stroke_thickness + ' ' + detailSeries_2.color() + ' ' + opacity);
        detailSeries_2.hoverStroke(stroke_thickness + ' ' + detailSeries_2.color() + ' 1');
        detailSeries_2.name('Profit');
        detailSeries_2.tooltip().titleFormatter(function () {
            return this.x
        });
        detailSeries_2.tooltip().textFormatter(function () {
            return this.seriesName + ': $' + formatMoney(parseInt(this.value), 0, '.', ',');
        });

        detailPie.data(productsData[selectedX]);

        detailChart.title('Annual Profit/Revenue by Month');
        detailPie.title('Top Revenue Categories');

        detailCellName.content(selectedX + ' year sales details');
        totalSeries.data(totalDataArray);
    }

    /**
     * Sum of array
     * @param array - array to sum
     * @param {float} result
     */
    function sum(array) {
        var result = 0;
        for (var i = 0, count = array.length; i < count; i++) {
            var item = array[i];
            result += item[1] + item[2];
        }
        return result;
    }

    function getValues(obj) {
        var res = [];
        var i = 0;
        for (var key in obj) {
            res[i++] = obj[key];
        }
        return res;
    }

    function formatMoney(value, c, d, t) {
        var n = value,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }

    function getTotalDataMap() {
        return {
/*            '1998': {x: '1998', value: sum(data['1998'])},
            '1999': {x: '1999', value: sum(data['1999'])},
            '2000': {x: '2000', value: sum(data['2000'])},
            '2001': {x: '2001', value: sum(data['2001'])},
            '2002': {x: '2002', value: sum(data['2002'])},
            '2003': {x: '2003', value: sum(data['2003'])},
            '2004': {x: '2004', value: sum(data['2004'])},
            '2005': {x: '2005', value: sum(data['2005'])},
            '2006': {x: '2006', value: sum(data['2006'])},*/
            '2007': {x: '2007', value: sum(data['2007'])},
            '2008': {x: '2008', value: sum(data['2008'])},
            '2009': {x: '2009', value: sum(data['2009'])},
            '2010': {x: '2010', value: sum(data['2010'])},
            '2011': {x: '2011', value: sum(data['2011'])},
            '2012': {x: '2012', value: sum(data['2012'])},
            '2013': {x: '2013', value: sum(data['2013'])},
            '2014': {x: '2014', value: sum(data['2014'])}
        }
    }
    function getTotalDataMap_2() {
        return {
            '1998': {x: '1998', value: sum(data['1998'])},
            '1999': {x: '1999', value: sum(data['1999'])},
            '2000': {x: '2000', value: sum(data['2000'])},
            '2001': {x: '2001', value: sum(data['2001'])},
            '2002': {x: '2002', value: sum(data['2002'])},
            '2003': {x: '2003', value: sum(data['2003'])},
            '2004': {x: '2004', value: sum(data['2004'])},
            '2005': {x: '2005', value: sum(data['2005'])},
            '2006': {x: '2006', value: sum(data['2006'])},
            '2007': {x: '2007', value: sum(data['2007'])}
        }
    }
    function getTotalDataMap_3() {
        return {
            '2008': {x: '2008', value: sum(data['2008'])},
            '2009': {x: '2009', value: sum(data['2009'])},
            '2010': {x: '2010', value: sum(data['2010'])},
            '2011': {x: '2011', value: sum(data['2011'])},
            '2012': {x: '2012', value: sum(data['2012'])},
            '2013': {x: '2013', value: sum(data['2013'])},
            '2014': {x: '2014', value: sum(data['2014'])}
        }
    }

};
    
</script>

    </body>
</html>

