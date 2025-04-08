<?php
require 'includes/header.php';

if (!$isLoggedIn) {
	header("Location: ../auth/login.php");
	exit();
}

?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Create A Topic</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<form role="form">
						<div class="form-group">
							<label>Topic Title</label>
							<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
						</div>
						<div class="form-group">
							<label>Category</label>
							<select class="form-control">
								<option>Design</option>
								<option>Development</option>
								<option>Business & Marketing</option>
								<option>Search Engines</option>
								<option>Cloud & Hosting</option>
							</select>
						</div>
						<div class="form-group">
							<label>Topic Body</label>
							<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
						<button type="submit" class="color btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php require 'includes/sidebar.php' ?>
		</div>
	</div>
</div><!-- /.container -->

<?php require 'includes/footer.php' ?>