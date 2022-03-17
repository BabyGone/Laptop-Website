<?php 	include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Đổi mật khẩu</h1>
		<br><br>

		<?php 
			if (isset($_GET['id'])) {
				$id= $_GET['id'];
			}
		 ?>

		<form action="" method="POST">
			<table class="tbl-30">	
				<tr>
					<td>Mật khẩu hiện tại: </td>
					<td>
						<input type="password" name="current_password" placeholder="Mật khẩu hiện tại">
					</td>
				</tr>

				<tr>
					<td>Mật khẩu mới: </td>
					<td>
						<input type="password" name="new_password" placeholder="Mật khẩu mới">
					</td>
				</tr>

				<tr>
					<td>Nhập lại mật khẩu mới: </td>
					<td>
						<input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Đổi mật khẩu" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php
	if (isset($_POST['submit'])) 
	{
		$id = $_POST['id'];
		$current_password = md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);

		$sql= "select * from admin where id=$id and password='$current_password'";

		$res = mysqli_query($conn, $sql);

		if ($res==true) 
		{
			$count=mysqli_num_rows($res);

			if ($count==1) 
			{
				if ($new_password==$confirm_password) 
				{
					$sql2="update admin set
						password='$new_password'
						where id=$id";

					$res2=mysqli_query($conn,$sql2);

					if($res2==true)
					{
						$_SESSION['change-pwd'] = "<div class='success'>Đổi mật khẩu thành công!</div>";
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
					else
					{
						$_SESSION['change-pwd'] = "<div class='error'>Đổi mật khẩu thất bại! Vui lòng thử lại.</div>";
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
				}
				else
				{
					$_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu không khớp!</div>";
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
			else 
			{
				$_SESSION['user-not-found'] = "<div class='error'>Không tìm thấy người dùng!</div>";
				header('location:'.SITEURL.'admin/manage-admin.php');
				
			}
		}
		
	}
?>

<?php 	include('partials/footer.php'); ?>
