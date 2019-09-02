<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miminium</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/mediaelementplayer.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="mimin" class="dashboard topnav">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
                <a href="#" class="navbar-brand"> 
                 <b>SISTEM LJS</b>
                </a>

                <ul class="nav navbar-nav">
                  <li class="active"></li>
                  <!--- Dropdown -->
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('Benang'); ?>">Benang</a></li>
                    <li><a href="<?php echo base_url('Grey'); ?>">Grey</a></li>
                    <li><a href="<?php echo base_url('Mesin'); ?>">Mesin</a></li>
                    <li><a href="<?php echo base_url('Grey'); ?>">Customer</a></li>
                    <li><a href="<?php echo base_url('Grey'); ?>">Vendor</a></li>
                    <li><a href="<?php echo base_url('Grey'); ?>">Warna</a></li>
                  </ul>
                  </li>

                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transaksi<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('Penerimaan_benang'); ?>">Penerimaan Benang</a></li>
                    <li><a href="<?php echo base_url('Produksi'); ?>">Produksi</a></li>
                    <li><a href="<?php echo base_url('Penerimaan_grey'); ?>">Penerimaan Grey</a></li>
                    <li><a href="<?php echo base_url('Pengiriman_grey'); ?>">Pengiriman Grey</a></li>
                    <li><a href="#">Penerimaan dari Maklon</a></li>
                    <li><a href="#">Barang Keluar</a></li>
                  </ul>
                  </li>

                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Stock Benang</a></li>
                    <li><a href="#">Produksi</a></li>
                    <li><a href="#">Penerimaan Grey</a></li>
                    <li><a href="#">Pengiriman Maklon</a></li>
                    <li><a href="#">Penerimaan dari Maklon</a></li>
                    <li><a href="#">Barang Keluar</a></li>
                  </ul>
                  </li>

                </ul>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>Akihiko Avaron</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                     <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href=""><span class="fa fa-lock"></span></a></li>
                        <li><a href=""><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <!-- start: Content -->
        
<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>



<!-- plugins -->
<script src="asset/js/plugins/holder.min.js"></script>
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

  });
</script>
<!-- end: Javascript -->
</body>
</html>