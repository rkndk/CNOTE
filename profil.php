<?php
include "session.php";
include "koneksi.php";
$user = $userOnSession;
$sukses="";
$error="";
  if (isset($_POST['simpanEdit'])) {
    if ( empty($_POST['nama']) || empty($_POST['email'])) {
      $error = "Data tidak valid";
    }
    else
    {
      // Variabel
      $username =$user['username'];
      $email = $_POST['email'];
      $nama = $_POST['nama'];
      $tglLahir = $_POST['tglLahir'];
      $deskripsi = $_POST['deskripsi'];

      // update data ke database
      mysql_query("UPDATE user SET nama='$nama', email='$email', tglLahir='$tglLahir', deskripsi='$deskripsi' WHERE username='$username'",$connection) or die(mysql_error());
      $sukses = "Informasi Berhasil Disimpan";

      // update info user
      $ses_sql=mysql_query("select * from user where username='$userCheck'", $connection);
      $user = mysql_fetch_assoc($ses_sql);
    }
  }
  else if (isset($_POST['simpanPass'])) {
    if ( empty($_POST['passlama']) || empty($_POST['passbaru1']) || empty($_POST['passbaru2'])) {
      $error = "Data tidak valid";
    }
    else
    {
      // Variabel
      $username =$user['username'];
      $passwordLama = $_POST['passlama'];
      $passwordBaru1 = $_POST['passbaru1'];
      $passwordBaru2 = $_POST['passbaru2'];

      if($passwordBaru1!=$passwordBaru2){
        $error = "Password Tidak Sama";
      }
      else if(md5($passwordLama)!=$user['password']){
        $error = "Password Lama Salah";
      }
      else{
        // update data ke database
        mysql_query("UPDATE user SET password='".md5($passwordBaru1)."' WHERE username='$username'",$connection) or die(mysql_error());
        $sukses = "Informasi Berhasil Disimpan";
      }
    }
  }
  else if (isset($_POST['hapusAkun'])) {
      // Variabel
      $username =$user['username'];

      // hapus user dari database
      mysql_query("DELETE from user WHERE username='$username'",$connection) or die(mysql_error());
      mysql_query("DELETE from catatan WHERE username='$username'",$connection) or die(mysql_error());
      mysql_close($connection); // Menutup koneksi
      header("location: keluar.php");
  }
mysql_close($connection); // Menutup koneksi
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CNOTE - Profil</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
</head>

<body class="hold-transition skin-blue fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>N</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>C</b>NOTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="assets/css/images/profile.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> <?php echo $user['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="assets/css/images/profile.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['nama'];?>
                  <small>
                    <?php
                      if($user['deskripsi']!=""){
                        echo $user['deskripsi'];
                      }
                      else {
                        echo "tulis deskripsimu di profil";
                      }
                    ?>
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="keluar.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <br><center><img class="user-header img-circle" alt="User Image" src="assets/css/images/profile.png" style="width:80%"></center><br>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="profil.php"><i class="fa fa-user"></i> <span>Profil</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> CNOTE</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(!empty($sukses)){
          echo '
            <div class="row col-md-12">
                <div class="callout callout-info">
                  <center><h4>'.$sukses.'</h4></center>
                </div>
            </div>';
        }
        else if(!empty($error)){
          echo '
            <div class="row col-md-12">
                <div class="callout callout-danger">
                  <center><h4>'.$error.'</h4></center>
                </div>
            </div>';
        }
      ?>
     
      <div class="row">
      <!-- Your Page Content Here -->
        <div class="col-md-4 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Edit Profil</h3>
            </div>
            <form action="profil.php" method="post" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input name="username" type="text" class="form-control" data-inputmask="'alias': 'username'" data-mask disabled value="<?php echo $user['username']; ?>" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <input name="email" type="email" class="form-control" data-inputmask="'alias': 'email" data-mask value="<?php echo $user['email']; ?>" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label>Nama</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-font"></i>
                      </div>
                      <input name="nama" type="text" class="form-control" data-inputmask="'alias': 'nama'" data-mask value="<?php echo $user['nama']; ?>" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="tglLahir" type="date" class="form-control" data-inputmask="'alias': 'tanggal lahir'" data-mask value="<?php echo $user['tglLahir']; ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-comments"></i>
                      </div>
                      <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi"><?php echo $user['deskripsi']; ?></textarea>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" name="simpanEdit">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Ganti Password</h3>
            </div>
            <form action="profil.php" method="post" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Password Lama</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input name="passlama" type="text" class="form-control" data-inputmask="'alias': 'password'" data-mask required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Password Baru</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input name="passbaru1" type="text" class="form-control" data-inputmask="'alias': 'password'" data-mask required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Konfirmasi Password Baru</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input name="passbaru2" type="text" class="form-control" data-inputmask="'alias': 'password'" data-mask required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right" name="simpanPass">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

          <form action="profil.php" method="post">
            <button name="hapusAkun" type="submit" class="btn btn-block btn-danger btn-lg">HAPUS AKUN</button>
          </form>
        </div>

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">CNOTE</a>.</strong>
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
</body>
</html>