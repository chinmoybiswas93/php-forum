<?php
require 'includes/header.php';

//get the topic id from the url
$topic_id = $_GET['id'] ?? null;
$error = $_GET['error'] ?? null;
$success = $_GET['success'] ?? null;

if (!$topic_id) {
	header("Location: index.php?error=1");
	exit();
}
//get the topic from the database with user id, name, avatar
$stmt = $pdo->prepare("SELECT topics.*, users.name AS user_name, users.id AS user_id, users.avatar AS user_avatar FROM topics JOIN users ON topics.user_id = users.id WHERE topics.id = ?");
$stmt->execute([$topic_id]);
$topic = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($topic); // Debugging line to check the value of $topic

//get the replies from the database with user id, name, avatar
$stmt = $pdo->prepare("SELECT replies.*, users.name AS user_name, users.id AS user_id, users.avatar AS user_avatar FROM replies JOIN users ON replies.user_id = users.id WHERE replies.topic_id = ?");
$stmt->execute([$topic_id]);
$replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($replies); // Debugging line to check the value of $replies



//check if the fields are empty, if not then sanitize and add the reply to the database with best practices
if (isset($_POST['reply'])) {
	$reply = $_POST['reply'] ?? null;
	if (empty($reply)) {
		header("Location: topic.php?id=$topic_id&error=1");
		exit();
	} else {
		$reply = htmlspecialchars($reply, ENT_QUOTES, 'UTF-8');
		$user_id = $_SESSION['user_id'];
		$stmt = $pdo->prepare("INSERT INTO replies (content, user_id, topic_id) VALUES (?, ?, ?)");
		$stmt->execute([$reply, $user_id, $topic_id]);
		header("Location: topic.php?id=$topic_id&success=1");
		exit();
	}
}
//check if the topic exists, if not then redirect to index.php with error message


?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php
			// Error notification here
			if (isset($error) && $error == '1') {
				echo "<div class='alert alert-danger'>Reply field can't be empty!</div>";
			}
			if (isset($success) && $success == '1') {
				echo "<div class='alert alert-success'>Reply Added Successfully!</div>";
			}
			?>
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left"><?php echo $topic['title']; ?></h1>
					<div class="clearfix"></div>
					<hr>
					<ul id="topics">
						<li id="main-topic" class="topic topic">
							<div class="row">
								<div class="col-md-2 text-center" style="font-size: 12px;">
									<div class="user-info">
										<img class="avatar pull-left"
											src="img/<?= $topic['user_avatar'] ?? 'gravatar.png'; ?>" />
									</div>
									<p><?php echo htmlspecialchars($topic['user_name']); ?><br><?php
									   $created_at = new DateTime($topic['created_at']);
									   $now = new DateTime();
									   $interval = $created_at->diff($now);
									   if ($interval->d > 0) {
										   echo htmlspecialchars($interval->d . ' days ago');
									   } elseif ($interval->h > 0) {
										   echo htmlspecialchars($interval->h . ' hours ago');
									   } elseif ($interval->i > 0) {
										   echo htmlspecialchars($interval->i . ' minutes ago');
									   } else {
										   echo htmlspecialchars('Just now');
									   }
									   ?>
									</p>
								</div>
								<div class="col-md-10">
									<div class="topic-content pull-right">
										<div><?php echo nl2br(htmlspecialchars($topic['content'])); ?></div>
										</p>
									</div>
								</div>
							</div>
						</li>
						<?php
						// Loop through the replies and display them
						foreach ($replies as $reply) {
							?>
							<li class="topic reply">
								<div class="row">
									<div class="col-md-2 text-center" style="font-size: 12px;">
										<div class="user-info pull-left">
											<img class="avatar" src="img/<?= $reply['user_avatar'] ?? 'gravatar.png'; ?>" />
										</div>
										<p><?php echo htmlspecialchars($reply['user_name']); ?><br><?php
										   $created_at = new DateTime($reply['created_at']);
										   $now = new DateTime();
										   $interval = $created_at->diff($now);
										   if ($interval->d > 0) {
											   echo htmlspecialchars($interval->d . ' days ago');
										   } elseif ($interval->h > 0) {
											   echo htmlspecialchars($interval->h . ' hours ago');
										   } elseif ($interval->i > 0) {
											   echo htmlspecialchars($interval->i . ' minutes ago');
										   } else {
											   echo htmlspecialchars('Just now');
										   }
										   ?>
										</p>
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<p><?php echo nl2br(htmlspecialchars($reply['content'])); ?></p>
										</div>
									</div>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<h3>Reply To Topic</h3>
					<hr>
					<form role="form" method="POST" action="topic.php?id=<?php echo $topic_id; ?>">
						<div class="form-group">
							<textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
							<script>
								CKEDITOR.replace('reply');
							</script>
						</div>
						<button name="replytopic" type="submit" class="color btn btn-default"
							value="replytopic">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="block text-center">
				<h3 style="margin-top: 0px;">Topic Creator</h3>
				<hr>
				<div class="text-center">
					<div class="user-info" style="margin: auto;">
						<img class="avatar pull-left" src="img/<?= $topic['user_avatar'] ?? 'gravatar.png'; ?>" />
					</div>
					<div class="user-data">
						<p><strong><?php echo $topic['user_name']; ?></strong></p>
						<p>Posts: 43</p>
						<p><a href="#">View Profile</a></p>
						<p><a href="index.php?profile=<?php echo $topic['user_id']; ?>" class="btn btn-default">View All
								Topics</a></p>
					</div>
				</div>

			</div>
			<?php require 'includes/sidebar.php' ?>
		</div>
	</div>
</div><!-- /.container -->

<?php require 'includes/footer.php' ?>