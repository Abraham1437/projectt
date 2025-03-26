<?php include('partials-font/menu.php'); ?>
<section class="food-search text-center">
        <div class="container">
            
            <h2>Explore on Sweet <a href="#" class="text-white">"Categories"</a></h2>

        </div>
    </section>


 
    <!-- CAtegories Section Starts Here -->
    <section class="categories ">
        <div class="container">
            <h2 class="text-center"></h2>

            <?php
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count>-0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>

                        <?php

                    }

                }
                else
                {
                    echo "<div class='error'>Caregory Not update.</div>";
                }
            ?>


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-font/footer.php'); ?>