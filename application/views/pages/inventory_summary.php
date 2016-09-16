<script>
	$(function(){
		$('.sub_inv').hide();
		$('.ircs_pvt').click(function(){
			$('.govt_inv.sub_inv').slideUp();
			$('.pvt_inv.sub_inv').slideUp();
			$('.ircs_pvt.sub_inv').slideToggle();
		});
		$('.govt_inv').click(function(){
			$('.ircs_pvt.sub_inv').slideUp();
			$('.pvt_inv.sub_inv').slideUp();
			$('.govt_inv.sub_inv').slideToggle();
		});
		$('.pvt_inv').click(function(){
			$('.govt_inv.sub_inv').slideUp();
			$('.ircs_pvt.sub_inv').slideUp();
			$('.pvt_inv.sub_inv').slideToggle();
		});
	});
</script>



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
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Inventory Summary</h3>
                </div>
                <div class="panel-body">
                  
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
			$govt_apos_inv = 0;
                        $govt_abpos_inv = 0;
                        $govt_abneg_inv = 0;
			$govt_bpos_inv = 0;
			$govt_opos_inv = 0;
			$govt_aneg_inv = 0;
			$govt_bneg_inv = 0;
			$govt_oneg_inv = 0;
			$govt_donations_inv = 0;
			$ircs_apos_inv = 0;
                        $ircs_abpos_inv = 0;
                        $ircs_abneg_inv = 0;
			$ircs_bpos_inv = 0;
			$ircs_opos_inv = 0;
			$ircs_aneg_inv = 0;
			$ircs_bneg_inv = 0;
			$ircs_oneg_inv = 0;
			$ircs_donations_inv=0;
			$pvt_inv_apos_inv = 0;
                        $pvt_inv_abpos_inv = 0;
                        $pvt_inv_abneg_inv = 0;
			$pvt_inv_bpos_inv = 0;
			$pvt_inv_opos_inv = 0;
			$pvt_inv_aneg_inv = 0;
			$pvt_inv_bneg_inv = 0;
			$pvt_inv_oneg_inv = 0;
			$pvt_inv_donations_inv=0;
		// Type wise summary (Govt, IRCS or Private)
		foreach($dashboard_available_blood as $d){
			if($d->bloodbank_type == 0){
				$govt_apos_inv += $d->Apos;
                                $govt_abpos_inv += $d->ABpos;
                                $govt_abneg_inv += $d->ABneg;
				$govt_bpos_inv += $d->Bpos;
				$govt_opos_inv += $d->Opos;
				$govt_aneg_inv += $d->Aneg;
				$govt_bneg_inv += $d->Bneg;
				$govt_oneg_inv += $d->Oneg;
				$govt_donations_inv += $d->total;
			}
			if($d->bloodbank_type == 2){
				$pvt_inv_apos_inv += $d->Apos;
                                $pvt_inv_abpos_inv += $d->ABpos;
                                $pvt_inv_abneg_inv += $d->ABneg;
				$pvt_inv_bpos_inv += $d->Bpos;
				$pvt_inv_opos_inv += $d->Opos;
				$pvt_inv_aneg_inv += $d->Aneg;
				$pvt_inv_bneg_inv += $d->Bneg;
				$pvt_inv_oneg_inv += $d->Oneg;
				$pvt_inv_donations_inv += $d->total;
			}
			if($d->bloodbank_type == 1){
				$ircs_apos_inv += $d->Apos;
                                $ircs_abpos_inv += $d->ABpos;
                                $ircs_abneg_inv += $d->ABneg;
				$ircs_bpos_inv += $d->Bpos;
				$ircs_opos_inv += $d->Opos;
				$ircs_aneg_inv += $d->Aneg;
				$ircs_bneg_inv += $d->Bneg;
				$ircs_oneg_inv += $d->Oneg;
				$ircs_donations_inv += $d->total;
			}
		}
		?>
		<?php
                        $total_apos_inv = 0;
                        $total_abpos_inv = 0;
                        $total_abneg_inv = 0;
                        $total_bpos_inv = 0;
                        $total_opos_inv = 0;
                        $total_aneg_inv = 0;
                        $total_bneg_inv = 0;
                        $total_oneg_inv = 0;
                        $total_donations_inv = 0;
			if($govt_donations_inv>0){ 
			?>
			<tr class="govt_inv main">
				<td>Government</td>
				<td style="text-align: right;"><?php echo number_format($govt_apos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_aneg_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($govt_abpos_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($govt_abneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_bpos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_bneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_opos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_oneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_donations_inv) ; ?></td>
			</tr>
			<tbody class="govt_inv sub_inv">
			<?php
                       var_dump($dashboard_available_blood);
			foreach($dashboard_available_blood as $d){
			if($d->bloodbank_type==0){ 
			?>
			<tr class="govt_inv sub_inv">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos_inv += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg_inv += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos_inv += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abpos_inv += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos_inv += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg_inv += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos_inv += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg_inv += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations_inv += $d->total; ?></td>
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
                        $total_apos_inv = 0;
                        $total_abpos_inv = 0;
                        $total_bpos_inv = 0;
                        $total_opos_inv = 0;
                        $total_aneg_inv = 0;
                        $total_bneg_inv = 0;
                        $total_oneg_inv = 0;
                        $total_donations_inv = 0;
			if($ircs_donations_inv>0){ 
			?>
			<tr class="ircs_pvt main">
				<td>IRCS</td>
				<td style="text-align: right;"><?php echo number_format($ircs_apos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_aneg_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($ircs_abpos_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($ircs_abneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_bpos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_bneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_opos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_oneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_donations_inv) ; ?></td>
			</tr>
			<tbody class="ircs_pvt sub_inv">
			<?php
			foreach($dashboard_available_blood as $d){ 
			if($d->bloodbank_type==1){ 			
			?>
			<tr>
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos_inv += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg_inv += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos_inv += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abpos_inv += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos_inv += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg_inv += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos_inv += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg_inv += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations_inv += $d->total; ?></td>
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
                        $total_apos_inv = 0;
                        $total_bpos_inv = 0;
                        $total_abpos_inv = 0;
                        $total_opos_inv = 0;
                        $total_aneg_inv = 0;
                        $total_bneg_inv = 0;
                        $total_oneg_inv = 0;
                        $total_donations_inv = 0;
			if($pvt_inv_donations_inv>0){ 
			?>
			<tr class="pvt_inv main">
				<td>Private</td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_apos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_aneg_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($pvt_inv_abpos_inv) ; ?></td>
                                <td style="text-align: right;"><?php echo number_format($pvt_inv_abneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_bpos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_bneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_opos_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_oneg_inv) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_inv_donations_inv) ; ?></td>
			</tr>
			<tbody class="pvt_inv sub_inv">
			<?php
			foreach($dashboard_available_blood as $d){ 
			if($d->bloodbank_type==2){ 
			?>
			<tr class="pvt_inv">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos_inv += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg_inv += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABpos) ; $total_abpos_inv += $d->ABpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->ABneg) ; $total_abneg_inv += $d->ABneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos_inv += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg_inv += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos_inv += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg_inv += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations_inv += $d->total; ?></td>
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
                            <td style="text-align: right;"><b><?php echo number_format($govt_apos_inv + $ircs_apos_inv + $pvt_inv_apos_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_aneg_inv + $ircs_aneg_inv + $pvt_inv_aneg_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_abpos_inv + $ircs_abpos_inv + $pvt_inv_abpos_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_abneg_inv + $ircs_abneg_inv + $pvt_inv_abneg_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bpos_inv + $ircs_bpos_inv + $pvt_inv_bpos_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bneg_inv + $ircs_bneg_inv + $pvt_inv_bneg_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_opos_inv + $ircs_opos_inv + $pvt_inv_opos_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_oneg_inv + $ircs_oneg_inv + $pvt_inv_oneg_inv); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_donations_inv + $ircs_donations_inv + $pvt_inv_donations_inv); ?></b></td>
                        </tr>
		</tbody>
		</table>
      <div style="height: 200px">
        <canvas id="barChartGov" ></canvas>
        <canvas id="barChartIRCS" ></canvas>
        <canvas id="barChartOther"></canvas>
      </div>
                </div>
            </div>
	</div>