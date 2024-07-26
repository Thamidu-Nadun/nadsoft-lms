<?php
include ('header.php');
include ('pages/nav.php');
?>
<?php
if (isset($_GET['user_prefer_category'])){
	$user_prefer_category = $_GET['user_prefer_category'];
}else{
	$user_prefer_category = '';
}

?>
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner3.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Our Courses</h1>
            </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="#">Home</a></li>
                <li>Our Courses</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                        <div class="widget courses-search-bx placeani">
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Search Courses</label>
                                    <input name="dzName" type="text" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="widget widget_archive">
                            <h5 class="widget-title style-1">All Courses</h5>
                            <ul>
								<li class="active"><a href="courses.php?user_prefer_category=">All</a></li>
								<?php
								
								$statement = $pdo->prepare("SELECT id, name FROM category;");
								$statement->execute();
								$result = $statement->fetchAll();
								foreach ($result as $row) {
									$id = $row['id'];
									$name = $row['name'];?>
									<li><a href="courses.php?user_prefer_category=<?php echo $id; ?>"><?php echo $name; ?></a></li>
									<?php
								}
								?>
                            </ul>
                        </div>
                        <div class="widget">
                            <a href="#"><img src="assets/images/adv/adv.jpg" alt="" /></a>
                        </div>
                        <div class="widget recent-posts-entry widget-courses">
                            <h5 class="widget-title style-1">Recent Courses</h5>
                            <div class="widget-post-bx">
                                <div class="widget-post clearfix">
                                    <div class="ttr-post-media"> <img src="assets/images/blog/recent-blog/pic1.jpg"
                                            width="200" height="143" alt=""> </div>
                                    <div class="ttr-post-info">
                                        <div class="ttr-post-header">
                                            <h6 class="post-title"><a href="#">Introduction EduChamp</a></h6>
                                        </div>
                                        <div class="ttr-post-meta">
                                            <ul>
                                                <li class="price">
                                                    <del>$190</del>
                                                    <h5>$120</h5>
                                                </li>
                                                <li class="review">03 Review</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="ttr-post-media"> <img src="assets/images/blog/recent-blog/pic3.jpg"
                                            width="200" height="160" alt=""> </div>
                                    <div class="ttr-post-info">
                                        <div class="ttr-post-header">
                                            <h6 class="post-title"><a href="#">English For Tommorow</a></h6>
                                        </div>
                                        <div class="ttr-post-meta">
                                            <ul>
                                                <li class="price">
                                                    <h5 class="free">Free</h5>
                                                </li>
                                                <li class="review">07 Review</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
    <div class="row">
        <?php
		if ($user_prefer_category!='') {
			$statement = $pdo->prepare("
            SELECT course.*, category.name AS category_name
            FROM course
            LEFT JOIN category ON course.cat_id = category.id
			WHERE course.cat_id = :cat_id
        ");
			$statement->bindParam(':cat_id', $user_prefer_category);
        	$statement->execute();
        	$result = $statement->fetchAll();
		}else{
			$statement = $pdo->prepare("
            SELECT course.*, category.name AS category_name
            FROM course
            LEFT JOIN category ON course.cat_id = category.id
        ");
        $statement->execute();
        $result = $statement->fetchAll();
		}

		if (count($result) > 0) {
			foreach ($result as $row) {
				$id = $row['id'];
				$name = $row['name'];
				$price = $row['price'];
				$review_data_json = $row['review_data'];
				$review_data = json_decode($review_data_json, true); // Decode JSON data

				// Extract individual reviews (assuming you still need this)
				$one = isset($review_data['1']) ? intval($review_data['1']) : 0;
				$two = isset($review_data['2']) ? intval($review_data['2']) : 0;
				$three = isset($review_data['3']) ? intval($review_data['3']) : 0;
				$four = isset($review_data['4']) ? intval($review_data['4']) : 0;
				$five = isset($review_data['5']) ? intval($review_data['5']) : 0;

				// Find maximum review score (assuming you still need this)
				$max_review = max($one, $two, $three, $four, $five);

				// Calculate the average rating (assuming you still need this)
				$total_reviews = count($review_data);
				$average_rating = $total_reviews > 0 ? (array_sum($review_data) / $total_reviews) : 0;

				$category_name = $row['category_name']; // Category name from category table
			
			
            ?>
            <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                <div class="cours-bx">
                    <div class="action-box">
                        <img src="assets/images/courses/pic1.jpg?>" alt="<?php echo $name; ?>">
                        <a href="<?php echo $id; ?>" class="btn">Read More</a>
                    </div>
                    <div class="info-bx text-center">
                        <h5><a href="course-details.php?id=<?php echo $id; ?>"><?php echo $name; ?></a></h5>
                        <span><?php echo $category_name; ?></span> <!-- Display category name -->
                    </div>
                    <div class="cours-more-info">
                        <div class="review">
                            <span><?php echo $total_reviews; ?> Reviews</span>
                            <ul class="cours-star">
                                <?php
                                // Display stars based on average rating
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $average_rating) {
                                        echo '<li class="active"><i class="fa fa-star"></i></li>';
                                    } else {
                                        echo '<li><i class="fa fa-star"></i></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="price">
                            <del><?php echo $currency; ?><?php echo $price + 100; ?></del>
                            <h5><?php echo $currency; ?><?php echo $price; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
	}else{
		echo '<h3 style="margin: 0 auto;">No Data Available!</h3>';
	}
        ?>
    </div>
</div>


                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->

</div>
<!-- Content END-->
<?php
	include('footer.php');
	?>