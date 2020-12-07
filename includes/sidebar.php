<?php
if (!isset($database)) {
    include_once('Database.php');
    $database = new Database();
}
?>
  <div class="sideBar">
  <!-- Side Widget -->
  <div class="most-popular-post">
      <h5 class="card-header">The Most Popular</h5>
      <div class="card-body">
          <ul>
              <?php foreach ($database->getMostPopular() as $post) : ?>
                  <li>
                      <a href="news-details.php?nid=<?= htmlentities($post['id']) ?>">
                          <?= htmlentities($post['PostTitle']); ?>
                      </a>
                      <hr>
                  </li>
              <?php endforeach; ?>
          </ul>
      </div>
  </div>

          <!-- Side Widget -->
          <div>
            <h5 class="card-header">Recent News</h5>
            <div class="card-body">
                      <ul>
<?php
$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
while ($row=mysqli_fetch_array($query)) {

?>

  <li>
                      <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a>
                      <hr>
                    </li>
            <?php } ?>
          </ul>
            </div>
          </div>

        </div> 
