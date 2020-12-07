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
    <link href="css/component.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <script src="js/modernizr.custom.js"></script>
    <link href=" plugins/fontAwsome/otfs/Font Awesome 5 Brands-Regular-400.otf">
    <script src="https://kit.fontawesome.com/850f11ab6f.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- Navigation -->
<?php include('includes/header.php'); ?>
<!-- Page Content -->
<div class="container">
    <div class="mainBody">
    <div class="left">
            <!-- Blog Entries Column -->
            <div>
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
            </div>
        <!---Comment Section --->
            <div class="commentWrapper">
                <hr>
                <!-- Comment  :::::::::::::::::::::::::::::::::::::::::::::::-->
                <?php $comments = $database->getPostComment($postId) ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="commentContainer">
                        <div class="commentHeader">
                            <h5><?= htmlentities($comment['name']); ?></h5>
                            <div class="commentDate"><?= htmlentities($comment['postingDate']); ?></div>
                        </div>
                        <p class="commentDate"><?= htmlentities($comment['email']); ?></p>
                        <p><?= htmlentities($comment['comment']); ?></p>
                    </div>
                <?php endforeach; ?>
                <!-- END Comment  :::::::::::::::::::::::::::::::::::::::::::::::-->

                <!-- Input Comment  :::::::::::::::::::::::::::::::::::::::::::::::-->
                <form class="formWrapper" name="Comment" method="post">
                    <input type="hidden" name="csrftoken" value="<?= htmlentities($_SESSION['token']); ?>"/>
                    <input placeholder="Name" type="text" value="" name="name" required />
                    <input placeholder="Email" type="text" value="" name="email" required />
                    <textarea placeholder="Comment" type="text" value="" name="comment" required></textarea>

                    <button class="commentButton" type="submit" name="submit">Send</button>
                </form>

                <!-- END Input Comment  :::::::::::::::::::::::::::::::::::::::::::::::-->

            </div>
    </div>

    <div class="right">
        <?php include('includes/sidebar.php'); ?>
    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script>
    new UISearch(document.getElementById('sb-search'));
</script>

</body>
</html>
