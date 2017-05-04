<?php
  $uploaddir = './data/';
  $uploadfile = '';
  $uploadfile = $uploaddir . $_FILES['file']['name'];

  if(isset($_POST['submit'])) {
    foreach(glob($uploaddir.'*.*') as $v){
          unlink($v);
    }
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
   
    } 
  }
  $uploadfile = './data/'.scandir('./data')[2];
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">

    <!-- importing boostrap libraries -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- importing highcharts and jquery libraries -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://code.highcharts.com/stock/highstock.js"></script>
		<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>

    <!-- importing local libraries -->
    <script src="d3.layout.cloud.js"></script>
    <script type="text/javascript" src="dataFiles/brand_ratings_100_o.js"></script>

                      <!-- 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
                      		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

                      		<!-- http://jsfiddle.net/gh/get/library/pure/highcharts/highcharts/tree/master/samples/stock/demo/scrollbar-disabled/ 

                      SELECT 
                      UPPER(TRIM(meta_musical_instruments.brand)),
                      concat(reviews_musical_instruments.unixreviewtime, '000') as TIME,
                      reviews_musical_instruments.overall
                      FROM meta_musical_instruments JOIN reviews_musical_instruments
                      ON meta_musical_instruments.asin = reviews_musical_instruments.asin
                      WHERE meta_musical_instruments.brand NOT LIKE ''
                      ORDER BY TIME ;
                      	

                      		-->


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="dist/main.css">




<style>

    body {
        font-family:"Lucida Grande","Droid Sans",Arial,Helvetica,sans-serif;
    }
    .legend {
        border: 1px solid #555555;
        border-radius: 5px 5px 5px 5px;
        font-size: 0.8em;
        margin: 10px;
        padding: 8px;
    }
    .bld {
        font-weight: bold;
    }

</style>

	<!-- jquery autocomplete -->

  <script>

  var availableBrandTags = Object.keys(brand_ratings);

  $( function() {
    $( "#tags" ).autocomplete({
      source: availableBrandTags
    });
  });

  </script>
		
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
            <li><a href="az_sales.php">Sales</a></li>
            <li class="active"><a href="az_products.php">Products</a></li>
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
            <li><a href="../navbar/"></a></li>
            <li><a href="../navbar-static-top/"></a></li>
            <!-- <li class="active"><a href="#"><span class="sr-only"></span></a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br>
<div class="container">
  <br>
  <div style="text-align:center">
  <h3><b>Amazon Product Dashboard</b></h3></div>
  <br>
</div>



<div class="col-sm-4" style="text-align:center"></div>

	<div class="col-sm-4" style="text-align:center">
    <div class="input-group">
      <input id="tags" type="text" class="form-control" placeholder="Search a Product">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button" onclick="assignSearchItem()">Go!</button>
      </span>
    </div>
	</div>

<div class="col-sm-4" style="text-align:center"></div>  

	<br>
	<br>

<div class="container">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <div id="graph">    
      <div id="container" style="height: 400px; min-width: 310px"></div>  
      </div>
    </div>
    <div class="col-sm-1"></div>
  </div>
</div>



<script>
var plot_name = '';
var brand_name = '';

function assignSearchItem(){
	var SearchItem = document.getElementById("tags").value;
  if (SearchItem == '') {SearchItem = 'Yamaha';};
	plot_name = SearchItem + ' Average User Ratings';
	brand_name = eval('brand_ratings.'+SearchItem);
	plotratings();
};

assignSearchItem();
</script>
		
<script>
		//$.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
    

	function plotratings() {
	
	/*var plot_name = 'Product X Rating';*/
    Highcharts.stockChart('container', {


        rangeSelector: {
            selected: 1
        },

        title: {
            text: plot_name //'AAPL Stock Price'
        },

        scrollbar: {
            enabled: false
        },

        series: [{
            name: plot_name, //'Product X Rating',
            data: brand_name,
            tooltip: {
                valueDecimals: 2
            }
        }],
			
		
		
    })};
//});
plotratings();

</script>


<!-- WORD CLOUD -->

