 <head>
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
          <div class="col-md-12 nav-wrapper">
            <div>
              <div>
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="index.html" class="navbar-brand"> 
                 <b>PMW Undip</b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>Penyeleksi</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="<?php echo base_url('assets/img/avatar.jpg')?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="<?php echo base_url('Pengaturan/lihat_User'); ?>"><span class="fa fa-user"></span> Data User</a></li>
                     <li><a href="<?php echo base_url('LoginControl/logout'); ?>"  onclick="return konfirmasi_logout()"><span class="fa fa-power-off"></span> Log Out</a></li>
                     <li role="separator" class="divider"></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu --
            <div id="left-menu">
              <div class="sub-left-menu scroll">
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
                    </br>
                    <li class="active ripple">
                      <a href="<?php echo base_url('LoginControl/homeTimSeleksi'); ?>" class="tree-toggle nav-header"><span class="fa-home fa"></span> Home</a></li>
                    <li><a href="<?php echo base_url('Tim/pilihDataTim'); ?>"><span class="fa fa-group"></span> Lihat Tim</a></li>
                    <li><a href="<?php echo base_url('Kriteria/lihatKriteria'); ?>"><span class="fa fa-list"></span> Lihat Kriteria</a></li>
                    <li><a href="<?php echo base_url('Nilai/pilihDataKelolaNilai'); ?>"><span class="fa fa-table"></span> Kelola Penilaian</a></li>
                    </li>
                 
                    <li class="ripple"><a href="<?php echo base_url('Komputasi/pilihKelolaHasil'); ?>"><span class="fa fa-tasks"></span> Kelola Hasil </a>
       
                    </li>
                  </ul>
                </div>
            </div>