<?php
require '../includes/header.php';

if ($isLoggedIn) {
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['login'])) {
	$error = null;
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$error = "Please fill in all fields.";
	} else {
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Check if the user email exists
		$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$stmt->execute(['email' => $email]);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		// Check if the user exists and the password is correct
		if ($user && password_verify($password, $user['password'])) {
			session_start();
			// Set session variables
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['name'] = $user['name'];

			// Redirect to the homepage
			header("Location: ../index.php?success=1");
			exit();
		} else {
			$error = "Invalid email or password.";
		}
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Login</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<?php
					// Error notification here
					if (isset($error)) {
						echo "<div class='alert alert-danger'>$error</div>";
					}
					?>
					<form role="form" enctype="multipart/form-data" method="post" action="login.php">

						<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control" name="email"
								placeholder="Enter Your Email Address">
						</div>

						<div class="form-group">
							<label>Password*</label> <input type="password" class="form-control" name="password"
								placeholder="Enter A Password">
						</div>

						<input name="login" type="submit" class="color btn btn-default" value="login" />
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