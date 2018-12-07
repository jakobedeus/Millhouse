<?php
session_start();

include "../includes/head-views.php";
include "../includes/header-views.php";
include "../includes/admin-access.php";


$posts_fetch = new PostsFetch($pdo);
$all_posts= $posts_fetch->fetchAll();
$post_category= $posts_fetch->fetchPostByCategory();

$category = new PostsFetch($pdo);
$all_category= $category->fetchCategory();


$insert_post = new PostsInsert($pdo);
$upload_ok = $insert_post->InsertPosts();


?>
<main class="container justify-content-center">
    <?php
    if($_SESSION["admin"] === "is_admin"){?>
    <button class="btn btn-light add_sign_btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-plus add_sign"></i><h2 class="font_h2 new_post">New post</h2></button>
    <div class="row justify-content-center mb-5">
        <div class="col-10 m-0 p-0 collapse" id="collapseExample">

            <!-- If we are sending a file in a form we must supply the extra attribute
            'encytype="multipart/form-data"', otherwise the file will be sent as a
            string and not uploaded to the server, otherwise the form is similar to every other form -->
            <form action="../includes/update_page.php" method="POST" enctype="multipart/form-data">
                <label for="image">Image</label>
                <!-- Use 'type="file"' to automatically create a input-field for uploads -->
                <input type="file" name="image" id="image" required>
                <!-- Use a textarea for a bigger input-field, put an ID on the area for the
                wysiwyg-editor to initialize on -->
                <label for="title">Title</label><br />
                <input type="text" name="title" id="title" required><br />

                <select name="category_checkbox[]" id="" required>
                    <option value="">Choose category</option>
                    <option value="1">Living</option>
                    <option value="2">Sunglasses</option>
                    <option value="3">Watches</option>
                </select>
                <textarea name="text" id="text"></textarea>
                <input type="hidden" name="new_post" id="new_post" value="<?= $post['id']; ?>">
                <input class="button" type="submit" value="Send">
            </form>
        </div> <!-- closing col-->
    </div> <!-- closing row-->

    <?php
    } // closing if-statement for admin access
    if(isset($_GET['category'])){

        //Ska hämta annan foreach från annan metod i classen 
        foreach(array_reverse($post_category) as $category): ?>
            <div class="row blog_posts mb-5 justify-content-center">
                <div class="col-12 col-md-7 blog_post_content">
                    <h2 class="font_h2"><?= $category["title"]; ?></h2>
                    <p><?= $category["date"] . ' - ' . $category["category"];?></p>
                    <p><?= '<strong> Wrote by: </strong>' . $category["username"]; ?></p>
                    <div class="blog_posts_content_text">
                        <?php 
                        if(strlen($category["content"]) > 300){
                            $blog_posts_content_text = text_shorten( 
                                $text = $category["content"]
                             );
                            echo $blog_posts_content_text;
                        ?>
                            <a class="blog_post_link" href="post.php?id=<?= $category["id"]; ?>"><p>Read more</p></a>
                        <?php 
                        }else{ 
                        ?>
                            <p><?= $category["content"];  ?></p> 
                        <?php 
                        } 

                        ?>
                    </div> <!-- closing blog_posts_content_text-->
                    <p> 0 kommentarer <a href="post.php?id=<?= $category["id"]; ?>"><button class="button">Go to post</button></a></p>
                </div> <!-- closing col-12 col-md-7-->
                <div class="post_image_frame col-12 col-md-5 p-0">
                    <img src="<?= $category["image"]; ?>" alt="Cool image.">
                </div>
            </div> <!-- closing row-->
        <?php
        endforeach;
    }else{

        foreach(array_reverse($all_posts) as $post): ?>
            <div class="row blog_posts mb-5 justify-content-center">
                <div class="blog_post_content col-12 col-md-7">
                    <h2 class="font_h2"><?= $post["title"]; ?></h2>
                    <p><?= $post["date"] . ' - ' . $post["category"];?></p>
                    <p><?= '<strong> Wrote by: </strong>' . $post["username"]; ?></p>
                    <div class="blog_posts_content_text">
                        <?php 
                        if(strlen($post["content"]) > 300){
                            $blog_posts_content_text = text_shorten( 
                                $text = $post["content"]
                             );
                            echo $blog_posts_content_text;
                        ?>
                            <a class="blog_post_link" href="post.php?id=<?= $post["id"]; ?>"><p>Read more</p></a>
                        <?php
                        }else{
                        ?>
                            <p><?= $post["content"];  ?></p>
                        <?php
                        }
                        ?>
                    </div> <!-- closing blog_posts_content_text-->
                            <p> 0 kommentarer <a href="post.php?id=<?= $post["id"]; ?>"><button class="button">Go to post</button></a></p>
                </div> <!-- closing col-->
                <div class="post_image_frame col-12 col-md-5 p-0">
                    <img src="<?= $post["image"]; ?>" alt="Cool image.">
                </div>
            </div> <!-- closing row-->
        <?php
        endforeach;
        }

        ?>
</main> <!-- closing container-->

<?php
    include '../includes/footer-views.php';
?>

  <!-- Link dependencies for the editor -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
    /**
     * use the id of the textarea in the form to initialize this text-editor: #text
     */
    $(document).ready(function() {
        $('#text').summernote();
    });
</script>

