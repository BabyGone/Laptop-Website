<?php include('partials/menu.php'); ?>

<?php 
	if (isset($_GET['id'])) 
	{
		$id = $_GET['id'];
		$sql2 = "select * from laptop where id=$id";
		$res2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_assoc($res2);

		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['image_name'];
	}
	else
	{
		header('location:'.SITEURL.'admin/manage-laptop.php');
	}
 ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Cập nhật thông tin Laptop</h1>
		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Tên laptop: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Mô tả: </td>
					<td>
						<textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>Giá: </td>
					<td>
						<input type="num" name="price" value="<?php echo $price; ?>">
					</td>
				</tr>

				<tr>
					<td>Hình ảnh hiện tại: </td>
					<td>
						<?php 
							if ($current_image == "") 
							{
								
							}
							else
							{
								?>
									<img src="<?php echo SITEURL; ?>images/laptop/<?php echo $current_image; ?>" width="150px">
								<?php
							}
						 ?>
					</td>
				</tr>

				<tr>
					<td>Ảnh mới: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 
			if (isset($_POST['submit'])) 
			{
				$id = $_POST['id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$current_image = $_POST['current_image'];
				
				if (isset($_FILES['image']['name'])) 
				{
					$image_name = $_FILES['image']['name'];
					if ($image_name!="") 
					{
						$ext = end(explode('.', $image_name));
						$image_name = "Laptop-Name-".rand(0000,9999).".".$ext;
						$src_path = $_FILES['image']['tmp_name'];
						$dest_path = "../images/laptop/".$image_name;
						$upload = move_uploaded_file($src_path, $dest_path);

						if ($upload==false) 
						{
							$_SESSION['upload'] = "<div class='error'>Không đăng ảnh được!</div>";
							header('location:'.SITEURL.'admin/manage-laptop.php');
							die();
						}

						if ($current_image!="") 
						{
							$remove_path = "../images/laptop/".$current_image;
							$remove = unlink($remove_path);

							if ($remove==false) 
							{
								$_SESSION['remove-failed'] = "<div class='error'>Không xóa được ảnh cũ!</div>";
								header('location:'.SITEURL.'admin/manage-laptop.php');
								die();
							}
						}
					}
					else
					{
						$image_name = $current_image;
					}
				}
				else
				{
					$image_name = $current_image;
				}

				$sql3 = "update laptop set 
					title='$title',
					description='$description',
					price=$price,
					image_name='$image_name'
					where id=$id";
				$res3 = mysqli_query($conn, $sql3);
				if ($res3==true) 
				{
				 	$_SESSION['update'] = "<div class='success'>Cập nhật thông tin thành công!</div>";
				 	header('location:'.SITEURL.'admin/manage-laptop.php');
				}
				else
				{
					$_SESSION['update'] = "<div class='error'>Cập nhật thông tin thất bại!</div>";
				 	header('location:'.SITEURL.'admin/manage-laptop.php');
				} 
			}
		 ?>

	</div>
</div>

<?php include('partials/footer.php'); ?>