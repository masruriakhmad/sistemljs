<!doctype html>
<html lang="en">
<head>
	<title>Membuat Dynamic Field Keren Dengan Bootsrtap | Jin Toples Programming</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		body {
			text-align:center;
			background-color:#61b3de;
			font-family:Arial, Helvetica, sans-serif;
			font-size:80%;
			color:#666;
		}
		.entry{
			margin-bottom:10px;
		}
		.wrap {
			background: #f3f8fb;
			width:730px;
			margin:30px auto;
			border: 4px dashed #61b3de;
			border-radius:4px;
			padding: 20px 5px;
		}
		h1 {
			font-family:Georgia, "Times New Roman", Times, serif;
			font-size:24px;
			color:#645348;
			font-style:italic;
			text-decoration:none;
			font-weight:100;
			padding: 10px;
		}
		.form-control{
			border-radius:0px;
		}
		
		.btn {
			border-radius:0px;
		}
	</style>
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/script.js"></script>
<link href="<?php echo base_url ('assets/css/bootstrap.min.css'); ?>"  rel="stylesheet" type="text/css">
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/animate.min.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/nouislider.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/select2.min.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css'); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url ('assets/css/plugins/bootstrap-material-datetimepicker.css') ;?>"/>
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
   <link rel="shortcut icon" href="<?php echo base_url('assets/img/logomi.png'); ?>">
  <!-- end: Css -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>
<body>

	<div> 
		<form action="save_data.php" method="post">
			<div class="controls"> 
				<div class="form-group">
					<div class="entry input-group">
						<input class="form-control" name="data[]" type="text" placeholder="Entry..." required>
						<span class="input-group-btn">
							<button class="btn btn-success btn-add" type="button">
								<span class="glyphicon glyphicon-plus"></span>
							</button>
						</span>
					</div>
			   </div>			   
			</div>
			<button class="btn btn-success" type="submit">Submit</button>
		</form>
	</div> 
	
</body>
</html>

<!-- start: Javascript -->
<script src="<?php echo base_url('view/assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/jquery.ui.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/jquery-1.8.3.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/script.js')?>"></script>
<script src="<?php echo base_url('asset/js/jquery-1.8.3.js')?>"></script>
<script src="<?php echo base_url('asset/js/script.js')?>"></script>


<!-- plugins -->
<script src="<?php echo base_url('view/assets/js/plugins/moment.min.js')?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.knob.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/bootstrap-material-datetimepicker.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.nicescroll.js') ;?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('view/assets/js/plugins/nouislider.min.js') ?>"></script>
<script>
	 $(function()
	  {
	   $(document).on('click', '.btn-add', function(e)
	   {
		e.preventDefault();

		var controlForm = $('.controls:first'),
		 currentEntry = $(this).parents('.entry:first'),
		 newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.find('input').val('');
		controlForm.find('.entry:not(:last) .btn-add')
		 .removeClass('btn-add').addClass('btn-remove')
		 .removeClass('btn-success').addClass('btn-danger')
		 .html('<span class="glyphicon glyphicon-minus"></span>');
	   }).on('click', '.btn-remove', function(e)
	   {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	   });
	  }
	 );

	</script>