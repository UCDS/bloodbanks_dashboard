<?php 
 $labels_gov = array();
 $totals_gov = array();
 $labels_ircs = array();
 $totals_ircs = array();
 $labels_other = array();
 $totals_other = array();
?>
    <div  class="col-md-6 col-xs-8 pull-left">
      <!-- Left side column. contains the logo and sidebar -->
          <div class="row">
		  <?php echo form_open('home',array('class'=>'form-custom','role'=>'form','class'=>'form-horizontal'));?>
		  <div class="form-group">
		  <?php
				if($this->input->post('from_date') && $this->input->post('to_date')){
                                    $from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
                                    $to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
                                }
                                else if($this->input->post('from_date') || $this->input->post('to_date')){
                                    if($this->input->post('from_date')){
                                        $from_date = $this->input->post('from_date');
                                        $to_date = date("Y-m-d");                    
                                    }else{
                                        $to_date = $this->input->post('to_date');
                                        $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
                                    }
                                }
                                else{
                                        $from_date=date("Y-m-d");
                                        $to_date=$from_date;
                                }
		  ?>
			<div class="col-md-12">
			<div class="col-md-3"> <b class="box-title">Blood Donations </b></div>
			<div class="col-md-3">from <input type="text" class="form-control date" name="from_date" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" /></div>
			<div class="col-md-3">to <input type="text" class="form-control date" name="to_date" value="<?php echo date("d-M-Y",strtotime($to_date));?>" /></div>
			<div class="col-md-3"> <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit" /></div>
			 </div>
		</form>
		</div>
		</div>
		
		<table class="table table-bordered">
		<thead class="thead1">
			<th>Bloodbank</th>
			<th>A+</th>
			<th>A-</th>
                        <th>AB+</th>
                        <th>AB-</th>
			<th>B+</th>
			<th>B-</th>
			<th>O+</th>
			<th>O-</th>
			<th>Total</th>
		</thead>
		<tbody>
		<?php 
			$govt_apos = 0;
                        $govt_abpos = 0;
                        $govt_abneg = 0;
			$govt_bpos = 0;
			$govt_opos = 0;
			$govt_aneg = 0;
			$govt_bneg = 0;
			$govt_oneg = 0;
			$govt_donations=0;
			$ircs_apos = 0;
                        $ircs_abpos = 0;
                        $ircs_abneg = 0;
			$ircs_bpos = 0;
			$ircs_opos = 0;
			$ircs_aneg = 0;
			$ircs_bneg = 0;
			$ircs_oneg = 0;
			$ircs_donations=0;
			$pvt_apos = 0;
                        $pvt_abpos = 0;
                        $pvt_abneg = 0;
			$pvt_bpos = 0;
			$pvt_opos = 0;
			$pvt_aneg = 0;
			$pvt_bneg = 0;
			$pvt_oneg = 0;
			$pvt_donations=0;
		// Type wise summary (Govt, IRCS or Private)
		foreach($dashboard_bloodbanks as $d){
			if($d->bloodbank_type == 0){
				$govt_apos += $d->Apos;
                                $govt_abpos += $d->ABpos;
                                $govt_abneg += $d->ABneg;
				$govt_bpos += $d->Bpos;
				$govt_opos += $d->Opos;
				$govt_aneg += $d->Aneg;
				$govt_bneg += $d->Bneg;
				$govt_oneg += $d->Oneg;
				$govt_donations += $d->total;
			}
			if($d->bloodbank_type == 2){
				$pvt_apos += $d->Apos;
                                $pvt_abpos += $d->ABpos;
                                $pvt_abneg += $d->ABneg;
				$pvt_bpos += $d->Bpos;
				$pvt_opos += $d->Opos;
				$pvt_aneg += $d->Aneg;
				$pvt_bneg += $d->Bneg;
				$pvt_oneg += $d->Oneg;
				$pvt_donations += $d->total;
			}
			if($d->bloodbank_type == 1){
				$ircs_apos += $d->Apos;
                                $ircs_abpos += $d->ABpos;
                                $ircs_abneg += $d->ABneg;
				$ircs_bpos += $d->Bpos;
				$ircs_opos += $d->Opos;
				$ircs_aneg += $d->Aneg;
				$ircs_bneg += $d->Bneg;
				$ircs_oneg += $d->Oneg;
				$ircs_donations += $d->total;
			}
		}
		?>
		<?php
                        $total_apos = 0;
                        $total_abpos = 0;
                        $total_abneg = 0;
                        $total_bpos = 0;
                        $total_opos = 0;
                        $total_aneg = 0;
                        $total_bneg = 0;
                        $total_oneg = 0;
                        $total_donations = 0;
			if($govt_donations>0){ 
			?>
			<tr class="govt main">
				<td>Government</td>
				<td style="text-align: right;"><?php echo number_format($govt_apos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_aneg) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($govt_abpos) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($govt_abneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_donations) ; ?></td>
			</tr>
			<tbody class="govt sub">
			<?php
                       
			foreach($dashboard_bloodbanks as $d){
			if($d->bloodbank_type==0){ 
			?>
			<tr class="govt sub">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abpos += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php 
                            $labels_gov[] = $d->bloodbank_name;
                            $totals_gov[] = $d->total;
                        }
				}
				}
			?>
			</tbody>
		<?php
                        $total_apos = 0;
                        $total_abpos = 0;
                        $total_bpos = 0;
                        $total_opos = 0;
                        $total_aneg = 0;
                        $total_bneg = 0;
                        $total_oneg = 0;
                        $total_donations = 0;
			if($ircs_donations>0){ 
			?>
			<tr class="ircs main">
				<td>IRCS</td>
				<td style="text-align: right;"><?php echo number_format($ircs_apos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_aneg) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($ircs_abpos) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($ircs_abneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_donations) ; ?></td>
			</tr>
			<tbody class="ircs sub">
			<?php
			foreach($dashboard_bloodbanks as $d){ 
			if($d->bloodbank_type==1){ 			
			?>
			<tr>
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abpos += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php 
                            $labels_ircs[] = $d->bloodbank_name;
                            $totals_ircs[] = $d->total;
                        }
				}
				}
			?>
			</tbody>
		<?php
                        $total_apos = 0;
                        $total_bpos = 0;
                        $total_abpos = 0;
                        $total_opos = 0;
                        $total_aneg = 0;
                        $total_bneg = 0;
                        $total_oneg = 0;
                        $total_donations = 0;
			if($pvt_donations>0){ 
			?>
			<tr class="pvt main">
				<td>Private</td>
				<td style="text-align: right;"><?php echo number_format($pvt_apos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_aneg) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($pvt_abpos) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($pvt_abneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_donations) ; ?></td>
			</tr>
			<tbody class="pvt sub">
			<?php
			foreach($dashboard_bloodbanks as $d){ 
			if($d->bloodbank_type==2){ 
			?>
			<tr class="pvt">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abneg += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php 
                            $labels_other[] = $d->bloodbank_name;
                            $totals_other[] = $d->total;                        
                        }
				}
				}
			?>
			</tbody>
                        <tr>
                            <th>Total</th>
                            <td style="text-align: right;"><b><?php echo number_format($govt_apos + $ircs_apos + $pvt_apos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_aneg + $ircs_aneg + $pvt_aneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_abpos + $ircs_abpos + $pvt_abpos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_abneg + $ircs_abneg + $pvt_abneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bpos + $ircs_bpos + $pvt_bpos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bneg + $ircs_bneg + $pvt_bneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_opos + $ircs_opos + $pvt_opos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_oneg + $ircs_oneg + $pvt_oneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_donations + $ircs_donations + $pvt_donations); ?></b></td>
                        </tr>
		</tbody>
		</table>
      <div style="height: 200px">
        <canvas id="barChartGov" ></canvas>
        <canvas id="barChartIRCS" ></canvas>
        <canvas id="barChartOther"></canvas>
      </div>
      
	</div>

