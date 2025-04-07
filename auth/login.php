<?php require '../includes/header.php' ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Register</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<form role="form" enctype="multipart/form-data" method="post" action="register.php">

						<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control" name="email"
								placeholder="Enter Your Email Address">
						</div>

						<div class="form-group">
							<label>Password*</label> <input type="password" class="form-control" name="password"
								placeholder="Enter A Password">
						</div>

						<input name="register" type="submit" class="color btn btn-default" value="Register" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php require '../includes/sidebar.php' ?>
		</div>
	</div>
</div><!-- /.container -->


<?php require '../includes/footer.php' ?>