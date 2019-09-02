 <head>
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/datatables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <!--alternatif-->
  <!-- start: Css -->
      <link href="<?php echo base_url ('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
      <!-- plugins -->
      <link href="<?php echo base_url ('assets/css/plugins/font-awesome.min.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/simple-line-icons.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/animate.min.css');?>" rel="stylesheet" type="text/css" >
      <link href="<?php echo base_url ('assets/css/plugins/fullcalendar.min.css');?>" rel="stylesheet" type="text/css" >
  <link href="<?php echo base_url ('assets/css/style.css');?>" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?php echo base_url ('assets/img/logomi.png');?>">

  <link rel="shortcut icon" href="asset/img/logomi.png">
   <script type="text/javascript">
     function konfirmasi_logout()
    {
      tanya = confirm("Anda Yakin Ingin Keluar dari Sistem?");
      if (tanya == true) return true;
      else return false;
    }

   </script>
 </head>
      <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 col-sm-12 nav-wrapper">
          
             
               <a class="navbar-brand"> 
                <span>LJS</span>
              </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?php echo $this->session->userdata('nm_user').'&nbsp|&nbsp'?></span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="<?php echo base_url('assets/img/avatar.jpg')?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="<?php echo base_url('Pengaturan/reset'); ?>"><span class="fa fa-cog"></span>Reset Password</a></li>
                     <li><a href="<?php echo base_url('Pengaturan'); ?>"><span class="fa fa-user"></span> Data User</a></li>
                     <li><a href="<?php echo base_url('LoginControl/logout'); ?>" onclick="return konfirmasi_logout()"><span class="fa fa-power-off"></span> Log Out</a></li>
                     <li role="separator" class="divider"></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  

          <!-- start:Left Menu -->
            <div id="left-menu">

              <div class="sub-left-menu Scrollspy">

                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <li class="time" onload="setInterval('displayServerTime()', 1000);">
                      <h1 class="animated fadeInLeft" id="clock"><?php print date('H:i'); ?></h1>
                      <p class="animated fadeInRight">
                      <?php
                            $tanggal= mktime(date("m"),date("d"),date("Y"));
                            echo "<p class='animated fadeInRight'>".date("d-M-Y", $tanggal)."</p> ";
                            date_default_timezone_set('Asia/Jakarta');
                                    
                      ?>
                    </p>
                    </li>


        <!-- dropdown-->
        <?php
        if($this->session->userdata('level')=='operator'){ 
        ?>
          <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" role="button" aria-expanded="true"><span class="fa fa-tasks"></span>Transaksi
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_benang'); ?>">Penerimaan Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Penerimaan Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_grey'); ?>">Pengiriman Grey</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_kainjadi'); ?>">Penerimaan Kain Jadi</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_kainjadi'); ?>">Barang keluar</a></li> 
          </ul>
        </li>
          
        <?php
        }else
        if($this->session->userdata('level')=='admin'){
        ?>

         <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"><span class="fa fa-tasks"></span>Master Barang
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Benang'); ?>">Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Customer'); ?>">Customer</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Grey'); ?>">Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Mesin'); ?>">Mesin</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Subcon'); ?>">Subcon</a></li>    
            <li><a class="dropdown-item" href="<?php echo base_url('Vendors'); ?>">Vendor</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Warna'); ?>">Warna</a></li>
            
        
          </ul>
        </li>

           <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" role="button" aria-expanded="true"><span class="fa fa-tasks"></span>Transaksi
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Wo'); ?>">Work Order</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_benang'); ?>">Penerimaan Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Penerimaan Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_grey'); ?>">Pengiriman Grey</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_kainjadi'); ?>">Penerimaan dari Kain Jadi</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_kainjadi'); ?>">Barang keluar</a></li> 
          </ul>
        </li>

            <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span class="fa fa-tasks"></span>Laporan
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_akhir_benang'); ?>">Stock Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilGrey'); ?>">Stock Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilMaklun'); ?>">Stock Maklun</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilKainjadi'); ?>">Stock Kain Jadi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Transaksi  Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Transaksi Penerimaan Grey</a></li>
            <li><a href="#">Transaksi Pengiriman Grey</a></li> 
            <li><a href="#">Transaksi Penerimaan Kain Jadi</a></li> 
            <li><a href="#">Transaksi Barang keluar</a></li>
          </ul>
        </li>

          
        <?php
        }else
        if($this->session->userdata('level')=='manager'){
        ?>

           <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span class="fa fa-tasks"></span>Laporan
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_akhir_benang'); ?>">Stock Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilGrey'); ?>">Stock Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilMaklun'); ?>">Stock Maklun</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilKainjadi'); ?>">Stock Kain Jadi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Transaksi  Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Transaksi Penerimaan Grey</a></li>
            <li><a href="#">Transaksi Pengiriman Grey</a></li> 
            <li><a href="#">Transaksi Penerimaan Kain Jadi</a></li> 
            <li><a href="#">Transaksi Barang keluar</a></li>
          </ul>
        </li>

        <?php
        }else
        if($this->session->userdata('level')=='webmaster'){
        ?>


         <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"><span class="fa fa-tasks"></span>Master Barang
          <span class="caret"></span></a>
           <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Benang'); ?>">Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Customer'); ?>">Customer</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Grey'); ?>">Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Mesin'); ?>">Mesin</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Subcon'); ?>">Subcon</a></li>    
            <li><a class="dropdown-item" href="<?php echo base_url('Vendors'); ?>">Vendor</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Warna'); ?>">Warna</a></li>
          </ul>
        </li>

           <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" role="button" aria-expanded="true"><span class="fa fa-tasks"></span>Transaksi
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Wo'); ?>">Work Order</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_benang'); ?>">Penerimaan Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Penerimaan Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_grey'); ?>">Pengiriman Grey</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_kainjadi'); ?>">Penerimaan dari Kain Jadi</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url('Pengiriman_kainjadi'); ?>">Barang keluar</a></li>  
          </ul>
        </li>

           <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span class="fa fa-tasks"></span>Laporan
          <span class="caret"></span></a>
           <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_akhir_benang'); ?>">Stock Benang</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilGrey'); ?>">Stock Grey</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilMaklun'); ?>">Stock Maklun</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Stock_kain/tampilKainjadi'); ?>">Stock Kain Jadi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Produksi'); ?>">Transaksi  Produksi</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Penerimaan_grey'); ?>">Transaksi Penerimaan Grey</a></li>
            <li><a href="#">Transaksi Pengiriman Grey</a></li> 
            <li><a href="#">Transaksi Penerimaan Kain Jadi</a></li> 
            <li><a href="#">Transaksi Barang keluar</a></li>
          </ul>
        </li>

        <?php
        }
        ?>
                 
                  </ul>
                </div>
            </div>
            <!-- akhir Left Menu -->

</body>

