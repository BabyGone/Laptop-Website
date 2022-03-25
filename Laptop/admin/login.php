<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập Admin - Best Laptop</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center">Đăng nhập</h1>
		<br><br>

		<?php 
			if (isset($_SESSION['login'])) 
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}

			if (isset($_SESSION['no-login-message'])) 
			{
				echo $_SESSION['no-login-message'];
				unset($_SESSION['no-login-message']);
			}
		?>

		 <br><br>
		<form action="" method="POST" class="text-center">
			Username: <br>
			<input type="text" name="username" placeholder="Nhập Username"><br><br>
			Mật khẩu: <br>
			<input type="password" name="password" placeholder="Nhập mật khẩu"><br><br>
			<input type="submit" name="submit" value="Đăng nhập" class="btn-primary">
			<br><br>
		</form>
		<p class="text-center">2022 All rights reserved, Best Laptop. Developed by Nhom 17 - 61TH5.</p>
	</div>
</body>
</html>

<?php 
	if (isset($_POST['submit'])) 
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "select * from admin where username='$username' and password='$password'";

		$res = mysqli_query($conn, $sql);

		$count = mysqli_num_rows($res);

		if ($count==1) 
		{
			$_SESSION['login'] = "<div class='success'>Đăng nhập thành công!</div>";
			$_SESSION['user'] = $username;
			header('location:'.SITEURL.'admin/manage-admin.php');
		}
		else
		{
			$_SESSION['login'] = "<div class='error text-center'>Đăng nhập thất bại! Vui lòng thử lại.</div>";
			header('location:'.SITEURL.'admin/login.php');
		}
	}
 ?>