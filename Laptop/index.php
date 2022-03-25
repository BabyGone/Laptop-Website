<?php include('partials-front/menu.php'); ?>

    <!-- laptop sEARCH Section Starts Here -->
    <section class="laptop-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>laptop-search.php" method="POST">
                <input type="search" name="search" placeholder="Tìm kiếm..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- laptop sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['comment']))
        {
            echo $_SESSION['comment'];
            unset($_SESSION['comment']);
        }
     ?>

    <!-- laptop MEnu Section Starts Here -->
    <section class="laptop-menu">
        <div class="container">
            <h2 class="text-center">Sản phẩm của chúng tôi</h2>

            <?php 
                $sql = "select * from laptop limit 2";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count>0) 
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];                       
                        $image_name = $row['image_name'];
                        ?>
                            <div class="laptop-menu-box">
                                <div class="laptop-menu-img">
                                    <?php 
                                        if ($image_name=="") 
                                        {
                                            echo "<div class='error'>Hình ảnh không có sẵn!</div>";
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
                                    <h4><?php echo $title; ?></h4>
                                    <p class="laptop-price"><?php echo $price; ?> ₫</p>
                                    <p class="laptop-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>comment.php?laptop_id=<?php echo $id; ?>" class="btn btn-primary">Bình luận</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Không tìm thấy sản phẩm!</div>";
                }
             ?>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>laptop.php">Xem tất cả sản phẩm</a>
        </p>
    </section>
    <!-- laptop Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
