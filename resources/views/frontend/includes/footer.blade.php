<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="ftr_box frst">
				<!-- Header Logo -->
         <div class="ftr_logo">
         <img src="{{ asset(businessSetting(1)->footer_logo) }}" alt="Logo">
         </div>
                <span>Visitors {{ $uniqueVisitors = DB::table('visitors')->count() }}</span>
					<p>Add:  {{ businessSetting(1)->address }}</p>
					<p>Call: {{ businessSetting(1)->contact_numbers }}</p>
					<p> Email: {{ businessSetting(1)->email }}</p>


				</div>
			</div>
			<div class="col-md-3">
				<div class="ftr_box">
					<h4>Online Platform</h4>
					<ul>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
						<li><a href="#">Instructor</a></li>
						<li><a href="#">Events</a></li>
						<li><a href="#">Instructor Profile</a></li>
						<li><a href="#">Purchase Guide</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="ftr_box">
					<h4>Links</h4>
					<ul>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Gallery</a></li>
						<li><a href="#">News & Articles</a></li>
						<li><a href="#">FAQ's</a></li>
						<li><a href="#">Sign In/Registration</a></li>
						<li><a href="#">Coming Soon</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="ftr_box">
					<h4>Contacts</h4>
					<p>Enter your email address to register to our newslatter subscription</p>
					<form method="post" action="">
						<input type="email" name="email" value="" placeholder="Email">
						<button type="button" class="button">Subscribe</button>
					</form>
					<ul class="ftr_scl">
						<li><a href="#"><img src="{{ ('images/scl001.png') }}" alt="scl"></a></li>
						<li><a href="#"><img src="{{ ('images/scl002.png') }}" alt="scl"></a></li>
						<li><a href="#"><img src="{{ ('images/scl003.png') }}" alt="scl"></a></li>
						<li><a href="#"><img src="{{ ('images/scl004.png') }}" alt="scl"></a></li>
						<li><a href="#"><img src="{{ ('images/scl005.png') }}" alt="scl"></a></li>
					<ul>
				</div>
			</div>
		</div>
	</div>
</footer>
