<?php
include_once ('header.php');
include ('pages/nav.php');
?>
<style>
    .highlight {
        background-color: deeppink;
        font-weight: bold;
        padding: 0 .4em;
        border-radius: 5em;
    }

    ::selection {
        background-color: deeppink;
        color: #fff;
    }
</style>
<?php

// Sanitize the search input
$search_text = strip_tags($_GET['search'] ?? ''); // Strip tags for security, adjust as needed

// Split the search text by spaces into an array of keywords
$keywords = explode(' ', $search_text);

// Trim each keyword to remove extra spaces
$keywords = array_map('trim', $keywords);

// Remove any empty keywords (in case there are multiple spaces)
$keywords = array_filter($keywords);

// If there are no valid keywords after filtering, you may handle this case accordingly

// Prepare placeholders for binding in SQL query
$placeholders = array_fill(0, count($keywords), '%' . $search_text . '%');


// Build the WHERE clause for SQL query
$where_conditions = [];

foreach ($keywords as $index => $keyword) {
    $where_conditions[] = "(course.name LIKE :name{$index} OR course.short_description LIKE :short_description{$index})";
    $params[":name{$index}"] = "%{$keyword}%";
    $params[":short_description{$index}"] = "%{$keyword}%";
}

// Join the WHERE conditions with OR
$where_clause = implode(' OR ', $where_conditions);

// Adjust your existing SQL query with the dynamically created WHERE clause
$sql = "SELECT course.*, category.id AS cat_id, category.name AS cat_name 
        FROM course 
        JOIN category ON course.cat_id = category.id 
        WHERE {$where_clause}";

// Prepare the SQL statement
$statement = $pdo->prepare($sql);

// Bind parameters
foreach ($params as $param_name => $param_value) {
    $statement->bindValue($param_name, $param_value);
}

// Execute the query
$statement->execute();

// Fetch the results
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


// Process the result
$card_data = [];
foreach ($result as $row) {
    $id = $row['id'];
    $name = $row['name'];
    $short_name = $row['short_name'];
    $price = $row['price'];
    $cat_name = $row['cat_name'];
    $short_description = $row['short_description'];
    $review = $row['review'];
    

    $row_data = array(
        'id' => $id,
        'name' => $name,
        'short_name' => $short_name,
        'price' => $price,
        'cat_name' => $cat_name,
        'short_description' => $short_description,
        'review' => $review,
    );
    $card_data[] = $row_data;
}
?>
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
                            <form class="form-group" method="get">
                                <div class="input-group">
                                    <label>Search Courses</label>
                                    <input name="search" type="text" required class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="widget widget_archive">
                            <h5 class="widget-title style-1">All Courses</h5>
                            <ul>
                                <li class="active"><a href="#">General</a></li>
                                <li><a href="#">IT & Software</a></li>
                                <li><a href="#">Photography</a></li>
                                <li><a href="#">Programming Language</a></li>
                                <li><a href="#">Technology</a></li>
                            </ul>
                        </div>
                        <div class="widget">
                            <a href="#"><img src="assets/images/adv/adv.jpg" alt="" /></a>
                        </div>
                        <div class="widget recent-posts-entry widget-courses">
                            <h5 class="widget-title style-1">Recent Courses</h5>
                            <?php
                            $statement = $pdo->prepare('SELECT id, name, price, review 
                            FROM course
                            ORDER BY id desc
                            LIMIT 2');
                            $statement->execute();
                            $result = $statement->fetchAll();
                            ?>
                            <div class="widget-post-bx">
                                <div class="widget-post clearfix">
                                    <div class="ttr-post-media"> <img src="assets/images/blog/recent-blog/pic1.jpg"
                                            width="200" height="143" alt=""> </div>
                                    <div class="ttr-post-info">
                                        <div class="ttr-post-header">
                                            <h6 class="post-title"><a href="courses-details.php?c_id=<?php echo $result[0]['id']; ?>"><?php echo $result[0]['name']; ?></a></h6>
                                        </div>
                                        <div class="ttr-post-meta">
                                            <ul>
                                                <li class="price">
                                                    <del><?php echo $currency ?><?php echo $result[0]['price']+100; ?></del>
                                                    <h5><?php echo $currency ?><?php echo $result[0]['price']; ?></h5>
                                                </li>
                                                <li class="review"><?php echo $result[0]['review']; ?> Review</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="ttr-post-media"> <img src="assets/images/blog/recent-blog/pic3.jpg"
                                            width="200" height="160" alt=""> </div>
                                    <div class="ttr-post-info">
                                        <div class="ttr-post-header">
                                        <h6 class="post-title"><a href="courses-details.php?c_id=<?php echo $result[0]['id']; ?>"><?php echo $result[0]['name']; ?></a></h6>
                                        </div>
                                        <div class="ttr-post-meta">
                                        <ul>
                                                <li class="price">
                                                    <del><?php echo $currency ?><?php echo $result[0]['price']+100; ?></del>
                                                    <h5><?php echo $currency ?><?php echo $result[0]['price']; ?></h5>
                                                </li>
                                                <li class="review"><?php echo $result[0]['review']; ?> Review</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="row"></div>
                        <!-- Display the results -->
                        <?php if (!empty($card_data)): ?>
                            <?php foreach ($card_data as $data): ?>
                                <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                                    <div class="cours-bx">
                                        <div class="action-box">
                                            <img src="assets/images/courses/pic1.jpg" alt="">
                                            <a href="courses-details.php?c_id=<?php echo $id; ?>" class="btn">Read More</a>
                                        </div>
                                        <div class="info-bx text-center">
                                            <h5><a href="courses-details.php?c_id=<?php echo $id; ?>"><?php
                                               // echo $name; 
                                               $highlighted_title = preg_replace('/(' . preg_quote($search_text, '/') . ')/i', '<span class="highlight">$1</span>', $name);
                                               echo $highlighted_title;
                                               ?></a></h5>
                                            <span><?php echo $cat_name; ?></span>
                                        </div>
                                        <div class="description" style="text-align: center; margin: 1em;">

                                            <?php
                                            // echo $short_description; 
                                            $highlighted_description = preg_replace('/(' . preg_quote($search_text, '/') . ')/i', '<span class="highlight">$1</span>', $short_description);
                                            echo $highlighted_description;
                                            ?>
                                        </div>
                                        <div class="cours-more-info">
                                            <div class="review">
                                                <span><?php echo $review; ?> Review</span>
                                                <ul class="cours-star">
                                                    <?php
                                                    $rating = $review;
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
                                                <del><?php echo $currency; ?><?php echo $price + 100; ?></del>
                                                <h5><?php echo $currency; ?><?php echo $price; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No results found.</p>
                        <?php endif; ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<?php include_once ('footer.php'); ?>