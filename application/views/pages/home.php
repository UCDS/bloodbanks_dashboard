
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/fastclick/fastclick.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.min.js "></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/demo.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>	
	<style>
		.main{
			cursor:pointer;
		}
		.sub{
			background-color:#ffcc99;
		}
		.thead1{
			background-color:#F5EC6C;
			color:black;
		}
		.thead2{
			background-color:#7DF5A7;
			color:black;
		}
	</style>
    <script>
        <?php /*
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         /////////////////

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: [<?php echo $labels;?>],
          datasets: [<?php echo $data_op;?>]
        };
        var areaChartData2 = {
          labels: [<?php echo $labels;?>],
          datasets: [<?php echo $data_ip;?>]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

     
     
     ;

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[0].fillColor = "#00a65a";
        barChartData.datasets[0].strokeColor = "#000";
        barChartData.datasets[0].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 1,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
		//-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas2 = $("#barChart2").get(0).getContext("2d");
        var barChart2 = new Chart(barChartCanvas2);
        var barChartData2 = areaChartData2;
        barChartData2.datasets[0].fillColor = "#0050ff";
        barChartData2.datasets[0].strokeColor = "#000";
        barChartData2.datasets[0].pointColor = "#00a65a";
        var barChartOptions2 = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 1,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions2.datasetFill = false;
        barChart2.Bar(barChartData2, barChartOptions2);
        
        
        //Diagnostic Charts
        
        <?php foreach($test_areas as $test_area){ ?>
            var <?php echo strtolower($test_area->test_area); ?>Data = {
                labels: <?php echo $hospital_labels; ?>,
                datasets: [{data: <?php echo $department_value["$test_area->test_area"] ?>}]
            };            
            var <?php echo strtolower($test_area->test_area); ?>Canvas = $("#<?php echo strtolower($test_area->test_area); ?>").get(0).getContext("2d");
            var <?php echo strtolower($test_area->test_area); ?> = new Chart(<?php echo strtolower($test_area->test_area); ?>Canvas);
            var <?php echo strtolower($test_area->test_area); ?>Data = <?php echo strtolower($test_area->test_area); ?>Data;
            
            <?php echo strtolower($test_area->test_area); ?>Data.datasets[0].fillColor = "#00a65a";
            <?php echo strtolower($test_area->test_area); ?>Data.datasets[0].strokeColor = "#000";
            <?php echo strtolower($test_area->test_area); ?>Data.datasets[0].pointColor = "#00a65a";
            
            var <?php echo strtolower($test_area->test_area); ?>Options = {
              //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
              scaleBeginAtZero: true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines: true,
              //String - Colour of the grid lines
              scaleGridLineColor: "rgba(0,0,0,.05)",
              //Number - Width of the grid lines
              scaleGridLineWidth: 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines: true,
              //Boolean - If there is a stroke on each bar
              barShowStroke: true,
              //Number - Pixel width of the bar stroke
              barStrokeWidth: 1,
              //Number - Spacing between each of the X value sets
              barValueSpacing: 5,
              //Number - Spacing between data sets within X values
              barDatasetSpacing: 1,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
              //Boolean - whether to make the chart responsive
              responsive: true,
              maintainAspectRatio: false
            };

            <?php echo strtolower($test_area->test_area); ?>Options.datasetFill = false;
            <?php echo strtolower($test_area->test_area); ?>.Bar(<?php echo strtolower($test_area->test_area); ?>Data, <?php echo strtolower($test_area->test_area); ?>Options);
        
        <?php } ?> 
            //Diagnostics Chart.
            foreach($test_areas as $test_area){ ?>
                var ctx = document.getElementById("<?php echo strtolower($test_area->test_area); ?>");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $hospital_labels; ?>,
                        datasets: [{
                            label: '<?php echo $test_area->test_area; ?>',
                            data: <?php echo $department_value["$test_area->test_area"] ?>
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
                
         <?php   }  */ ?>
        
    $(function(){ 
	$(".date").Zebra_DatePicker();
      });
	  
    </script>
  <body class="skin-blue sidebar-mini">
  <?php $this->load->view('pages/inventory_summary'); ?>
  <?php $this->load->view('pages/blood_donations'); ?>
<script>
	$(function(){
		$('.sub').hide();
		$('.ircs').click(function(){
			$('.govt.sub').slideUp();
			$('.pvt.sub').slideUp();
			$('.ircs.sub').slideToggle();
		});
		$('.govt').click(function(){
			$('.ircs.sub').slideUp();
			$('.pvt.sub').slideUp();
			$('.govt.sub').slideToggle();
		});
		$('.pvt').click(function(){
			$('.govt.sub').slideUp();
			$('.ircs.sub').slideUp();
			$('.pvt.sub').slideToggle();
		});
	});
</script>
