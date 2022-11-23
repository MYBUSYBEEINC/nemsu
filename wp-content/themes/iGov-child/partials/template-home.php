<?php //Template Name: Home ?>
<?php get_header(); ?>

	<style>
		.sidenav {
			display:none;
		}
		.site-main {
			margin-left: unset;
			padding: unset;
		}
		.white,
		.welcome.white h2 {
			background: #385fe5;
			color:#fff;
		}
		.notifications i {
			background: #385fe5;
		}
	</style>

		
	<div class="site-content">
		<div class="homepage-wrapper">
			<div class="homepage-container">
				<div class="student-menu homepage">
				<ul>
					<li>
						<a class="single-block" href="#">
						<i class="fas fa-bars"></i>
						<h3>Dashboard</h3>
						</a>
					</li>
					<li>
						<a class="single-block" href="<?php echo site_url().'/students/'; ?>">
						<i class="fas fa-user-graduate"></i>
						<h3>Students</h3>
						</a>
						
					</li>
					<li>
						<a class="single-block" href="<?php echo site_url().'/enrollment/'; ?>">
						<i class="fas fa-file-signature"></i>
						<h3>Enrollment</h3>
						</a>
						
					</li>
					<li>
						<a class="single-block" href="<?php echo site_url().'/course-schedule-proposal/'; ?>">
						<i class="fas fa-calendar-alt"></i>
						<h3>Course Scheduling</h3>
						</a>
						
					</li>
					<li>
						<a class="single-block" href="<?php echo site_url().'/finance-dashboard/'; ?>">
						<i class="fas fa-money-bill"></i>
						<h3>Finance</h3>
						</a>
						
					</li>
					<li>
						<a class="single-block" href="#">
						<i class="fas fa-signal"></i>
						<h3>Reports</h3>
						</a>
						
					</li>
					<li>
						<a class="single-block" href="<?php echo site_url().'/system/'; ?>">
						<i class="fas fa-cogs"></i>
						<h3>System</h3>
						</a>
						
					</li>
				</ul>
				</div>
			</div>
		</div>
	
	</div>		

</div><!-- #primary -->

<?php get_footer(); ?>


<!-- Owl Stylesheets -->


<!-- vendors -->
    
