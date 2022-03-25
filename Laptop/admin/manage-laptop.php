<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Quản lý Sản Phẩm</h1>
			<br /><br /><br />

			<a href="<?php echo SITEURL; ?>admin/add-laptop.php" class="btn-primary">Thêm Sản Phẩm</a>
			
			<br /><br /><br />
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

				if (isset($_SESSION['update'])) 
				{
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}
			 ?>
			<table class="tbl-full">
				<tr>
					<th>STT</th>
					<th>Tên laptop</th>
					<th>Giá</th>
					<th>Ảnh</th>
					<th>Hành động</th>
				</tr>
				<?php 
					$sql = "select * from laptop";

					$res = mysqli_query($conn, $sql);

					$count = mysqli_num_rows($res);
					$sn=1;
					if($count>0)
					{
						while ($row=mysqli_fetch_assoc($res)) 
						{
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $price; ?>₫</td>
									<td>
										<?php 
											if($image_name=="")
											{
												echo "<div class='error'>Không có ảnh</div>";
											}
											else
											{
												?>
													<img src="<?php echo SITEURL; ?>images/laptop/<?php echo $image_name; ?>" width="100px">
												<?php
											}
										 ?>
									</td>

									<td>
										<a href="<?php echo SITEURL; ?>admin/update-laptop.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
										
									</td>
								</tr>
							<?php
						}
					}
					else
					{
						echo "<tr> <td colspan='7' class='error'>Laptop chưa được thêm! </td> </tr>";
					}
				 ?>
				

			</table>
		</div>
	</div>

<?php include('partials/footer.php'); ?>