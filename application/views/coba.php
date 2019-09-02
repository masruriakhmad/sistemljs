<!doctype html>
<html lang="en">
<head>
	<title>Membuat Dynamic Field Keren Dengan Bootsrtap | Jin Toples Programming</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />

	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/script.js"></script>
</head>
<body>

	

		<form action="<?php echo base_url('Penerimaan_grey/Proses2'); ?>" method="post">
			
			<input class="form-control" name="data 1" type="text" placeholder="Entry..." required>
			<button class="btn btn-success" type="submit">Submit</button>
			<br>
		
		</form>
		
	<form action="<?php echo base_url('Penerimaan_grey/Proses1'); ?>" method="post">

		<br><br>
			<input class="form-control" name="data2" type="text" placeholder="Entry..." required>
			<button class="btn btn-success" type="submit">Submit</button>


	</form>
	
	
</body>
</html>