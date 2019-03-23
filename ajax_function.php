<?php
require_once 'config.php';
$DBI = new Db();

if (!isUserLoggedIn()) {
    header("Location: logout.php");
}

$action	= $_POST['action'];
switch ($action){
    case "delete_user":
        delete_user();
        break;    
}
  
function delete_user(){
	global $DBI;
	$delete_at_row = "DELETE FROM users WHERE id = '".$_POST['id']."' ";
	$res_at_delete = $DBI->query($delete_at_row);
	echo "done";
	exit();
}

?>