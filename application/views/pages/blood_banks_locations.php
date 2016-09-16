<!DOCTYPE html>
<?php 
    //Totals
    $todays_donors_cumulative =0;
    $months_donors_cumulative = 0;
    $todays_issues_cumulative = 0;
    $months_issues_cumulative = 0;
    $todays_inventory_cumulative = 0;
    $months_inventory_cumulative = 0;
    $todays_discard_cumulative = 0;
    $months_discard_cumulative = 0;
   
    foreach($todays_donations as $donation){
        $todays_donors_cumulative += $donation->blood_bank_count;
    }

    foreach($months_donations as $donation){
        $months_donors_cumulative += $donation->blood_bank_count;
    }
    
    foreach($todays_issues as $issues){
        $todays_issues_cumulative += $issues->blood_bank_count;
    }
    
    foreach($months_issues as $issues){
        $months_issues_cumulative += $issues->blood_bank_count;
    }
    
    foreach($current_inventory as $inventory){
        $todays_inventory_cumulative += $issues->blood_bank_count;
    }
    
    foreach($months_inventory as $inventory){
        $months_inventory_cumulative += $issues->blood_bank_count;
    }
    
    foreach($todays_discards as $discard){
        $todays_discard_cumulative += $discard->blood_bank_count;
    }
    
    foreach($get_months_discards as $discard){
        $months_discard_cumulative += $discard->blood_bank_count;
    }
    
    // 30 day trend of donations.
    $dates = array();
    foreach($months_donation_trends as $trends_bloodbank){
        foreach($trends_bloodbank as $trends){
            if (!in_array($trends->donation_date, $dates)){
                $dates[] = $trends->donation_date;
            }
        }
    }
    $date_wise_donations = array();
    foreach($dates as $date){
        $date_wise_donations["$date"] = 0;
    }
    foreach($months_donation_trends as $trends_bloodbank){
        foreach($trends_bloodbank as $trends){
            $date_wise_donations["$trends->donation_date"] += $trends->day_count;
        }
    }
    
?>



<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 525px;
        width: 850px;
      }
    </style>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
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

  </head>
  <body>
      
          <div class="col-md-12">
          <div class="row">
          <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="map">
                        
                    </div>
                </div>
                <div class="panel-footer"><?php echo $todays_donors_cumulative?></div>
            </div>
          </div>
          <div class="col-md-2">
              <div id="dognut_chart_div" style="height: 200px; width: 200px;">
                  <canvas id="dognut_chart" ></canvas>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">Panel heading without title</div>
                        <div class="panel-body">
                            <!-- Table -->
                            <table class="table">
                                <tr>
                                    <td><img src="<?php echo base_url() ?>assets/images/icons/donors.png" alt="Smiley face" height="42" width="42"></td>
                                    <td>Donors</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo base_url() ?>assets/images/icons/blood_bag.png" alt="Smiley face" height="42" width="42"></td>
                                    <td>Issues</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo base_url() ?>assets/images/icons/blood_storage.png" alt="Smiley face" height="42" width="42"></td>
                                    <td>Inventory</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><img src="<?php echo base_url() ?>assets/images/icons/discard.png" alt="Smiley face" height="42" width="42"></td>
                                    <td>Discard</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="col-md-8"> <!-- Current Inventory -->
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
                
		foreach($current_inventory_detailed as $d){
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
                       
			foreach($current_inventory_detailed as $d){
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
				<td>NPO</td>
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
			foreach($current_inventory_detailed as $d){ 
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
			foreach($current_inventory_detailed as $d){ 
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
                
            </div>
        </div>
      </div>
      
    <script>
      var map;
      function initMap() {
        var ongole = {lat: 15.5057, lng: 80.0499};
        var nellore = {lat: 14.4426, lng: 79.9865};
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 16.3067, lng: 80.4365 },
          zoom: 7
        });
        // 15.9129, 79.7400
        contentString = "<table>"+
                +"<tr><td>A+</td><td>10</td></tr>"
                +"<tr><td>A-</td><td>11</td></tr>"
                +"<tr><td>AB+</td><td>12</td></tr>"
                +"<tr><td>B+</td><td>13</td></tr>"
                +"<tr><td>O+</td><td>14</td></tr>"
                +"<tr><td>O-</td><td>15</td></tr>"
                +"<tr><td>AB-</td><td>16</td></tr>"                
                +"</table>";
        
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var image = "<?php echo base_url() ?>assets/images/icons/bloodbank_marker.png";
        var marker = new google.maps.Marker({
            position: ongole,
            map: map,
            title: 'Ongole Bloodbank',
            
        });
        var marker1 = new google.maps.Marker({
            position: nellore,
            map: map,
            title: 'Nellore Bloodbank',
            
        });
        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgts0v9kmBp-Ewq6Ch3bhZQMlI2lZxM6g&callback=initMap"
    async defer></script>
  </body>

<script>
    $(function(){
var dognut_chart = $("#dognut_chart").get(0).getContext("2d");
var data = [
    {
        value: 300,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    }
];
var options = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke : true,

    //String - The colour of each segment stroke
    segmentStrokeColor : "#fff",

    //Number - The width of each segment stroke
    segmentStrokeWidth : 2,

    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout : 50, // This is 0 for Pie charts

    //Number - Amount of animation steps
    animationSteps : 100,

    //String - Animation easing effect
    animationEasing : "easeOutBounce",

    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate : true,

    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale : false,
    
    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>"
    
}

var myDoughnutChart = new Chart(dognut_chart).Doughnut(data,options);
// And for a doughnut chart

});
</script>

</html>