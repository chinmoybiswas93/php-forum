<?php include __DIR__ . '/../config/config.php';
session_start();
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To Forum</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URL ?>/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL ?>/css/custom.css" rel="stylesheet">
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Forum</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/">Home</a></li>

                    <?php if ($isLoggedIn): ?>
                        <li><a href="/create.php">Create Topic</a></li>
                        <li><a href="/auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/auth/login.php">Login</a></li>
                        <li><a href="/auth/register.php">Register</a></li>
                    <?php endif; ?>

                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</body>

</html>