<script type="text/javascript" src="<?php echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/js/bootstrap.min.js"></script>
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
        $(function(){ 
	$(".date").Zebra_DatePicker();
      });
	  
    </script>
    <body class="skin-blue sidebar-mini">
<?php 
    $from_date = "";
    $to_date = "";
?>
<div  class="col-md-6 col-xs-8">
      <!-- Left side column. contains the logo and sidebar -->
      <a href="<?php echo base_url()."";?>" class="btn btn-primary btn-lg active" role="button">Back to Summary report</a>
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
		</div>
		</div>
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
                    <tr class="main">
			<?php $blood_bank_prev = "";
                            foreach($dashboard_available as $d){
				foreach($d as $blood_group){ 
				if($blood_group->bloodbank_type == 0){                                    
                                    if($blood_bank_prev != $blood_group->bloodbank_name){
                                    ?>
                                
                                    <td><b><?php echo $blood_group->bloodbank_name; ?></b></td>
                                
                                    <?php $blood_bank_prev = $blood_group->bloodbank_name; }                                 
                                    else if($blood_bank_prev == $blood_group->bloodbank_name){
                                    ?>
                                        <td style="border-bottom: 0px"></td>
                                    <?php  }    ?>
			
				<td style="text-align: right;"><b><?php echo $blood_group->blood_group; ?></b></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->wb); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->pc); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->fp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->ffp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->prp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->cryo); ?></td>
			</tr>
			<?php
				}
				}
			}
			?>
		</tbody>
		<tbody>
			<tr class="main">
			<?php  
                            $blood_bank_prev = "";
                            foreach($dashboard_available as $d){
				foreach($d as $blood_group){
				if($blood_group->bloodbank_type == 1){
                                    if($blood_bank_prev != $blood_group->bloodbank_name){
                                    ?>
                                
                                    <td><b><?php echo $blood_group->bloodbank_name; ?></b></td>
                                
                                    <?php $blood_bank_prev = $blood_group->bloodbank_name; }                                 
                                    else if($blood_bank_prev == $blood_group->bloodbank_name){
                                    ?>
                                        <td style="border-bottom: 0px"></td>
                                    <?php  }    ?>
			
				<td style="text-align: right;"><b><?php echo $blood_group->blood_group; ?></b></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->wb); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->pc); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->fp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->ffp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->prp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->cryo); ?></td>
			</tr>
			<?php
				}
				}
			}
			?>
		</tbody>
		<tbody>
			<tr class="main">
			<?php $blood_bank_prev = "";
                            foreach($dashboard_available as $d){
				foreach($d as $blood_group){ 
				if($blood_group->bloodbank_type == 2){
                                
                                    if($blood_bank_prev != $blood_group->bloodbank_name){
                                    ?>
                                
                                    <td rowspan="<?php echo $blood_group->total; ?>"><b><?php echo $blood_group->bloodbank_name; ?></b></td>
                                
                                    <?php $blood_bank_prev = $blood_group->bloodbank_name; } 
                                    else if($blood_bank_prev == $blood_group->bloodbank_name){
                                    ?>
                                        <td style="border-bottom: 0px"></td>
                                    <?php  }    ?>
			
				<td style="text-align: right;"><b><?php echo $blood_group->blood_group; ?></b></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->wb); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->pc); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->fp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->ffp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->prp); ?></td>
				<td style="text-align: right;"><?php echo number_format($blood_group->cryo); ?></td>
			</tr>
			<?php
				}
				}
			}
			?>
		</tbody>
		</tbody>
		</table>
	</div>
    </body>
    
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