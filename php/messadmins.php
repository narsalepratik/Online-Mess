<?php 
session_start();
if(!($_SESSION['IS_LOGIN'] && $_SESSION['ADMIN']))
{
	echo "<h2>Invalid url</h2>";
	die();
}
include('header.php');
include('database.php');
// if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
// 	$type=get_safe_value($_GET['type']);
// 	$id=get_safe_value($_GET['id']);
// 	if($type=='active' || $type=='deactive'){
// 		$status=1;
// 		if($type=='deactive'){
// 			$status=0;
// 		}
// 		mysqli_query($con,"update user set status='$status' where id='$id'");
// 		redirect('user.php');
// 	}

// }

$query = "select * from mess_admin order by added_on desc";
    $result = mysqli_query($con,$query);
    $locations = mysqli_fetch_all($result,MYSQLI_ASSOC);
    prx($locations);

?>
  