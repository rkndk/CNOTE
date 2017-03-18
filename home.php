<?php
include "session.php";
include "koneksi.php";
$user = $userOnSession;
$sukses="";
$error="";
  if (isset($_POST['buatCatatan'])) {
    if ( empty($_POST['judul']) || empty($_POST['catatan'])) {
      $error = "Data tidak lengkap";
    }
    else
    {
      // Variabel
      $username= $user['username'];
      $judul = $_POST['judul'];
      $catatan = $_POST['catatan'];
      $tanggal = date("Y-m-d");

      mysql_query("insert into catatan(username,judul,isi,tanggal,favorit)  values('".$username."','".$judul."','".$catatan."','".$tanggal."',0)", $connection);
      $sukses = "Catatan Berhasil Disimpan";
      header("location: home.php?status=sukses");
    }
  }
if(!empty($_GET['status'])){
  $sukses="Catatan Berhasil Disimpan";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CNOTE - Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
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
        <li class="active"><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="profil.php"><i class="fa fa-user"></i> <span>Profil</span></a></li>
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
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> CNOTE</a></li>
        <li class="active">Dashboard</li>
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
      <div class="col-md-12">
          <div class="col-md-6">
            <!-- buat catatan -->
            <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-plus"></i>
                  <h3 class="box-title">Buat Catatan</h3>
                </div>
                <form action="home.php" method="post">
                      <div class="box-body">
                        <div class="form-group">
                          <input type="text" class="form-control" name="judul" placeholder="Judul">
                        </div>
                        <div>
                          <textarea id="catatan" name="catatan" class="textarea" placeholder="Catatan" style="width: 100%; height: 240px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                      </div>
                      <div class="box-footer clearfix">
                        <button name="buatCatatan" type="submit" class="pull-right btn btn-default" id="buatCatatan">Buat Catatan
                          <i class="fa fa-arrow-circle-right"></i></button>
                      </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">List Catatan</h3>

                <div class="box-tools pull-right">
                  <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                  </div>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                  </button>
                  <div class="btn-group">
                    <button onclick="hapusBanyak()" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  </div>
                  <!-- /.btn-group -->
                  <button onclick="refresh()" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <tbody id="listcatatan">
                    <?php
                      $sql=mysql_query("select * from catatan where username='".$user['username']."'", $connection);
                      while($data=mysql_fetch_array($sql)){
                          echo '
                          <tr id="'.$data['id'].'">
                          <td><input type="checkbox"></td>';
                          if($data['favorit']==1){
                            echo '<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>';
                          }
                          else{
                            echo '<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>'; 
                          }
                          if(strlen($data['judul'])>30){
                            $data['judul']=substr($data['judul'],0,30)." .....";
                          }
                          echo '<td class="mailbox-name"><a href="baca.php?id='.$data['id'].'">'.$data['judul'].'</a></td>';
                          $date = date_create($data['tanggal']);
                          $tglEdit= date_format($date,"d M Y");
                          echo '<td class="mailbox-date">Terakhir di edit : '.$tglEdit.'</td>
                        </tr>';
                      }
                    ?>
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
              </div>
            </div>
            <!-- /. box -->
          </div>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$('.textarea').wysihtml5();
</script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages  input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");
      var trid = $(this).closest('tr').attr('id');

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
      if(!$this.hasClass("fa-star-o")){
        favorit(1,trid);
      }
      else{
        favorit(0,trid);
      }
    });
  });
</script>
<script type="text/javascript">
  function favorit(tipe, id) { 
    $.post("favorit.php",
      {
          tipe: tipe,
          id: id
      },
      function(data, status){
          //alert("Data: " + data + "\nStatus: " + status);
      }
    );
  }

  function refresh(){
    window.location.href="home.php";
  }

  function hapusBanyak(){
    var selected = [];
    $('#listcatatan input:checked').each(function() {
        selected.push($(this).closest('tr').attr('id'));
    });

    $.post("catatan.php",
      {
          tipe: "hapus",
          id: selected
      },
      function(data, status){
          window.location.href="home.php";
      }
    );
  }
</script>

</body>
</html>


<?php
mysql_close();
?>