<?php
include 'functions.php';
$create_contacts_video = 'tutorial_video.php?video=create';
$delete_contacts_video = 'tutorial_video.php?video=delete';
$configure_contacts_video = 'tutorial_video.php?video=configure';
$search_contacts_video = 'tutorial_video.php?video=search';
?>


<?= template_header('Home') ?>
<section>
	<div class="card-container">
		<div class="card">
			<a href="<?php echo $create_contacts_video; ?>"> 
			<!-- Create Contacts card -->
				<div class="card--display"><i class="material-icons">Create Contacts</i>
					<h2>See More</h2>
				</div>
				<div class="card--hover">
					<h2>Create Contacts</h2>
					<p>Effortlessly build your contact database by adding new contacts with just a few clicks. Our user-friendly interface allows you to input essential details such as names, phone numbers, email addresses, and more. Stay organized and ensure that your contact list is always up-to-date.</p>
					<p class="link">Click to see tutorial</p>
				</div>
			</a>
			<div class="card--border"></div>
		</div>
	</div>
	<div class="card-container">
		<div class="card">
			<a href="<?php echo $delete_contacts_video; ?>">
			<!-- Delete Contacts card -->
				<div class="card--display"><i class="material-icons">Delete Contacts</i>
					<h2>See More</h2>
				</div>
				<div class="card--hover">
					<h2>Delete Contacts</h2>
					<p>Need to remove outdated or irrelevant contacts? Our system provides a simple and secure way to delete contacts. Whether you're cleaning up your list or managing changes in your network, our delete functionality ensures that your contact database remains accurate and clutter-free.</p>
					<p class="link">Click to see tutorial</p>
				</div>
			</a>
			<div class="card--border"></div>
		</div>
	</div>
	<div class="card-container">
		<div class="card"><a href="<?php echo $configure_contacts_video; ?>">
		<!-- Configure Contacts card -->
				<div class="card--display"><i class="material-icons">Configure Contacts</i>
					<h2>See More</h2>
				</div>
				<div class="card--hover">
					<h1>Configure Contacts</h1>
					<p>Tailor your contact details to meet your specific needs. Our configuration options enable you to update and modify contact information whenever necessary. Stay in control of your data by customizing fields, adding notes, or adjusting preferences to ensure your contact records are as accurate as possible.</p>
					<p class="link">Click to see tutorial</p>
				</div>
			</a>
			<div class="card--border"></div>
		</div>
	</div>
	<div class="card-container">
		<div class="card"><a href="<?php echo $search_contacts_video; ?>">
		<!-- Search Contacts card -->
				<div class="card--display"><i class="material-icons">Search for Contacts</i>
					<h2>See More</h2>
				</div>
				<div class="card--hover">
					<h2>Search for Contacts</h2>
					<p>Easily find the contacts you need with our powerful search functionality. Whether you're looking for a specific name, number, or other details, our search feature ensures quick and efficient access to your contact information.</p>
					<p class="link">Click to see tutorial</p>
				</div>
			</a>
			<div class="card--border"></div>
		</div>
	</div>
	<div class="card-container">
		<div class="card"><a>
				<div class="card--display"><i class="material-icons">Why Choose Contact Management?</i>
					<h2>See More</h2>
				</div>
				<div class="card--hover">
						<p><b>User-Friendly Interface:</b> Navigate through our system with ease, whether you're a tech enthusiast or a casual user.</p><br>
						<p><b>Secure Data Management:</b> Rest easy knowing that your contact information is stored securely and can be accessed only by authorized users.</p><br>
						<p><b>Time-Efficient Operations:</b> Save time with our efficient CRUD operations, allowing you to focus on what matters most.</p>
				</div>
			</a>
			<div class="card--border"></div>
		</div>
	</div>
</section>