<?php 
include "../includes/head-views.php" 
?>

    <main class="container">
    
        <section>

            <article class="feed_post row">
                <div class="col-8">
                    <h2 class="post_title"></h2>
                    <p class="date"></p>
                    <p class="category"></p>
                    <p class="content"></p>
                    <p class="number_of_comments"></p>
                    <a href=""><p class="comments"></p></a>
                </div>
                <div class="img_container col-4">
                    <img src="" alt="">
                </div>
            </article>

        </section>

        <form action="" class="form_comment">
            <textarea name="" id=""></textarea>
            <input type="submit">
        </form>
    </main>
    
    <?php
    include "../includes/footer-views.php" 
    ?>