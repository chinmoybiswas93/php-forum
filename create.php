<?php
require 'includes/header.php';

if (!$isLoggedIn) {
	header("Location: ../auth/login.php");
	exit();
}

//get the categories from the database
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['create'])) {
	$title = $_POST['title'];
	$category = $_POST['category'];
	$body = $_POST['body'];
	$user_id = $_SESSION['user_id'];

	if (empty($title) || empty($category) || empty($body)) {
		$error = "Please fill in all fields";
	} else {
		$stmt = $pdo->prepare("INSERT INTO topics (title, content, user_id, category_id) VALUES (?, ?, ?, ?)");
		if ($stmt->execute([$title, $body, $user_id, $category])) {
			header("Location: index.php");
			exit();
		} else {
			$error = "Error creating topic";
		}
	}
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
					<?php
					// Error notification here
					if (isset($error)) {
						echo "<div class='alert alert-danger'>$error</div>";
					}
					?>
					<form role="form" method="POST" action="create.php">
						<div class="form-group">
							<label>Topic Title</label>
							<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
						</div>
						<div class="form-group">
							<label>Category</label>
							<select name="category" class="form-control">
								<option value="" disabled selected>Select Category</option>
								<?php
								foreach ($categories as $category) {
									echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Topic Body</label>
							<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
						<button name="create" type="submit" class="color btn btn-default">Create Topic </button>
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