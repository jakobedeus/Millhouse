
<?php
// All the includes we need for the site.
include '../classes/PostsFetch.php';
include '../classes/PostsEdit.php';
include '../classes/PostsInsert.php';
include '../classes/CommentsEdit.php';
include '../classes/CommentsFetch.php';
include '../classes/CommentsInsert.php';
include '../includes/functions.php';


/*
 Fetch categories and put them in a list. To make it easier to add more categories in database and they will automatically loop out here. 
*/
$category = new PostsFetch($pdo);
$all_category= $category->fetchCategory();
?>
<body class="body_views">
    <header class="container-fluid p-4">
        <div class="row">
            <div class="col-12 p-4 logo_container text-center">
                <h1><a href="../index.php"><img src="../images/logo_borders.png" alt="Logotype"></a></h1>
            </div>
        </div>
        <nav class="row p-4">
            <div class="col-6 col-md-3 align-self-center text-center contact">
                <a href="mailto:info@millhouse.com"><button class="nav_button_inverted_dark text-center">
                <i class=" order-1 fas fa-envelope"></i> GET IN TOUCH</button></a>
            </div>
            <div class="col-12 order-3 col-md-6 order-md-2 pt-4 category_container d-flex justify-content-center">
                <ul>
                    <li><a href="feed.php"><p>ALL</p></a></li>
                </ul>
                <?php
                foreach($all_category as $category_link):
                    $product_category = $category_link['category'];
                ?>
                    <ul>
                        <?php  
                        // If $_GET["category"] is active, add underline to a:link.
                        if(isset($_GET["category"]) && $_GET["category"]==$product_category) {?>
                            <li><a href="feed.php?category=<?= $product_category; ?>"><p class="underline text-uppercase">
                            <?= $product_category; ?></p></a></li>
            
                        <?php 
                        // else present a:link without underline.
                        } else { 
                        ?>
                            <li><a href="feed.php?category=<?= $product_category; ?>"><p class="text-uppercase">
                            <?= $product_category; ?></p></a></li>
                        <?php
                        }?>

                    </ul>
                <?php
                endforeach;
                ?>
            </div>
            <div class="col-6 order-2 col-md-3 logout align-self-center text-center">
                <a href="../includes/logout.php" class="col-12"><button class="general_button text-center">LOG OUT</button></a>    
            </div>
        </nav>
    </header>
