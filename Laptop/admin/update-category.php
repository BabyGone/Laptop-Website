<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Cập nhật thể loại</h1>

		<br><br>

		<?php 
			if (isset($_GET['id'])) 
			{
				$id = $_GET['id'];
				$sql = "select * from category where id=$id";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				if ($count==1) 
				{
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];
				}
				else
				{
					$_SESSION['no-category-found'] = "<div class='error'>Không tìm thấy thể loại!</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
			}
			else
			{
				header('location:'.SITEURL.'admin/manage-category.php');
			}
		 ?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Tên thể loại: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Ảnh hiện tại: </td>
					<td>
						<?php 
							if ($current_image != "") 
							{
								?>
									<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">	
								<?php					
							}
							else
							{

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
					<td>Nổi bật: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
						<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Tình trạng hoạt động: </td>
					<td>
						<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

						<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td>
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
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
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				if (isset($_FILES['image']['name'])) 
				{
					$image_name = $_FILES['image']['name'];
					if ($image_name != "") 
					{
						$ext = end(explode('.', $image_name));
						$image_name= "Laptop_Category_".rand(000,999).'.'.$ext;

						$source_path = $_FILES['image']['tmp_name'];
						$destination_path = "../images/category/".$image_name;
						$upload = move_uploaded_file($source_path, $destination_path);

						if ($upload==false) 
						{
							$_SESSION['upload'] = "<div class='error'>Đăng ảnh thất bại!</div>";
							header('location:'.SITEURL.'admin/manage-category.php');
							die();
						}

						if ($current_image !="") 
						{
							$remove_path = "../images/category/".$current_image;
							$remove = unlink($remove_path);

							if ($remove==false) 
							{
								$_SESSION['failed-remove'] = "<div class='error'>Không xóa được ảnh hiện tại!</div>";
								header('location:'.SITEURL.'admin/manage-category.php');
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

				$sql2 = "update category set
				title = '$title',
				image_name = '$image_name',
				featured = '$featured',
				active = '$active'
				where id=$id";

				$res2 = mysqli_query($conn, $sql2);

				if ($res2==true) 
				{
					$_SESSION['update'] = "<div class='success'>Cập nhật thể loại thành công!</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
				else
				{
					$_SESSION['update'] = "<div class='error'>Không cập nhật được thể loại! Vui lòng thử lại.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
			}
		 ?>
	</div>
</div>

<?php include('partials/footer.php'); ?>