<style>
    @media screen and (max-width: 400px) {
        #event{
            display: none;
        }
    }
</style>
<div class="section-area section-sp2" id="event">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center heading-bx">
                <h2 class="title-head m-b0">Upcoming <span>Events</span></h2>
                <p class="m-b0">Upcoming Education Events To Feed Brain. </p>
            </div>
        </div>
        <div class="row">
            <div class="upcoming-event-carousel owl-carousel owl-btn-center-lr owl-btn-1 col-12 p-lr0  m-b30">
                <?php
                $today_date= date('Y-m-d');
                $statement = $pdo->prepare("SELECT * FROM event WHERE date>:Date");
                $statement->bindValue(':Date',$today_date);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach ($result as $row) {
                    $event_id = $row['id'];
                    $event_name = $row['name'];
                    $event_short_description = $row['short_description'];
                    $image_url = $row['image'];
                    $date = $row['date'];
                    $start_time = $row['start_time'];
                    $end_time = $row['end_time'];
                    $event_location = $row['location'];

                    ?>
                    <div class="item">
                        <div class="event-bx">
                            <div class="action-box event_img">
                                <img src="<?php echo $image_url; ?>" alt="">
                            </div>
                            <div class="info-bx d-flex">
                                <div>
                                    <div class="event-time">
                                        <div class="event-date">2</div>
                                        <div class="event-month">October</div>
                                    </div>
                                </div>
                                <div class="event-info">
                                    <h4 class="event-title"><a href="events-details.php?id=<?php echo $event_id; ?>"><?php echo $event_name; ?></a></h4>
                                    <ul class="media-post">
                                        <li><a href="#"><i class="fa fa-clock-o"></i> <?php echo $start_time; ?>
                                                <?php echo $end_time; ?></a></li>
                                        <li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $event_location; ?></a>
                                        </li>
                                    </ul>
                                    <p><?php echo $event_short_description; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
        <div class="text-center">
            <a href="event.php" class="btn">View All Event</a>
        </div>
    </div>
</div>