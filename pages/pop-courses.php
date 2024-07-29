<div class="section-area section-sp2 popular-courses-bx" id="pop">
    <div class="container">
        <div class="row">
            <div class="col-md-12 heading-bx left">
                <h2 class="title-head">Popular <span>Courses</span></h2>
                <p>Enroll in popular courses if you haven't got an idea about what skill to level up.
            </div>
            <div class="row">
                <div class="courses-carousel owl-carousel owl-btn-1 col-12 p-lr0">
                    <?php
                    $course_data = array();

                    $statement = $pdo->prepare("
                    SELECT course.*, category.id AS cat_id, category.name AS cat_name 
                    FROM course 
                    JOIN category ON course.cat_id = category.id 
                    ORDER BY course.views DESC 
                    LIMIT 5");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $course_data = array(); // Initialize empty array
                    
                    foreach ($result as $data) {
                        $course_data[] = $data; // Append each row to $course_data array
                    }

                    ?>

                    <div class="item">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="<?php
                                if ($course_data[0]['image']=='') {
                                    echo 'assets/images/courses/pic1.jpg';
                                }else{
                                    echo $course_data[0]['image'];
                                }
                                ?>" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a
                                        href="courses-details.php?c_id=<?php echo $course_data[0]['id']; ?>"><?php echo $course_data[0]['name']; ?></a>
                                </h5>
                                <span><?php echo $course_data[0]['cat_name']; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $course_data[0]['review']; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $rating = $course_data[0]['review']; // Assuming $course_data[0]['review'] holds the rating out of 5
                                        
                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="price">
                                <del><?php echo $currency; ?><?php if ($currency=='$') {$course_data[0]['price'] =  $course_data[0]['price']/300;} echo $course_data[0]['price'] + rand(30, 150); ?></del>
<h5><?php echo $currency; ?><?php echo $course_data[0]['price']; ?></h5>
                                </div><br /><br />
                            </div>
                        </div>
                        <span style="
                        margin-top: 1em;
                        padding: 0 1em;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        text-align: center;
                        ">
                            <i class="fa fa-eye"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[0]['views'] ?></i>
                            <i class="fa fa-user"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[0]['students'] ?></i>
                        </span>
                    </div>
                    <div class="item">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="<?php
                                if ($course_data[1]['image']=='') {
                                    echo 'assets/images/courses/pic1.jpg';
                                }else{
                                    echo $course_data[1]['image'];
                                }
                                ?>" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a
                                        href="courses-details.php?c_id=<?php echo $course_data[1]['id']; ?>"><?php echo $course_data[1]['name']; ?></a>
                                </h5>
                                <span><?php echo $course_data[1]['cat_name']; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $course_data[1]['review']; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $rating = $course_data[1]['review']; // Assuming $course_data[1]['review'] holds the rating out of 5
                                        
                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="price">
                                    <del><?php echo $currency; ?><?php if ($currency=='$') {$course_data[1]['price'] =  $course_data[1]['price']/300;} echo $course_data[1]['price'] + rand(30, 150); ?></del>
                                    <h5><?php echo $currency; ?><?php echo $course_data[1]['price']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <span style="
                        margin-top: 1em;
                        padding: 0 1em;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        text-align: center;
                        ">
                            <i class="fa fa-eye"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[1]['views'] ?></i>
                            <i class="fa fa-user"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[1]['students'] ?></i>
                        </span>
                    </div>
                    <div class="item">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="<?php
                                if ($course_data[2]['image']=='') {
                                    echo 'assets/images/courses/pic1.jpg';
                                }else{
                                    echo $course_data[2]['image'];
                                }
                                ?>" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a
                                        href="courses-details.php?c_id=<?php echo $course_data[2]['id']; ?>"><?php echo $course_data[2]['name']; ?></a>
                                </h5>
                                <span><?php echo $course_data[2]['cat_name']; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $course_data[2]['review']; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $rating = $course_data[2]['review']; // Assuming $course_data[2]['review'] holds the rating out of 5
                                        
                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="price">
                                <del><?php echo $currency; ?><?php if ($currency=='$') {$course_data[2]['price'] =  $course_data[2]['price']/300;} echo $course_data[2]['price'] + rand(30, 150); ?></del>

                                    <h5><?php echo $currency; ?><?php echo $course_data[2]['price']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <span style="
                        margin-top: 1em;
                        padding: 0 1em;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        text-align: center;
                        ">
                            <i class="fa fa-eye"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[2]['views'] ?></i>
                            <i class="fa fa-user"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[2]['students'] ?></i>
                        </span>
                    </div>
                    <div class="item">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="<?php
                                if ($course_data[3]['image']=='') {
                                    echo 'assets/images/courses/pic1.jpg';
                                }else{
                                    echo $course_data[3]['image'];
                                }
                                ?>" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a
                                        href="courses-details.php?c_id=<?php echo $course_data[3]['id']; ?>"><?php echo $course_data[3]['name']; ?></a>
                                </h5>
                                <span><?php echo $course_data[3]['cat_name']; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $course_data[3]['review']; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $rating = $course_data[3]['review']; // Assuming $course_data[3]['review'] holds the rating out of 5
                                        
                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="price">
                                <del><?php echo $currency; ?><?php if ($currency=='$') {$course_data[3]['price'] =  $course_data[3]['price']/300;} echo $course_data[3]['price'] + rand(30, 150); ?></del>
                                    <h5><?php echo $currency; ?><?php echo $course_data[3]['price']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <span style="
                        margin-top: 1em;
                        padding: 0 1em;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        text-align: center;
                        ">
                            <i class="fa fa-eye"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[3]['views'] ?></i>
                            <i class="fa fa-user"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[3]['students'] ?></i>
                        </span>
                    </div>
                    <div class="item">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="<?php
                                if ($course_data[4]['image']=='') {
                                    echo 'assets/images/courses/pic1.jpg';
                                }else{
                                    echo $course_data[4]['image'];
                                }
                                ?>" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a
                                        href="courses-details.php?c_id=<?php echo $course_data[4]['id']; ?>"><?php echo $course_data[4]['name']; ?></a>
                                </h5>
                                <span><?php echo $course_data[4]['cat_name']; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $course_data[4]['review']; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $rating = $course_data[4]['review']; // Assuming $course_data[4]['review'] holds the rating out of 5
                                        
                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="price">
                                <del><?php echo $currency; ?><?php if ($currency=='$') {$course_data[4]['price'] =  $course_data[4]['price']/300;} echo $course_data[4]['price'] + rand(30, 150); ?></del>
                                    <h5><?php echo $currency; ?><?php echo $course_data[4]['price']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <span style="
                        margin-top: 1em;
                        padding: 0 1em;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        text-align: center;
                        ">
                            <i class="fa fa-eye"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[4]['views'] ?></i>
                            <i class="fa fa-user"
                                style="font-size: 1rem;">&ensp;<?php echo $course_data[4]['students'] ?></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>