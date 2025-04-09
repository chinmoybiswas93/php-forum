<li class="topic">
    <div class="row">
        <div class="col-md-2">
            <img class="avatar pull-left"
                src="img/<?php echo $topic['avatar'] == 'default.jpg' ? 'gravatar.png' : $topic['avatar']; ?>" />
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