<?php
include('header.php');
include('pages/nav.php');
?>
  <body id="bg">
    <div class="page-wraper">
      <div id="loading-icon-bx"></div>
      <div class="page-content bg-white">
        <div class="content-block">
          <?php 
          include('pages/hero.php');
          include('pages/service.php');
          include('pages/pop-courses.php');
          include('pages/search-form.php');
          include('pages/upcoming-event.php');
          include('pages/testimonials.php');
          include('pages/recent-news.php');
          ?>
        </div>
      </div>
      <button class="back-to-top fa fa-chevron-up"></button>
    </div>

	<?php 
include('footer.php');
?>