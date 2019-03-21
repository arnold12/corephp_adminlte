<?php
require_once 'config.php';
if (!isUserLoggedIn()) {
    header("Location: logout.php");
}

$DBI = new Db();

$DBI->query("SET NAMES 'utf8'");

if(isset($_GET['id']) && $_GET['id'] != "" && !isset($_POST['frm'])){
    
    
    $select_info = "SELECT `id`, `username`, `email`, `password` 
    FROM `users`
    WHERE (`id` = '".$_GET['id']."')";

    $result_info = $DBI->query($select_info);
    
    if(mysql_num_rows($result_info) == 0){
        header('Location: users.php');die();
    }
    
    $rows_info = $DBI->get_result($select_info);
       
}

if(isset($_POST['frm']) && $_POST['frm'] == '1' ){
    
    
    $username = mysql_real_escape_string($_POST['username']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    
    if($_POST['mode'] == 'edit'){ // Edit mode
        
        // Update data for user
        $update = "UPDATE `users` SET `username`='".$username."', `email`='".$email."', `password`='".$password."' WHERE id = '".$_POST['id']."' ";
        $res_update = $DBI->query($update);

        
    } else { // Add mode
        
       // Insert data for user 
       $insert = "INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES ('".$username."', '".$email."', '".$password."', 'admin')";
       $res_insert = $DBI->query($insert);
       
    }   
    header('Location: users.php');
}
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  

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
        User
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo (isset($_GET['id']) ? 'Edit' : 'Add' )?> user</div>
                    <div class="panel-body">
                        <form class="" id="user-form" method="POST" enctype="multipart/form-data" action="add-edit-user.php">
                        <div class="row">
                            <div class="form-group col-sm-6 ">
                              <label for="err_msg_username" class="control-label">User Name</label>
                              <input class="form-control" value="<?=isset($rows_info[0]['username']) ? $rows_info[0]['username'] : '';?>" required="" name="username" type="text" id="username">
                              <label id="err_msg_username" class="control-label err_msg" style="color: #dd4b39;font-size: 15px;display: none;"></label>
                            </div>
                            <div class="form-group col-sm-6 ">
                              <label for="email" class="control-label">Email</label>
                              <input class="form-control" value="<?=isset($rows_info[0]['email']) ? $rows_info[0]['email'] : '';?>" required="" name="email" type="email" id="email">
                              <label id="err_msg_email" class="control-label err_msg" style="color: #dd4b39;font-size: 15px;display: none;"></label>
                            </div>
                            <div class="form-group col-sm-6 ">
                              <label for="password" class="control-label">Password</label>
                              <input class="form-control" value="<?=isset($rows_info[0]['password']) ? $rows_info[0]['password'] : '';?>" required="" name="password" type="text" id="password">
                              <label id="err_msg_password" class="control-label err_msg" style="color: #dd4b39;font-size: 15px;display: none;"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input class="btn btn-primary" id="submit" type="submit" value="Save" onclick="return validate_user_info()">
                                <label id="succes_msg" class="control-label succes_msg" style="color: green;font-size: 14px;"></label>
                            </div>
                        </div>
                        <input type="hidden" name="frm" value="1">
                        <input type="hidden" name="mode" id="mode" value="<?php echo (isset($_GET['id']) ? 'edit' : 'add' )?>">
                        <?php
                          if(isset($_GET['id'])){
                        ?>
                            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
                        <?php
                          }
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'footer.php';?>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="dist/js/common.js"></script>
</body>
</html>

