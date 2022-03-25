<?php 
	include('../config/constants.php');

	$id = $_GET['id'];

	$sql = "delete from comment where id=$id";

	$res = mysqli_query($conn, $sql);

	if($res==true)
	{
		$_SESSION['delete-comment'] = "<div class='success'>Xoá thành công!</div>";
		header('location:'.SITEURL.'admin/manage-comment.php');
	}
	else
	{
		$_SESSION['delete-comment'] = "<div class='error'>Xóa thất bại! Vui lòng thử lại.</div>";
		header('location:'.SITEURL.'admin/manage-comment.php');
	}
?>