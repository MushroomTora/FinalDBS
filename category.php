<?php 
session_start();
error_reporting(0);
include('includes/config.php');

    ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HandemadeTutorials | Category  Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
      <link href="css/header.css" rel="stylesheet">
      <script src="js/modernizr.custom.js"></script>
      <script src="js/toggleHeader.js"></script>
      <link href=" plugins/fontAwsome/otfs/Font Awesome 5 Brands-Regular-400.otf">
      <script src="https://kit.fontawesome.com/850f11ab6f.js" crossorigin="anonymous"></script>
      <link href="css/component.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">


     
      <div class="mainBody">

        <!-- Blog Entries Column -->
        <div class="left">
<h1><?php echo htmlentities($row['category']);?> News</h1>
<hr>
<div class="blogWrapper">

          <!-- Blog Post -->
<?php 
        if($_GET['catid']!=''){
$_SESSION['catid']=intval($_GET['catid']);
}
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblposts.PostSubDes as postsubdes ,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.CategoryId='".$_SESSION['catid']."' and tblposts.Is_Active=1 order by tblposts.id desc LIMIT $offset, $no_of_records_per_page");

$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
echo "No record found";
}
else {
while ($row=mysqli_fetch_array($query)) {


?>

 <div class="blogPost">
 <img class="card-img-top cardImage" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
    <p class="postDate">Posted on <?php echo htmlentities($row['postingdate']);?></p> 
            <div class="cardBody">
              <h2 class="cardTitle"><?php echo htmlentities($row['posttitle']);?></h2>
                 <p><span style="font-weight: 500">Category : </span> <a class="categoryText" href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> </p>
            <p><?php echo htmlentities($row['postsubdes']);?></p>
            </div>
            <div style="padding-bottom: 16px">
              <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="readMoreText">Read More &rarr;</a>
            </div>

          </div>
<?php } ?>
</div>

    <ul class="pagination justify-content-center mb-4">
        <li class="page-item"><a style="color: #FF7A2F" href="?pageno=1"  class="page-link">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a style="color: #FF7A2F" href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
    </ul>
<?php } ?>
  
          <!-- Pagination -->

        </div>

        <!-- Sidebar Widgets Column -->
    <div class="right">
        <?php include('includes/sidebar.php'); ?>
    </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
      <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/classie.js"></script>
    <script src="js/uisearch.js"></script>
    <script>
        new UISearch(document.getElementById('sb-search'));
    </script>

 
</head>
  </body>

</html>
