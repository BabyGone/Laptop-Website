<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Quản lý bình luận</h1>
			<br /><br /><br />

			<?php 
				if (isset($_SESSION['delete-comment'])) 
				{
					echo $_SESSION['delete-comment'];
					unset($_SESSION['delete-comment']);
				}
			 ?>
			
			<br /><br /><br />
			<table class="tbl-full">
				<tr>
					<th>STT</th>
					<th>Họ và tên</th>
					<th>Nội dung</th>
					<th>Laptop</th>
					<th>Ảnh</th>
					<th>Hành động</th>
				</tr>

				<?php 
					$sql = "select comment.id,comment.customer_name,comment.content, laptop.title, laptop.image_name 
					from comment,laptop 
					where comment.laptop_id=laptop.id 
					order by comment.laptop_id";
					$res = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($res);
					$sn=1;
					if($count>0)
					{
						while($row=mysqli_fetch_assoc($res))
						{	
							$id = $row['id'];					
							$customer_name = $row['customer_name'];
							$content = $row['content'];
							$image_name = $row['image_name'];
							$title = $row['title'];

							?>
								<tr>
									<td><?php echo $sn++ ?></td>
									<td><?php echo $customer_name; ?></td>
									<td><?php echo $content; ?></td>
									<td><?php echo $title; ?></td>
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
										<a href="<?php echo SITEURL; ?>admin/delete-comment.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
									</td>
								</tr>
							<?php
						}
					}
					else
					{
						echo "<tr><td colspan='12' class='error'>Không có bình luận!</td></tr>";
					}
				 ?>


			</table>
		</div>
	</div>

<?php include('partials/footer.php'); ?>