<?php include('partials-front/menu.php'); ?>

    <!-- laptop sEARCH Section Starts Here -->
    <section class="laptop-search text-center">
        <div class="container">
            <?php 
                $search = $_POST['search'];
             ?>

            <h2>Bạn đang tìm kiếm <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- laptop sEARCH Section Ends Here -->



    <!-- laptop MEnu Section Starts Here -->
    <section class="laptop-menu">
        <div class="container">
            <h2 class="text-center">Danh sách Laptop</h2>

            <?php 
                
                $sql = "select * from laptop where title like '%$search%' or description like '%$search%'";
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
                    echo "<div class='error'>Không tìm thấy Laptop!</div>";
                }
             ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- laptop Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>