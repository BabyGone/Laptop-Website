<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Cập nhật Admin</h1>
		<br><br>

		<?php 
			$id=$_GET['id'];
			$sql="select * from admin where id='$id'";
			$res=mysqli_query($conn, $sql);

			if ($res==true) {

				$count = mysqli_num_rows($res);

				if ($count==1) {
					$row=mysqli_fetch_assoc($res);

					$full_name= $row['full_name'];
					$username= $row['username'];
				}

				else{
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
		 ?>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Họ và tên: </td>
					<td>
						<input type="text" name="full_name" value="<?php echo $full_name; ?>">
					</td>
				</tr>

				<tr>
					<td>Username: </td>
					<td>
						<input type="text" name="username" value="<?php echo $username; ?>">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>
	</div>
</div>

<?php 
	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
	

		$sql = "update admin set full_name = '$full_name', 
								 username = '$username' 
								 where id = '$id'";

		$res = mysqli_query($conn, $sql);

		if ($res==true) {
			$_SESSION['update'] = "<div class='success'>Cập nhật Admin thành công!</div>";
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
		else{
			$_SESSION['update'] = "<div class='error'>Cập nhật Admin không thành công! Vui lòng thử lại.</div>";
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
	}
 ?>

<?php include('partials/footer.php'); ?>