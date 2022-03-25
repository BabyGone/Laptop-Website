<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Thêm sản phẩm</h1>

		<br><br>
		<?php 
			if (isset($_SESSION['upload'])) 
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		 ?>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Tên laptop: </td>
					<td>
						<input type="text" name="title">
					</td>
				</tr>

				<tr>
					<td>Mô tả: </td>
					<td>
						<textarea name="description" cols="30" rows="5"></textarea>
					</td>
				</tr>

				<tr>
					<td>Giá: </td>
					<td>
						<input type="num" name="price">
					</td>
				</tr>

				<tr>
					<td>Hình ảnh: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Thêm" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 

			if (isset($_POST['submit'])) 
			{
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$image=$_POST['image'];

				if(isset($_FILES['image']['name']))
				{
					$image_name = $_FILES['image']['name'];
					if($image_name!="")
					{
						$ext = end(explode('.', $image_name));
						$image_name = "Laptop-Name-".rand(0000,9999).".".$ext;
						$src = $_FILES['image']['tmp_name'];
						$dst = "../images/laptop/".$image_name;
						$upload = move_uploaded_file($src, $dst);
						if ($upload==false) 
						{
							$_SESSION['upload'] = "<div class='error'>Không đăng ảnh được!</div>";
							header('location:'.SITEURL.'admin/add-laptop.php');
							die();
						}
					}
				}
				else
				{
					$image_name = "";
				}

				$sql2 = "insert into laptop set
					title = '$title',
					description = '$description',
					price = $price,
					image_name = '$image_name'";
				$res2 = mysqli_query($conn, $sql2);
				if ($res2==true) 
				{
					$_SESSION['add'] = "<div class='success'>Thêm thành công!</div>";
					header('location:'.SITEURL.'admin/manage-laptop.php');
				}
				else
				{
					$_SESSION['add'] = "<div class='error'>Không thêm được!</div>";
					header('location:'.SITEURL.'admin/manage-laptop.php');
				}
			}

		 ?>
	</div>
</div>

<?php include('partials/footer.php'); ?>