
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
			<div class="col-md-3"> <span class="box-title">Blood Issues </span></div>
			<div class="col-md-3">from <input type="text" class="form-control date" name="from_date" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" /></div>
			<div class="col-md-3">to <input type="text" class="form-control date" name="to_date" value="<?php echo date("d-M-Y",strtotime($to_date));?>" /></div>
			<div class="col-md-3"> <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit" /></div>
			 </div>
		</form>
		</div>
		</div>
		
		<table class="table table-bordered">
		<thead>
			<th>Bloodbank</th>
			<th>A+</th>
			<th>A-</th>
			<th>B+</th>
			<th>B-</th>
			<th>O+</th>
			<th>O-</th>
			<th>Total</th>
		</thead>
		<tbody>
		<?php 
			$govt_apos = 0;
			$govt_bpos = 0;
			$govt_opos = 0;
			$govt_aneg = 0;
			$govt_bneg = 0;
			$govt_oneg = 0;
			$govt_donations=0;
			$ircs_apos = 0;
			$ircs_bpos = 0;
			$ircs_opos = 0;
			$ircs_aneg = 0;
			$ircs_bneg = 0;
			$ircs_oneg = 0;
			$ircs_donations=0;
			$pvt_apos = 0;
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
				$govt_bpos += $d->Bpos;
				$govt_opos += $d->Opos;
				$govt_aneg += $d->Aneg;
				$govt_bneg += $d->Bneg;
				$govt_oneg += $d->Oneg;
				$govt_donations += $d->total;
			}
			if($d->bloodbank_type == 2){
				$pvt_apos += $d->Apos;
				$pvt_bpos += $d->Bpos;
				$pvt_opos += $d->Opos;
				$pvt_aneg += $d->Aneg;
				$pvt_bneg += $d->Bneg;
				$pvt_oneg += $d->Oneg;
				$pvt_donations += $d->total;
			}
			if($d->bloodbank_type == 1){
				$ircs_apos += $d->Apos;
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
				<td style="text-align: right;"><?php echo number_format($govt_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($govt_donations) ; ?></td>
			<?php
			foreach($dashboard_bloodbanks as $d){ ?>
			<tr class="govt sub">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php }
				}
			?>
		<?php
                        $total_apos = 0;
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
				<td style="text-align: right;"><?php echo number_format($ircs_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($ircs_donations) ; ?></td>
			<?php
			foreach($dashboard_bloodbanks as $d){ ?>
			<tr class="ircs sub">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php }
				}
			?>
		<?php
                        $total_apos = 0;
                        $total_bpos = 0;
                        $total_opos = 0;
                        $total_aneg = 0;
                        $total_bneg = 0;
                        $total_oneg = 0;
                        $total_donations = 0;
			if($govt_donations>0){ 
			?>
			<tr class="pvt main">
				<td>Private</td>
				<td style="text-align: right;"><?php echo number_format($pvt_apos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_aneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_bpos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_bneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_opos) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_oneg) ; ?></td>
				<td style="text-align: right;"><?php echo number_format($pvt_donations) ; ?></td>
			<?php
			foreach($dashboard_bloodbanks as $d){ ?>
			<tr class="pvt sub">
				<td><?php echo $d->bloodbank_name;?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Apos) ; $total_apos += $d->Apos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Aneg) ; $total_aneg += $d->Aneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bpos) ; $total_bpos += $d->Bpos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Bneg) ; $total_bneg += $d->Bneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Opos) ; $total_opos += $d->Opos; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->Oneg) ; $total_oneg += $d->Oneg; ?></td>
                                <td style="text-align: right;"><?php echo number_format($d->total) ; $total_donations += $d->total; ?></td>
			</tr>
			<?php }
				}
			?>
                        <tr>
                            <td>Total</td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_apos + $ircs_apos + $pvt_apos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_aneg + $ircs_aneg + $pvt_aneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bpos + $ircs_bpos + $pvt_bpos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_bneg + $ircs_bneg + $pvt_bneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_opos + $ircs_opos + $pvt_opos); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_oneg + $ircs_oneg + $pvt_oneg); ?></b></td>
                            <td style="text-align: right;"><b><?php echo number_format($govt_donations + $ircs_donations + $pvt_donations); ?></b></td>
                        </tr>
		</tbody>
		</table>
	</div>