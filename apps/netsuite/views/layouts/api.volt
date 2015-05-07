<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Taufik R">
    <meta name="keyword" content="Netsuite Admin">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Netsuite Admin | Change Log</title>

	<!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <section id="container" >
		<!--header start-->
		{{ partial('../../core/views/partials/common/header') }}
		<!--header end-->
		<!--sidebar start-->
		{{ partial('../../core/views/partials/common/sidebar') }}
		<!--sidebar end-->

		<?php echo $this->getContent() ?>
		<!-- js placed at the end of the document so the pages load faster -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		
		<script src="js/core/core_ns.js"></script>
		<script src="js/core/grid_ns.js"></script>
		
		<script src="js/bootstrap.min.js"></script>
		<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
		<script src="js/jquery.scrollTo.min.js"></script>
		<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="js/jquery.sparkline.js" type="text/javascript"></script>
		<script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="js/owl.carousel.js" ></script>
		<script src="js/jquery.customSelect.min.js" ></script>
		<script src="js/respond.min.js" ></script>

		<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="assets/bootstrap-daterangepicker/moment.min.js"></script>
		<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>

		<script src="js/advanced-form-components.js"></script>

		<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

		<!--common script for all pages-->
		<script src="js/common-scripts.js"></script>

		<!--script for this page-->
		<script src="js/sparkline-chart.js"></script>
		<script src="js/easy-pie-chart.js"></script>
		<script src="js/count.js"></script>

		<script>

		//owl carousel

		$(document).ready(function() {
		  	$("#owl-demo").owlCarousel({
				navigation : true,
				slideSpeed : 300,
				paginationSpeed : 400,
				singleItem : true,
				autoPlay:true
		  	});
		  	EditableTable.init();
		});

		//custom select box

		$(function(){
		 	$('select.styled').customSelect();
		});

		</script>
		<!--footer start-->
        {{ partial('../../core/views/partials/common/footer') }}
        <!--footer end-->
    </section>

</body>