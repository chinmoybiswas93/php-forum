<?php require '../includes/header.php' ?>

<?php

if (isset($_POST['register'])) {
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])) {
		$error = "Please fill in all fields.";
	} else {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$about = $_POST['about'];
		$avatar = $_FILES['avatar']['name'];
		$avatar_tmp = $_FILES['avatar']['tmp_name']; // Temporary file path

		$dir = __DIR__ . '/../img/' . basename($avatar); // Absolute path to the img folder

		if ($password != $password2) {
			$error = "Passwords do not match.";
		} else {
			// Check if the username or email already exists
			$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
			$stmt->execute(['username' => $username, 'email' => $email]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($user) {
				$error = "Username or email already exists.";
			} else {
				// Hash the password
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);

				// Move the uploaded file to the img directory
				if (!empty($avatar)) {
					if (move_uploaded_file($avatar_tmp, $dir)) {
						// Insert the new user into the database
						$stmt = $pdo->prepare("INSERT INTO users (name, email, username, password, about, avatar) VALUES (:name, :email, :username, :password, :about, :avatar)");
						$stmt->execute(['name' => $name, 'email' => $email, 'username' => $username, 'password' => $hashed_password, 'about' => $about, 'avatar' => $avatar]);

						header("Location: login.php?success=1");
						exit();
					} else {
						$error = "Failed to upload avatar.";
					}
				} else {
					// Insert the user without an avatar
					$stmt = $pdo->prepare("INSERT INTO users (name, email, username, password, about, avatar) VALUES (:name, :email, :username, :password, :about, :avatar)");
					$stmt->execute(['name' => $name, 'email' => $email, 'username' => $username, 'password' => $hashed_password, 'about' => $about, 'avatar' => 'default.jpg']);

					header("Location: login.php?success=1");
					exit();
				}
			}
		}
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Register</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>

					<?php
					//error notification here
					if (isset($error)) {
						echo "<div class='alert alert-danger'>$error</div>";
					}
					?>
					<form role="form" enctype="multipart/form-data" method="post" action="register.php">
						<div class="form-group">
							<label>Name*</label> <input type="text" class="form-control" name="name"
								placeholder="Enter Your Name">
						</div>
						<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control" name="email"
								placeholder="Enter Your Email Address">
						</div>
						<div class="form-group">
							<label>Choose Username*</label> <input type="text" class="form-control" name="username"
								placeholder="Create A Username">
						</div>
						<div class="form-group">
							<label>Password*</label> <input type="password" class="form-control" name="password"
								placeholder="Enter A Password">
						</div>
						<div class="form-group">
							<label>Confirm Password*</label> <input type="password" class="form-control"
								name="password2" placeholder="Enter Password Again">
						</div>
						<div class="form-group">
							<label>Upload Avatar</label>
							<input type="file" name="avatar">
							<p class="help-block"></p>
						</div>
						<div class="form-group">
							<label>About Me</label>
							<textarea id="about" rows="6" cols="80" class="form-control" name="about"
								placeholder="Tell us about yourself (Optional)"></textarea>
						</div>
						<input name="register" type="submit" class="color btn btn-default" value="Register" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php require '../includes/sidebar.php' ?>
		</div>
	</div><!-- /.container -->


	<?php require '../includes/footer.php' ?>