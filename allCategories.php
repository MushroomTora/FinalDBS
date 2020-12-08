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

    <title>HandemadeTutorials | Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
      <link href="css/component.css" rel="stylesheet">
      <link href="css/header.css" rel="stylesheet">
      <script src="js/modernizr.custom.js"></script>
      <link href=" plugins/fontAwsome/otfs/Font Awesome 5 Brands-Regular-400.otf">
      <script src="https://kit.fontawesome.com/850f11ab6f.js" crossorigin="anonymous"></script>

  </head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">


     
      <div class="mainBody">

        <!-- Blog Entries Column -->
        <div class="left">
            <div>
            <h5> All Categories</h5>
            <div>
              <div>
                <div>
                  <ul class="list-unstyled mb-0">
                        <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory");
                        while($row=mysqli_fetch_array($query))
                        {
                        ?>
                    <li>
                      <a href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
                    </li>
<?php } ?>
                  </ul>
                </div>
       
              </div>
            </div>
          </div>

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
