<?php
session_start();
include('includes/config.php');
?>
<?php
if (!isset($database)) {
    include_once('Database.php');
    $database = new Database();
}
?>
<?php $postId = intval($_GET['nid']); ?>
<?php
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Save comment
if (isset($_POST['submit']) && !empty($_POST['csrftoken']) && hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
    if (!$database->createComment($postId, $_POST['email'], $_POST['name'], $_POST['comment'])) {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
} else { // increment post view.
    $database->incrementView($postId);
}
?>
<?php $post = $database->getPostDetail($postId) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= isset($_POST['submit']) ? "<meta http-equiv='refresh' content='0'>" : '' ?>
    <title>HandemadeTutorials | Home Page</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<?php include('includes/header.php'); ?>
<!-- Page Content -->
<div class="container">
    <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title"><?= htmlentities($post['PostTitle']) ?></h1>
                    <p>
                        <b>Category : </b>
                        <a href="category.php?catid=<?= htmlentities($post['CategoryId']) ?>">
                            <?= htmlentities($post['CategoryName']) ?>
                        </a> |
                        <b>Sub Category : </b><?= htmlentities($post['Subcategory']) ?> |
                        <b>Posted on </b><?= htmlentities($post['PostingDate']) ?> |
                        <?= $post['view'] . ' view(s)'?>
                    </p>
                    <hr/>
                    <img class="img-fluid rounded"
                         src="admin/postimages/<?= htmlentities($post['PostImage']) ?>"
                         alt="<?= htmlentities($post['PostTitle']) ?>" />
                    <p class="card-text"><?= $post['PostDetails'] ?></p>
                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        <!-- Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>
    </div>
    <!-- /.row -->
    <!---Comment Section --->

    <div class="row" style="margin-top: -8%">
        <div class="col-md-8">
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form name="Comment" method="post">
                        <input type="hidden" name="csrftoken" value="<?= htmlentities($_SESSION['token']); ?>"/>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter your Valid email" required />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!---Comment Display Section --->
            <?php $comments = $database->getPostComment($postId) ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?= htmlentities($comment['name']); ?> <br/>
                            <span style="font-size:11px;"><b>at</b> <?= htmlentities($comment['postingDate']); ?></span>
                        </h5>

                        <?= htmlentities($comment['comment']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
