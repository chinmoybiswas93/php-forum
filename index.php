<?php
require 'includes/header.php';

//get the category id from the url
$category_id = $_GET['cat'] ?? null;
$user_id = $_GET['profile'] ?? null;

// get the topics from the database with the user name, id, avatar and category id, name
if ($category_id) {
	$stmt = $pdo->prepare("SELECT topics.*, users.name AS username, users.avatar, categories.name AS category_name FROM topics
	JOIN users ON topics.user_id = users.id JOIN categories ON topics.category_id = categories.id
	WHERE topics.category_id = ? ORDER BY topics.created_at DESC");
	$stmt->execute([$category_id]);
	$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else if ($user_id) {
	$stmt = $pdo->prepare("SELECT topics.*, users.name AS username, users.avatar, categories.name AS category_name FROM topics
	JOIN users ON topics.user_id = users.id JOIN categories ON topics.category_id = categories.id
	WHERE topics.user_id = ? ORDER BY topics.created_at DESC");
	$stmt->execute([$user_id]);
	$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
	$topics = $pdo->query("SELECT topics.*, users.name AS username, users.avatar, categories.name AS category_name FROM topics
	JOIN users ON topics.user_id = users.id JOIN categories ON topics.category_id = categories.id ORDER BY topics.created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
}

// var_dump($topics[0]['avatar']); // Debugging line to check the structure of $topics
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<?php
					// Display a welcome message using a ternary operator
					echo !empty($_SESSION['name'])
						? "<h1 class='pull-left'>Welcome, " . htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8')
						: '<h1 class="pull-left">Welcome to Forum</h1>';
					?>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<ul id="topics">
						<?php
						if (empty($topics)) {
							echo "<li class='topic'>No topics found in this category.</li>";
						} else {
							foreach ($topics as $topic) {
								?>
								<li class="topic">
									<div class="row">
										<div class="col-md-2">
											<img class="avatar pull-left" src="img/<?php echo $topic['avatar'] ?> " />
										</div>
										<div class="col-md-10">
											<div class="topic-content pull-right">
												<h3><a
														href="topic.php?id=<?php echo $topic['id']; ?>"><?php echo htmlspecialchars($topic['title'], ENT_QUOTES, 'UTF-8'); ?></a>
												</h3>
												<div class="topic-info">
													<a
														href="index.php?cat=<?php echo $topic['category_id']; ?>"><?php echo htmlspecialchars($topic['category_name'], ENT_QUOTES, 'UTF-8'); ?></a>
													>>
													<a
														href="index.php?profile=<?php echo $topic['user_id']; ?>"><?php echo htmlspecialchars($topic['username'], ENT_QUOTES, 'UTF-8'); ?></a>
													>>
													Posted on: <?php echo date('F j, Y', strtotime($topic['created_at'])); ?>
													<span
														class="color badge pull-right"><?php echo htmlspecialchars($topic['replies_count'] ?? 0, ENT_QUOTES, 'UTF-8'); ?></span>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php
							}
						}
						?>
					</ul>

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php require 'includes/sidebar.php' ?>
		</div>
	</div>
</div>
<!-- /.container -->


<?php require 'includes/footer.php' ?>