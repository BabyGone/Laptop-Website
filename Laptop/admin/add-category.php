<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Thêm thể loại</h1>
		<br><br>

		<?php  
			if (isset($_SESSION['add'])) 
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if (isset($_SESSION['upload'])) 
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Tên thể loại: </td>
					<td>
						<input type="text" name="title">
					</td>
				</tr>

				<tr>
					<td>Chọn ảnh: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Nổi bật: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Có
						<input type="radio" name="featured" value="No"> Không
					</td>
				</tr>

				<tr>
					<td>Tình trạng hoạt động: </td>
					<td>
						<input type="radio" name="active" value="Yes"> Có
						<input type="radio" name="active" value="No"> Không
					</td>
				</tr>

				<td colspan="2">
					<input type="submit" name="submit" value="Thêm thể loại" class="btn-secondary">
				</td>

			</table>
		</form>

		<?php 
			if (isset($_POST['submit'])) 
			{
				$title = $_POST['title'];

				if (isset($_POST['featured'])) 
				{
					$featured = $_POST['featured'];
				}
				else
				{
					$featured = "No";
				}

				if (isset($_POST['active'])) 
				{
					$active = $_POST['active'];
				}
				else
				{
					$active = "No";
				}

				// print_r($_FILES['image']);
				// die();
				if (isset($_FILES['image']['name'])) 
				{
					$image_name = $_FILES['image']['name'];

					$ext = end(explode('.', $image_name));
					$image_name= "Laptop_Category_".rand(000,999).'.'.$ext;

					$source_path = $_FILES['image']['tmp_name'];
					$destination_path = "../images/category/".$image_name;
					$upload = move_uploaded_file($source_path, $destination_path);

					if ($upload==false) 
					{
						$_SESSION['upload'] = "<div class='error'>Đăng ảnh thất bại! Vui lòng thử lại.</div>";
						header('location:'.SITEURL.'admin/add-category.php');
						die();
					}
				}
				else
				{
					$image_name="";
				}

				$sql = "insert into category set
					title='$title',
					image_name='$image_name',
					featured='$featured',
					active='$active'";

				$res = mysqli_query($conn, $sql);

				if ($res==true) 
				{
					$_SESSION['add'] = "<div class='success'>Thêm thể loại thành công!</div>";
					header("location:".SITEURL.'admin/manage-category.php');
				}
				else
				{
					$_SESSION['add'] = "<div class='error'>Thêm thể loại thất bại! Vui lòng thử lại.</div>";
					header("location:".SITEURL.'admin/add-category.php');
				}
			}
		?>
	</div>
</div>

<?php include('partials/footer.php'); ?>