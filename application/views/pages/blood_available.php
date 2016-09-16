<?php 
    $from_date = "";
    $to_date = "";
?>
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


<?php 
    $govt_bloodbank = array();
    $ircs_bloodbank = array();
    $other_bloodbank = array();
    $blood_groups = array();
    
    foreach($dashboard_available as $d){
        foreach($d as $blood_source){
            if(!in_array($blood_source->blood_group, $blood_groups)){
                $blood_groups[] = $blood_source->blood_group;
            }
        }
    }
    
    foreach($blood_groups as $blood_group){
        $govt_bloodbank["$blood_group"]['blood_group'] = $blood_group;
        $govt_bloodbank["$blood_group"]['wb'] = 0;
        $govt_bloodbank["$blood_group"]['pc'] = 0;
        $govt_bloodbank["$blood_group"]['fp'] = 0;
        $govt_bloodbank["$blood_group"]['ffp'] = 0;
        $govt_bloodbank["$blood_group"]['prp'] = 0;
        $govt_bloodbank["$blood_group"]['cryo'] = 0;
        $ircs_bloodbank["$blood_group"]['blood_group'] = $blood_group;
        $ircs_bloodbank["$blood_group"]['wb'] = 0;
        $ircs_bloodbank["$blood_group"]['pc'] = 0;
        $ircs_bloodbank["$blood_group"]['fp'] = 0;
        $ircs_bloodbank["$blood_group"]['ffp'] = 0;
        $ircs_bloodbank["$blood_group"]['prp'] = 0;
        $ircs_bloodbank["$blood_group"]['cryo'] = 0;
        $other_bloodbank["$blood_group"]['blood_group'] = $blood_group;
        $other_bloodbank["$blood_group"]['wb'] = 0;
        $other_bloodbank["$blood_group"]['pc'] = 0;
        $other_bloodbank["$blood_group"]['fp'] = 0;
        $other_bloodbank["$blood_group"]['ffp'] = 0;
        $other_bloodbank["$blood_group"]['prp'] = 0;
        $other_bloodbank["$blood_group"]['cryo'] = 0;
        
    }
    
    
    foreach($dashboard_available as $d){
        foreach($d as $blood_source){
            if($blood_source->bloodbank_type == 0){
                $govt_bloodbank["$blood_source->blood_group"]['blood_group'] = $blood_source->blood_group;
                $govt_bloodbank["$blood_source->blood_group"]['wb'] += number_format($blood_source->wb);
                $govt_bloodbank["$blood_source->blood_group"]['pc'] += number_format($blood_source->pc);
                $govt_bloodbank["$blood_source->blood_group"]['fp'] += number_format($blood_source->fp);
                $govt_bloodbank["$blood_source->blood_group"]['ffp'] += number_format($blood_source->ffp);
                $govt_bloodbank["$blood_source->blood_group"]['prp'] += number_format($blood_source->prp);
                $govt_bloodbank["$blood_source->blood_group"]['cryo'] += number_format($blood_source->cryo);
            }
            if($blood_source->bloodbank_type == 1){
                $ircs_bloodbank["$blood_source->blood_group"]['blood_group'] = $blood_source->blood_group;
                $ircs_bloodbank["$blood_source->blood_group"]['wb'] += number_format($blood_source->wb);
                $ircs_bloodbank["$blood_source->blood_group"]['pc'] += number_format($blood_source->pc);
                $ircs_bloodbank["$blood_source->blood_group"]['fp'] += number_format($blood_source->fp);
                $ircs_bloodbank["$blood_source->blood_group"]['ffp'] += number_format($blood_source->ffp);
                $ircs_bloodbank["$blood_source->blood_group"]['prp'] += number_format($blood_source->prp);
                $ircs_bloodbank["$blood_source->blood_group"]['cryo'] += number_format($blood_source->cryo);
            }
            if($blood_source->bloodbank_type == 2){
                $other_bloodbank["$blood_source->blood_group"]['blood_group'] = $blood_source->blood_group;
                $other_bloodbank["$blood_source->blood_group"]['wb'] += number_format($blood_source->wb);
                $other_bloodbank["$blood_source->blood_group"]['pc'] += number_format($blood_source->pc);
                $other_bloodbank["$blood_source->blood_group"]['fp'] += number_format($blood_source->fp);
                $other_bloodbank["$blood_source->blood_group"]['ffp'] += number_format($blood_source->ffp);
                $other_bloodbank["$blood_source->blood_group"]['prp'] += number_format($blood_source->prp);
                $other_bloodbank["$blood_source->blood_group"]['cryo'] += number_format($blood_source->cryo);
            }
        }
    }    
    
