<div id="testimonials" class="section-area section-sp2 bg-fix ovbl-dark" style="background-image:url(assets/images/background/bg1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-white heading-bx left">
                <h2 class="title-head text-uppercase">what people <span>say</span></h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
            </div>
        </div>

        <div class="testimonial-carousel owl-carousel owl-btn-1 col-12 p-lr0">
            <?php
            try {
                $statement = $pdo->prepare("SELECT * FROM testimonials;");
                $statement->execute();
                $result = $statement->fetchAll();

                foreach ($result as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $occupation = $row['occupation'];
                    $message = $row['message'];
                    $image_url = $row['image'];
                    ?>
                    <div class="item">
                        <div class="testimonial-bx">
                            <div class="testimonial-thumb">
                                <img src="<?php echo $image_url; ?>" alt="">
                            </div>
                            <div class="testimonial-info">
                                <h5 class="name"><?php echo $name; ?></h5>
                                <p>-<?php echo $occupation; ?></p>
                            </div>
                            <div class="testimonial-content">
                                <p><?php echo $message; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }catch(Exception){
                echo 'Something went wrong!';
            } ?>
            <!-- <div class="item">
                <div class="testimonial-bx">
                    <div class="testimonial-thumb">
                        <img src="assets/images/testimonials/pic2.jpg" alt="">
                    </div>
                    <div class="testimonial-info">
                        <h5 class="name">Peter Packer</h5>
                        <p>-Art Director</p>
                    </div>
                    <div class="testimonial-content">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type...</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>