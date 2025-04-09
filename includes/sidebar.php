<?php
//get the categories, total number of users, topics and categories from the database
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_topics = $pdo->query("SELECT COUNT(*) FROM topics")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();

$selected_category = isset($_GET['cat']) ? $_GET['cat'] : null;

// var_dump($selected_category); // Debugging line to check the value of $selected_category

//create a topic count function to get the number of topics in each category
function getTopicCount($category_id, $pdo)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM topics WHERE category_id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetchColumn();
}

foreach ($categories as &$category) {
    $category['topic_count'] = getTopicCount($category['id'], $pdo);
}

?>

<div class="sidebar">
    <div class="block">
        <h3>Categories</h3>
        <div class="list-group">
            <a href="index.php" class="list-group-item <?php echo !$selected_category ? 'active' : ''; ?>">All Topics
                <span class="badge pull-right"><?php echo $total_topics; ?></span></a>
            <?php for ($i = 0; $i < count($categories); $i++) {
                ?>
                <a href="index.php?cat=<?php echo $categories[$i]['id'] ?>"
                    class="list-group-item <?php echo $selected_category === $categories[$i]['id'] ? 'active' : ''; ?>"><?php echo $categories[$i]['name'] ?><span
                        class="badge pull-right"><?php echo $categories[$i]['topic_count'] ?> </span></a>
                <?php
            } ?>
        </div>
    </div>
</div>

<div class="block" style="margin-top: 20px;">
    <h3 class="margin-top: 40px">Forum Statistics</h3>
    <div class="list-group">
        <p class="list-group-item">Total Number of Users:<span
                class="color badge pull-right"><?php echo $total_users; ?></span></p>
        <p class="list-group-item">Total Number of Topics:<span
                class="color badge pull-right"><?php echo $total_topics; ?></span></p>
        <p class="list-group-item">Total Number of Categories: <span
                class="color badge pull-right"><?php echo $total_categories; ?></span></p>

    </div>
</div>
</div>