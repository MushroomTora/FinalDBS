 <nav>
 <div class='container'>
                    <div class="mainHeader">
                            <div class='logo'>
                               <a href="index.php"> <h1>HANDMADE TUTORIAL</h1></a>
                            </div>
                        <div class='search-mobile'>
                               <form name="search" action="search.php" method="post">
                                    <input class="search-input-mobile" placeholder="Enter your search term..." type="text" value="" name="searchtitle" id="search" required>
                                    <input class="sb-search-submit" type="submit" value="">
                                    <span class="sb-icon-search"><i class="fas fa-search fa-sm"></i></span>
                                </form>
                        </div>
                    </div>     
                </div>
                    <div class='subHeader'>
                        <div class="container">
                            <div class="subHeadder-items" id="navbarResponsive">
                                    <li class="sub-items">
                                        <a class="sub-items-link" href="index.php">Home</a>
                                    </li> 
                                    <li class="sub-items">
                                        <a onclick="myFunction()" class="sub-items-link categoryToggledropBtn">Categories</a>
                                            <div id="categoryToggle" class="categoryToggleDropdownContent">
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
                                    </li>
                                    <li class="sub-items">
                                        <a class="sub-items-link" href="about-us.php">About US</a>
                                    </li>
                                   <li class="sub-items">
                                        <a class="sub-items-link" href="contact-us.php">Contact us</a>
                                  </li>

                                  <div class='search'>
                            <div id="sb-search" class="sb-search">
                                <form name="search" action="search.php" method="post">
                                    <input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="searchtitle" id="search" required>
                                    <input class="sb-search-submit" type="submit" value="">
                                    <span class="sb-icon-search"><i class="fas fa-search fa-sm"></i></span>
                                </form>
                            </div>
                        </div>
                      
                        </div>
                    </div>
               
            </nav>
    </nav>