<div class="ttr-sidebar">
	<div class="ttr-sidebar-wrapper content-scroll">
		<!-- side menu logo start -->
		<div class="ttr-sidebar-logo">
			<a href="index.php">
				<!-- <img alt="" src="assets/images/logo.png" width="80" height="10"> -->
				<span>Student Panel</span>
			</a>
			<!-- <div class="ttr-sidebar-pin-button" title="Pin/Unpin Menu">
					<i class="material-icons ttr-fixed-icon">gps_fixed</i>
					<i class="material-icons ttr-not-fixed-icon">gps_not_fixed</i>
				</div> -->
			<div class="ttr-sidebar-toggle-button">
				<i class="ti-arrow-left"></i>
			</div>
		</div>
		<!-- side menu logo end -->
		<!-- sidebar menu start -->
		<nav class="ttr-sidebar-navi">
			<ul>
				<li>
					<a href="index.php" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-home"></i></span>
						<span class="ttr-label">Dashboard</span>
					</a>
				</li>
				<li>
					<a href="courses.php" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-book"></i></span>
						<span class="ttr-label">Courses</span>
					</a>
				</li>
				<li>
					<a href="online-class.php" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-book"></i></span>
						<span class="ttr-label">Online Classes</span>
					</a>
				</li>
				<li>
					<a href="" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-book"></i></span>
						<span class="ttr-label"><span class="beta">Quizzes</span></span>
						<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
					</a>
					<ul>
						<li>
							<a href="quiz.php" class="ttr-material-button"><span class="ttr-label">Quizzes</span></a>
						</li>
						<li>
							<a href="my-quiz.php" class="ttr-material-button"><span
									class="ttr-label">My Quizzes</span></a>
						</li>
					</ul>
				</li>
				<li>
					<a href="" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-book"></i></span>
						<span class="ttr-label"><span class="alpha">Assessments</span></span>
						<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
					</a>
					<ul>
						<li>
							<a href="my-assessment.php" class="ttr-material-button"><span class="ttr-label">My
									Assessments</span></a>
						</li>
						<li>
							<a href="mailbox-compose.php" class="ttr-material-button"><span
									class="ttr-label">Submit Assignment</span></a>
						</li>
					</ul>
				</li>
				<li>
					<a href="" class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-email"></i></span>
						<span class="ttr-label">Mailbox</span>
						<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
					</a>
					<ul>
						<li>
							<a href="mailbox.php" class="ttr-material-button"><span class="ttr-label">Mail
									Box</span></a>
						</li>
						<li>
							<a href="mailbox-compose.php" class="ttr-material-button"><span
									class="ttr-label">Compose</span></a>
						</li>
						<li>
							<a href="mailbox-read.php" class="ttr-material-button"><span class="ttr-label">Mail
									Read</span></a>
						</li>
					</ul>
				</li>
				<li>
					<a class="ttr-material-button">
						<span class="ttr-icon"><i class="ti-user"></i></span>
						<span class="ttr-label">My Profile</span>
						<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
					</a>
					<ul>
						<li>
							<a href="profile.php" class="ttr-material-button"><span class="ttr-label">User
									Profile</span></a>
						</li>
						<li>
							<a href="change-password.php" class="ttr-material-button"><span
									class="ttr-label beta disable" disabled>Edit Password</span></a>
						</li>
					</ul>
				</li>
				<li class="ttr-seperate"></li>
			</ul>
			<!-- sidebar menu end -->
		</nav>
		<!-- sidebar menu end -->
	</div>
</div>

<script>
	var disableLink = document.querySelector('.disable');
	if (disableLink) {
		disableLink.addEventListener('click', function (event) {
			event.preventDefault(); // Prevent the default link behavior

			// Create a tooltip
			var tooltip = document.createElement('span');
			tooltip.textContent = "The link is disabled. (To gain access to the most recent features, you must first join the beta program.)";
			tooltip.style.position = 'absolute';
			tooltip.style.backgroundColor = '#333';
			tooltip.style.color = '#fff';
			tooltip.style.padding = '5px 10px';
			tooltip.style.borderRadius = '5px';
			tooltip.style.zIndex = '1000';

			// Position the tooltip
			var rect = disableLink.getBoundingClientRect();
			tooltip.style.left = rect.left + window.scrollX + 'px';
			tooltip.style.top = rect.bottom + window.scrollY + 'px';

			document.body.appendChild(tooltip);

			// Remove the tooltip after a few seconds
			setTimeout(function () {
				tooltip.remove();
			}, 2000);
		});
	}
</script>