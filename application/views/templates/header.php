<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - Core Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flaticon.css" >
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
	<script>
	$(function () {
	  $('[data-toggle="popover"]').popover({trigger:'hover',html:true});
		$("#unit").chained("#department");
		$("#area").chained("#department");
	});
	</script>
</head>
<body>
<div id="wrap">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
		<!-- Bootstrap toggle menu for mobile devices, only visible on small screens --> 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">Core Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav right">
			<li class="active"><a href="<?php echo base_url()."";?>"><i class="fa fa-tint"></i> Bloodbanks</a></li>
				 <!-- <li><a href="<?php echo base_url()."home/bloodbanks";?>"><i class="fa fa-hospital-o"></i>Hospitals & Colleges</a></li>-->
			<li><a href="<?php echo base_url()."home/hospitals";?>"><i class="fa fa-edit"></i> Hospitals</a></li>
				 <!-- <li><a href="<?php echo base_url()."home/contact";?>"><i class="fa fa-map-marker"></i> Contact</a></li>-->
			<?php if($this->session->userdata('logged_in')){ ?>
			 <li><a href="<?php echo base_url()."home/logout";?>"><i class="fa fa-logout"></i> Logout</a></li>
			 <?php } ?>

		</ul>
	
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