<!-- <script>

    var frequency_list = [{"text":"study","size":40},{"text":"motion","size":15},{"text":"forces","size":10},{"text":"electricity","size":15},{"text":"movement","size":10},{"text":"relation","size":5},{"text":"things","size":10},{"text":"force","size":5},{"text":"ad","size":5},{"text":"energy","size":85},{"text":"living","size":5},{"text":"nonliving","size":5},{"text":"laws","size":15},{"text":"speed","size":45},{"text":"velocity","size":30},{"text":"define","size":5},{"text":"constraints","size":5},{"text":"universe","size":10},{"text":"physics","size":120},{"text":"describing","size":5},{"text":"matter","size":90},{"text":"physics-the","size":5},{"text":"world","size":10},{"text":"works","size":10},{"text":"science","size":70},{"text":"interactions","size":30},{"text":"studies","size":5},{"text":"properties","size":45},{"text":"nature","size":40},{"text":"branch","size":30},{"text":"concerned","size":25},{"text":"source","size":40},{"text":"google","size":10},{"text":"defintions","size":5},{"text":"two","size":15},{"text":"grouped","size":15},{"text":"traditional","size":15},{"text":"fields","size":15},{"text":"acoustics","size":15},{"text":"optics","size":15},{"text":"mechanics","size":20},{"text":"thermodynamics","size":15},{"text":"electromagnetism","size":15},{"text":"modern","size":15},{"text":"extensions","size":15},{"text":"thefreedictionary","size":15},{"text":"interaction","size":15},{"text":"org","size":25},{"text":"answers","size":5},{"text":"natural","size":15},{"text":"objects","size":5},{"text":"treats","size":10},{"text":"acting","size":5},{"text":"department","size":5},{"text":"gravitation","size":5},{"text":"heat","size":10},{"text":"light","size":10},{"text":"magnetism","size":10},{"text":"modify","size":5},{"text":"general","size":10},{"text":"bodies","size":5},{"text":"philosophy","size":5},{"text":"brainyquote","size":5},{"text":"words","size":5},{"text":"ph","size":5},{"text":"html","size":5},{"text":"lrl","size":5},{"text":"zgzmeylfwuy","size":5},{"text":"subject","size":5},{"text":"distinguished","size":5},{"text":"chemistry","size":5},{"text":"biology","size":5},{"text":"includes","size":5},{"text":"radiation","size":5},{"text":"sound","size":5},{"text":"structure","size":5},{"text":"atoms","size":5},{"text":"including","size":10},{"text":"atomic","size":10},{"text":"nuclear","size":10},{"text":"cryogenics","size":10},{"text":"solid-state","size":10},{"text":"particle","size":10},{"text":"plasma","size":10},{"text":"deals","size":5},{"text":"merriam-webster","size":5},{"text":"dictionary","size":10},{"text":"analysis","size":5},{"text":"conducted","size":5},{"text":"order","size":5},{"text":"understand","size":5},{"text":"behaves","size":5},{"text":"en","size":5},{"text":"wikipedia","size":5},{"text":"wiki","size":5},{"text":"physics-","size":5},{"text":"physical","size":5},{"text":"behaviour","size":5},{"text":"collinsdictionary","size":5},{"text":"english","size":5},{"text":"time","size":35},{"text":"distance","size":35},{"text":"wheels","size":5},{"text":"revelations","size":5},{"text":"minute","size":5},{"text":"acceleration","size":20},{"text":"torque","size":5},{"text":"wheel","size":5},{"text":"rotations","size":5},{"text":"resistance","size":5},{"text":"momentum","size":5},{"text":"measure","size":10},{"text":"direction","size":10},{"text":"car","size":5},{"text":"add","size":5},{"text":"traveled","size":5},{"text":"weight","size":5},{"text":"electrical","size":5},{"text":"power","size":5}];


    var color = d3.scale.linear()
            .domain([0,1,2,3,4,5,6,10,15,20,100])
            .range(["#ddd", "#ccc", "#bbb", "#aaa", "#999", "#888", "#777", "#666", "#555", "#444", "#333", "#222"]);

    d3.layout.cloud().size([800, 300])
            .words(frequency_list)
            .rotate(0)
            .fontSize(function(d) { return d.size; })
            .on("end", draw)
            .start();

    function draw(words) {
        d3.select("body").append("svg")
                .attr("width", 850)
                .attr("height", 350)
                .attr("class", "wordcloud")
                .append("g")
                // without the transform, words words would get cutoff to the left and top, they would
                // appear outside of the SVG area
                .attr("transform", "translate(320,200)")
                .selectAll("text")
                .data(words)
                .enter().append("text")
                .style("font-size", function(d) { return d.size + "px"; })
                .style("fill", function(d, i) { return color(i); })
                .attr("transform", function(d) {
                    return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                })
                .text(function(d) { return d.text; });
    }
</script>


<div class="col-sm-2" style="text-align:center"></div>
<div class="col-sm-8" style="text-align:center">
  
        <div style="width: 100%;"></div>
        <div class="legend" style="text-align:left">
                 1) Commonly used words are larger and slightly faded in color. <br>  
                 2) Less common words are smaller and darker.
        </div>

</div>  
<div class="col-sm-2" style="text-align:center"></div>   -->



<h2  style="text-align:center">SentenTree</h2>
<br>
<div style="text-align:center">
        <p>Please upload ratings/reviews/tweets files in <b>"id"       "text"      "likes-count"</b> format.</p>
		<a href="dataFiles/review/input.tsv">Sample Review Data</a>
		<br>
		<a href="dataFiles/summary/input.tsv">Sample Summary Data</a>
        <br>
		<br>
        <form method="post" action="./az_products.php" class="form-inline" enctype="multipart/form-data">
          <label class="file">
            <input type="file" id="file" name="file" class="custom-file-input">
            <span class="custom-file-control"></span>
          </label>
          <button type="submit" name="submit" class="btn btn-warning">Upload</button>
        </form>
</div>


<!-- SentenTree implementation -->
 <div id="app"></div>
   <script src="dist/main.js"></script>




  <footer class="footer">
    <div class="container" style="text-align:center">
      <p class="text-muted">
        &copy; 2017. Raja Harsha Chinta, Inc. by
        <a href="#">@rchinta</a>
      </p>
    </div>
  </footer>

    </body>
</html>
