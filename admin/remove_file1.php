<?php
	require_once 'conn.php';
	if(ISSET($_POST['stud_no'])){
		$stud_no = $_POST['stud_no'];
		$query = mysqli_query($conn, "SELECT * FROM `storage` WHERE `stud_no` = '$stud_no'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$storage_id = $fetch['storage_id'];
		if(unlink("admin/files/".$stud_no."/".$filename)){
			mysqli_query($conn, "DELETE FROM `storage` WHERE `stud_no` = '$stud_no'") or die(mysqli_error());
		}
	}
?>