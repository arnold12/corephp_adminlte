<?php
require_once 'config.php';
if (!isUserLoggedIn()) {
    header("Location: logout.php");
}

$DBI = new Db();

$DBI->query("SET NAMES 'utf8'");

$select_user = "SELECT `id`, `username` FROM `users`";
//$result_service_repair = $DBI->query($select_service_repair);
$rows_user = $DBI->get_result($select_user);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="dist/css/sweetalert.min.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include_once("header.php") ?>
    <?php include_once("sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      
      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-sm-12" style="text-align:right;">
                   <a class="btn btn-primary" href="add-edit-user.php">Add New</a>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="data-table" class="table table-bordered table-hover dataTable" style="text-align: center;">
                  <thead>
                    <tr role="row">
                      <th style="text-align:center;">Id</th>
                      <th style="text-align:center;">User Name</th>
                      <th style="text-align:center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($rows_user )){
                      $i = 1;
                      foreach($rows_user as $key => $value){
                    ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$value['username']?></td>
                      <td><a title="Edit" href="add-edit-user.php?id=<?=$value['id']?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
                        <a title="Delete" onclick="del_user(<?=$value['id']?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

    </section>
    
  </div>
  
  <?php include_once 'footer.php';?>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="dist/js/sweetalert.min.js"></script>
<script type="text/javascript">
  function del_user(id){
    swal({   title: "Do you want to delete user?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Yes",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) { 
            var action = "delete_user";
            $.ajax({
              url: "ajax_function.php",
              type: "POST",
              data: { id: id, action: action },
              success: function(result) {
                swal("User Removed!", "User removed permanently!", "success");
                location.reload();
              }
            });   
        } 
        else {     
               swal("", "User is not removed!", "error");  
        } 
   });
  }
</script>
<script>
  $(function () {
    $("#data-table").DataTable();
  });
</script>
</body>
</html>