<!-- Using Chart.js -->



<?php 
    $label_string_gov = "";
    foreach($labels_gov as $label){
        $label_string_gov .= "'$label'".', ';
    }
    $label_string_gov .= "'_'";
    $total_string_gov = "{data: [";
    foreach($totals_gov as $total){
        $total_string_gov .= "'$total'".', ';
    }
    $total_string_gov .= "0]}";
    
    $label_string_ircs = "";
    foreach($labels_ircs as $label){
        $label_string_ircs .= "'$label'".', ';
    }
    $label_string_ircs .= "'_'";
    $total_string_ircs = "{data: [";
    foreach($totals_ircs as $total){
        $total_string_ircs .= "'$total'".', ';
    }
    $total_string_ircs .= "0]}";
    
    $label_string_other = "";
    foreach($labels_other as $label){
        $label_string_other .= "'$label'".', ';
    }
    $label_string_other .= "'_'";
    $total_string_other = "{data: [";
    foreach($totals_other as $total){
        $total_string_other .= "'$total'".', ';
    }
    $total_string_other .= "0]}";
?>
<script>
    
    $(function(){
        
        var areaChartData_gov = {
          labels: [<?php echo $label_string_gov;?>],
          datasets: [<?php echo $total_string_gov;?>]
        };
        
        var barChartCanvas_gov = $("#barChartGov").get(0).getContext("2d");
        var barChart_gov = new Chart(barChartCanvas_gov);
        var barChartData_gov = areaChartData_gov;
        barChartData_gov.datasets[0].fillColor = "#0050ff";
        barChartData_gov.datasets[0].strokeColor = "#000";
        barChartData_gov.datasets[0].pointColor = "#00a65a";
        var barChartOptions_gov = {
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

        barChartOptions_gov.datasetFill = false;
        barChart_gov.Bar(barChartData_gov, barChartOptions_gov);
        
        var areaChartData_ircs = {
          labels: [<?php echo $label_string_ircs;?>],
          datasets: [<?php echo $total_string_ircs;?>]
        };
        
        var barChartCanvas_ircs = $("#barChartIRCS").get(0).getContext("2d");
        var barChart_ircs = new Chart(barChartCanvas_ircs);
        var barChartData_ircs = areaChartData_ircs;
        barChartData_ircs.datasets[0].fillColor = "#0050ff";
        barChartData_ircs.datasets[0].strokeColor = "#000";
        barChartData_ircs.datasets[0].pointColor = "#00a65a";
        var barChartOptions_ircs = {
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

        barChartOptions_ircs.datasetFill = false;
        barChart_ircs.Bar(barChartData_ircs, barChartOptions_ircs);
        
        var areaChartData_other = {
          labels: [<?php echo $label_string_other;?>],
          datasets: [<?php echo $total_string_other;?>]
        };
        
        var barChartCanvas_other = $("#barChartOther").get(0).getContext("2d");
        var barChart_other = new Chart(barChartCanvas_other);
        var barChartData_other = areaChartData_other;
        barChartData_other.datasets[0].fillColor = "#0050ff";
        barChartData_other.datasets[0].strokeColor = "#000";
        barChartData_other.datasets[0].pointColor = "#00a65a";
        var barChartOptions_other = {
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

        barChartOptions_other.datasetFill = false;
        barChart_other.Bar(barChartData_other, barChartOptions_other);

    });
</script>

