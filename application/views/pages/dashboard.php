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
        $todays_inventory_cumulative += $inventory->blood_bank_count;
    }
    
    foreach($months_inventory as $inventory){
        $months_inventory_cumulative += $inventory->blood_bank_count;
    }
    
    foreach($todays_discards as $discard){
        $todays_discard_cumulative += $discard->blood_bank_count;
    }
    
    foreach($months_discards as $discard){
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
    
    $label_dates_string = '';
    foreach($dates as $date){
        $label_dates_string .= "'".$date."'".', ';
    }
    $label_dates_string .= "'_'";
    
    $total_donations_string = "{data: [";
    foreach($dates as $date){
        $total_donations_string .="'".$date_wise_donations["$date"]."'".', ';
    }
    $total_donations_string .= "'0']}";
    
    $label_bloodbank_string = '';
    $i =0;
    foreach($months_donations as $donation){
        $label_bloodbank_string .= "'".$donation->bloodbank_name."'".', ';
        if($i < 10){
            $i++;
        }else{
            break;
        }
    }
    $label_bloodbank_string .= "'_'";
    
    $total_donations_string_bb = "{data: [";
    $i =0;
    foreach($months_donations as $donation){
        $total_donations_string_bb .="'".$donation->blood_bank_count."'".', ';
        if($i < 10){
            $i++;
        }else{
            break;
        }
    }
    $total_donations_string_bb .= "'0']}";
    
    
    $pins = array();
    foreach($map_pins as $pin){
        foreach($current_inventory as $inventory){
            if($pin->bloodbank_id == $inventory->bloodbank_id){
                $pins[] = (object) array(
                    'bloodbank_id' => $pin->bloodbank_id,
                    'bloodbank_name' => $pin->bloodbank_name,
                    'lattitude' => $pin->lattitude,
                    'longitude' => $pin->longitude,
                    'inventory' => $inventory->blood_bank_count
                );
            }
        }
    }
    
    $govt_months_cumulative_donations = 0;
    $npo_months_cumulative_donations = 0;
    $pvt_months_cumulative_donations = 0;
    foreach($months_donations as $donation){
        if($donation->bloodbank_type == 0){
            $govt_months_cumulative_donations += $donation->blood_bank_count;        
        }
        if($donation->bloodbank_type == 1){
            $npo_months_cumulative_donations += $donation->blood_bank_count;        
        }
        if($donation->bloodbank_type == 2){
            $pvt_months_cumulative_donations += $donation->blood_bank_count;        
        }
    }
    
    $govt_months_cumulative_issues = 0;
    $npo_months_cumulative_issues = 0;
    $pvt_months_cumulative_issues = 0;
    foreach($months_issues as $issue){
        if($issue->bloodbank_type == 0){
            $govt_months_cumulative_issues += $issue->blood_bank_count;        
        }
        if($issue->bloodbank_type == 1){
            $npo_months_cumulative_issues += $issue->blood_bank_count;        
        }
        if($issue->bloodbank_type == 2){
            $pvt_months_cumulative_issues += $issue->blood_bank_count;        
        }
    }
    
    $govt_months_cumulative_discards = 0;
    $npo_months_cumulative_discards = 0;
    $pvt_months_cumulative_discards = 0;
    foreach($months_discards as $discard){
        if($discard->bloodbank_type == 0){
            $govt_months_cumulative_discards += $discard->blood_bank_count;        
        }
        if($discard->bloodbank_type == 1){
            $npo_months_cumulative_discards += $discard->blood_bank_count;        
        }
        if($discard->bloodbank_type == 2){
            $pvt_months_cumulative_discards += $discard->blood_bank_count;        
        }
    }
    
?>

<html>
	<head>
            <script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
    	<style>
			.journal-font{
				color: #F73F69;
				font-size:22px;
				font-family:'journalregular', Fallback, sans-serif;
			}
			.journal-font-header{
				color: #F73F69;
				font-size:30px !important;
				font-family:'journalregular', Fallback, sans-serif;
				letter-spacing: 2px;
			}
			#blood_details, #blood_details th, #blood_details td{
				text-align:center;
			}
			#blood_details tr{
				height:40px;
			}
			.blood_inventory{
				text-align:left !important;
				font-weight:bold;
				color:#F73F69;
			}
			/*.panel-heading{
				border:4px solid #fff !important;
			}*/
			.panel-primary-inner-body{
				border:2px solid #F73F69 !important;
			}
			.panel-primary>.panel-primary-inner-body>.panel-heading{
				color:#fff;
			}
		</style>
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
        <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 300px;
       
      }
    </style>
    	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet"
              type="text/css"/>
        <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet"
              type="text/css"/>
        <link href="assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/superslides.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/js/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/js/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    
        <!-- REVOLUTION SLIDER -->
        <link href="assets/plugins/revolution-slider/css/settings.css" rel="stylesheet"
              type="text/css"/>
    
        <!-- THEME CSS -->
        <link href="assets/css/essentials.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/layout-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/color_scheme/pink.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/journal/stylesheet.css" rel="stylesheet" type="text/css"/>
         
    </head>
    <body style="background-color: #fff;">
    <div>
    	<div class="fullwidthbanner-container roundedcorners" style="max-height: 200px; background-color: #F73F69;">
            <div class="fullwidthbanner">
                <h1 style="text-align: center; vertical-align: middle; margin: auto;">Donate Blood when needed.</h1>
                <!--
                        <img src="assets/images/banners/banner_01.png" width="100%" alt="" data-bgfit="cover" data-bgposition="left top"
                             data-bgrepeat="no-repeat">
        --!>
                <!--        <div class="tp-bannertimer"></div>-->
            </div>
        </div>
        
        <div class="col-md-12">
        	 <div class="panel-primary col-md-4">
                     <div class="panel-primary-inner-body" style="background-color:#F9F9F9;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Blood Banking in Andhra Pradesh</strong></h3>
                    </div>
                    <div>
                        <table width="100%" style="margin-bottom: 17px;">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th class="journal-font" style="text-align: right;">Today</th>
                                    <th class="journal-font" style="text-align: right;">Last 30 days &nbsp;&nbsp;</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img width="60px" height="60px" src="<?php echo base_url() ?>assets/images/icons/donors.png"/>Donors</td>
                                    <td style="text-align: right;"><?php echo number_format("$todays_donors_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="text-align: right;"><?php echo number_format("$months_donors_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><img width="60px" height="60px" src="<?php echo base_url() ?>assets/images/icons/blood_bag.png"/>Issues</td>
                                    <td style="text-align: right;"><?php echo number_format("$todays_issues_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="text-align: right;"><?php echo number_format("$months_issues_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><img width="60px" height="60px" src="<?php echo base_url() ?>assets/images/icons/blood_storage.png"/>Inventory</td>
                                    <td style="text-align: right;"><?php echo number_format("$todays_inventory_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="text-align: right;"><?php echo number_format("$months_inventory_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><img width="60px" height="60px" src="<?php echo base_url() ?>assets/images/icons/discard.png"/>Discarded</td>
                                    <td style="text-align: right;"><?php echo number_format("$todays_discard_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="text-align: right;"><?php echo number_format("$months_discard_cumulative"); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr><td colspan="3"><span style="color:red">*</span>Inventory includes all components.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-primary col-md-8" >
            	<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Current Inventory of Blood by District</strong></h3>
                    </div>
                    <div id="map">  </div>
            	</div>
            </div>
        </div>
        <div class="col-md-12" style="padding-top:15px;">
        	<div class="row">
            	<div class="col-md-10 col-md-offset-1">
                   <table class="table table-bordered" width="100%" border="1px" bordercolor="#F73F69" id="blood_details">
                    	<thead class="thead1">
                        	<tr style="height:60px; text-align:center;">
                                    <th style="background-color:#F73F69; color:#fff; width:20%;">Current Inventory.<small>(Includes all components)</small></th>
                                <th class="journal-font">A+</th>
                                <th class="journal-font">A-</th>
                                <th class="journal-font">AB+</th>
                                <th class="journal-font">AB-</th>
                                <th class="journal-font">B+</th>
                                <th class="journal-font">B-</th>
                                <th class="journal-font">O+</th>
                                <th class="journal-font">O-</th>
                                <th class="journal-font">Total</th>
                                </tr>
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
        
         <div class="col-md-12" style="padding-top:10px;">
        	 <div class="panel-primary col-md-6">
             	<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>30 day trend of donations</strong></h3>
                    </div>
                    <div style="height: 300px;">
                       <canvas id="barChartdontaion_trend" ></canvas> 
                    </div>
            	</div>
            </div>
            <div class="panel-primary col-md-6" >
            	<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Top 10 collections from blood bank in the last 30 days</strong></h3>
                    </div>
                    <div id="mapCanvas" style="height: 300px;"><canvas id="barChartbloodbank_donations" ></canvas></div>
            	</div>
            </div>
        </div>
        <div class="col-md-12" style="padding:15px;">
        	<div>
        <label style="color:#6F6F6F;font-size:16px;">PREVIOUS 30 DAY SUMMARY OF:</label></div>
            <div class="panel-primary col-md-4">
          		<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title journal-font-header"><strong>DONATIONS</strong></h3>
                    </div>
                    <div class="donations" align="center">
                        <canvas id="donations_dognut_chart" ></canvas>
                    </div>
            	</div>
            </div>
            <div class="panel-primary col-md-4" >
            	<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title journal-font-header"><strong>ISSUES</strong></h3>
                    </div>
                    <div id="issues" align="center"><canvas id="issues_dognut_chart" ></canvas></div>
            	</div>
            </div>
            <div class="panel-primary col-md-4" >
            	<div class="panel-primary-inner-body">
                    <div class="panel-heading">
                        <h3 class="panel-title journal-font-header"><strong>DISCARDS</strong></h3>
                    </div>
                    <div id="discards" align="center"><canvas id="discards_dognut_chart" ></canvas></div>
            	</div>
            </div>
        </div>
        <div class="col-md-12" style="background-color: #F73F69;">
            <div class="row">
                <div class="copyright_text">
                    <p style="color: white;"> Website Designed &amp; Developed by Volunteers at <a href="http://www.yousee.in/c4c" style="color:#11053E;font-weight:bold;" target="_blank">YouSee</a></p>
                    <p style="color: white;"> R4R (Resources For Results).</p>
                </div>
            </div>
        </div>
       </div> 
            
            <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 16.3067, lng: 80.4365 },
          zoom: 6
        });
        // 15.9129, 79.7400
        
        <?php foreach($pins as $pin){  ?>
            
        contentString_<?php echo $pin->bloodbank_id; ?> = "Inventory: <?php echo $pin->inventory;?>";
        
        var infowindow_<?php echo $pin->bloodbank_id; ?> = new google.maps.InfoWindow({
            content: contentString_<?php echo $pin->bloodbank_id; ?>
        });
        
        var location_<?php echo $pin->bloodbank_id; ?> = {lat: <?php echo $pin->lattitude ?>, lng: <?php echo $pin->longitude ?>};
        var marker_<?php echo $pin->bloodbank_id; ?> = new google.maps.Marker({
            position: location_<?php echo $pin->bloodbank_id; ?>,
            map: map,
            title: "<?php echo $pin->bloodbank_name; ?>",
            
        });
        
        marker_<?php echo $pin->bloodbank_id; ?>.addListener('mouseover', function() {
            infowindow_<?php echo $pin->bloodbank_id; ?>.open(map, marker_<?php echo $pin->bloodbank_id; ?>);
        });
        
        <?php } ?>
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgts0v9kmBp-Ewq6Ch3bhZQMlI2lZxM6g&callback=initMap"
    async defer></script>
  </body>

<script>
    $(function(){
var dognut_chart_donations = $("#donations_dognut_chart").get(0).getContext("2d");
var data = [
    {
        value: <?php echo $govt_months_cumulative_donations; ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Government"
    },
    {
        value: <?php echo $npo_months_cumulative_donations; ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "NPOs"
    },
    {
        value: <?php echo $pvt_months_cumulative_donations; ?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Private"
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

var myDoughnutChart_donations = new Chart(dognut_chart_donations).Doughnut(data,options);
// And for a doughnut chart
var dognut_chart_issues = $("#issues_dognut_chart").get(0).getContext("2d");
var data = [
    {
        value: <?php echo $govt_months_cumulative_issues; ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Government"
    },
    {
        value: <?php echo $npo_months_cumulative_issues; ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "NPOs"
    },
    {
        value: <?php echo $pvt_months_cumulative_issues; ?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Private"
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

var myDoughnutChart_issues = new Chart(dognut_chart_issues).Doughnut(data,options);

var dognut_chart_discards = $("#discards_dognut_chart").get(0).getContext("2d");
var data = [
    {
        value: <?php echo $govt_months_cumulative_discards; ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Government"
    },
    {
        value: <?php echo $npo_months_cumulative_discards; ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "NPOs"
    },
    {
        value: <?php echo $pvt_months_cumulative_discards; ?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Private"
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

var myDoughnutChart_discards = new Chart(dognut_chart_discards).Doughnut(data,options);

var areaChartData_dontaion_trend = {
          labels: [<?php echo $label_dates_string;?>],
          datasets: [<?php echo $total_donations_string;?>]
        };
        
        var barChartCanvas_dontaion_trend = $("#barChartdontaion_trend").get(0).getContext("2d");
        var barChart_dontaion_trend = new Chart(barChartCanvas_dontaion_trend);
        var barChartData_dontaion_trend = areaChartData_dontaion_trend;
        barChartData_dontaion_trend.datasets[0].fillColor = "#0050ff";
        barChartData_dontaion_trend.datasets[0].strokeColor = "#000";
        barChartData_dontaion_trend.datasets[0].pointColor = "#00a65a";
        var barChartOptions_dontaion_trend = {
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

        barChartOptions_dontaion_trend.datasetFill = false;
        barChart_dontaion_trend.Bar(barChartData_dontaion_trend, barChartOptions_dontaion_trend);
        
        var areaChartData_bloodbank_donations = {
          labels: [<?php echo $label_bloodbank_string;?>],
          datasets: [<?php echo $total_donations_string_bb;?>]
        };
        
        var barChartCanvas_bloodbank_donations = $("#barChartbloodbank_donations").get(0).getContext("2d");
        var barChart_bloodbank_donations = new Chart(barChartCanvas_bloodbank_donations);
        var barChartData_bloodbank_donations = areaChartData_bloodbank_donations;
        barChartData_bloodbank_donations.datasets[0].fillColor = "#0050ff";
        barChartData_bloodbank_donations.datasets[0].strokeColor = "#000";
        barChartData_bloodbank_donations.datasets[0].pointColor = "#00a65a";
        var barChartOptions_bloodbank_donations = {
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

        barChartOptions_bloodbank_donations.datasetFill = false;
        barChart_bloodbank_donations.Bar(barChartData_bloodbank_donations, barChartOptions_bloodbank_donations);
        
        
});
</script>
            
        </body>
</html>