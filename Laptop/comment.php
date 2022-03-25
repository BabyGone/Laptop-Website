<?php include('partials-front/menu.php'); ?>
    
    <?php 
        if (isset($_GET['laptop_id'])) 
        {
            $laptop_id = $_GET['laptop_id'];

            $sql = "Select * from laptop where id=$laptop_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
               $row = mysqli_fetch_assoc($res);
               $title = $row['title'];
               $price = $row['price'];
               $image_name = $row['image_name'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
        
    ?>


    <section class="laptop-search">
        <div class="container">
            
            <h2 class="text-center">Thông tin bình luận</h2>

            <form action="" method="POST" class="comment">
                <fieldset>
                    <legend>Thông tin Laptop</legend>

                    <div class="laptop-menu-img">
                        <?php 
                            if ($image_name=="") 
                            {
                                echo "<div class='error'>Không có ảnh!</div>";
                            }
                            else
                            {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/laptop/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                                
                            }
                         ?>
                    </div>
    
                    <div class="laptop-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="laptop" value="<?php echo $laptop_id; ?>">                        
                        <p class="laptop-price"><?php echo $price; ?> ₫</p>                                                
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Thông tin bình luận</legend>

                    <?php 
                        $sql3 = "Select * from comment where laptop_id = $laptop_id";
                        $res3 = mysqli_query($conn, $sql3);
                        $count = mysqli_num_rows($res3);
                        if ($count>0) 
                        {
                            while($row=mysqli_fetch_assoc($res3))
                            {
                                $id = $row['id'];
                                $customer_name = $row['customer_name'];
                                $content = $row['content'];
                                ?>                                                                           
                                    <p><?php echo $customer_name; ?>: <?php echo $content; ?></p>
                                    <br>                                    
                                <?php
                            }
                        }   
                    ?>

                </fieldset>

                <fieldset>
                    <legend>Điền thông tin bình luận của bạn</legend>
                    <div class="comment-label text-white">Họ và tên</div>
                    <input type="text" name="customer_name" placeholder="" class="input-responsive" required>

                    <div class="comment-label text-white">Nội dung</div>
                    <textarea name="content" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                if (isset($_POST['submit'])) 
                {
                    $customer_name = $_POST['customer_name'];
                    $content = $_POST['content'];

                    $sql2 = "insert into comment set
                            customer_name = '$customer_name',
                            content = '$content',
                            laptop_id = $laptop_id
                            ";
                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2==true) 
                    {
                        $_SESSION['comment'] = "<div class='success text-center'>Đã thêm bình luận thành công!</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['comment'] = "<div class='error text-center'>Không thêm được bình luận! Vui lòng thử lại.</div>";
                        header('location:'.SITEURL);
                    }
                }
             ?>
        </div>
    </section>


    <?php include('partials-front/footer.php'); ?>