?>



    <div  class="col-md-6 col-xs-8 pull-left">
      <!-- Left side column. contains the logo and sidebar -->
        <div class="row">
			<div class="col-md-12"><b class="box-title">Blood Available as on <?php echo date("d-M-Y, g:ia");?></b></div>
		</div>
		<table class="table table-bordered">
		<thead class="thead2">
			<th>Bloodbank</th>
			<th>Group</th>
			<th title="Whole Blood">WB</th>
			<th title="Packed Cells">PC</th>
			<th title="Frozen Plasma">FP</th>
			<th title="Fresh Frozen Plasma">FFP</th>
			<th title="Platelet Rich Plasma">PRP</th>
			<th title="Cryoprecipitate">Cryo</th>
		</thead>
		<tbody>
		<?php 
		// Type wise summary (Govt, IRCS or Private)
		?>
		<tbody>
			<tr class="main" onclick="$('#govt').submit();">
                            <td rowspan="9"><b>Government</b></td>
                            <?php echo form_open('home/bloodbank_inventory_detailed',array('id'=>'govt','role'=>'form')); ?>
                            <input type="hidden" class="form-control" name="from_date" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" />
                            <input type="hidden" class="form-control" name="to_date" value="<?php echo date("d-M-Y",strtotime($to_date)); ?>" />				
                </form>
			</tr>
			<?php foreach($blood_groups as $blood_group){ ?>
			<tr>
				<td style="text-align: right;"><b><?php echo $govt_bloodbank["$blood_group"]['blood_group']; ?></b></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['wb']; ?></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['pc']; ?></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['fp']; ?></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['ffp']; ?></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['prp']; ?></td>
				<td style="text-align: right;"><?php echo $govt_bloodbank["$blood_group"]['cryo']; ?></td>
			</tr>
			<?php
				
			}
			?>
		</tbody>
		<tbody>
			<tr class="govt main">
				<td rowspan="9"><b>IRCS</b></td>
			</tr>
			<?php foreach($blood_groups as $blood_group){ ?>
			<tr>
				<td style="text-align: right;"><b><?php echo $ircs_bloodbank["$blood_group"]['blood_group']; ?></b></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['wb']; ?></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['pc']; ?></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['fp']; ?></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['ffp']; ?></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['prp']; ?></td>
				<td style="text-align: right;"><?php echo $ircs_bloodbank["$blood_group"]['cryo']; ?></td>
			</tr>
			<?php
				
			}
			?>
		</tbody>
		<tbody>
			<tr class="govt main">
				<td rowspan="9"><b>Private</b></td>
			</tr>
			<?php foreach($blood_groups as $blood_group){ ?>
			<tr>
				<td style="text-align: right;"><b><?php echo $other_bloodbank["$blood_group"]['blood_group']; ?></b></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['wb']; ?></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['pc']; ?></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['fp']; ?></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['ffp']; ?></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['prp']; ?></td>
				<td style="text-align: right;"><?php echo $other_bloodbank["$blood_group"]['cryo']; ?></td>
			</tr>
			<?php
				
			}
			?>
		</tbody>
		</tbody>
		</table>
	</div>