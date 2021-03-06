<?php
session_start();
include "includes/head-index.php";
include "includes/functions.php";

?>
<main class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 padding_top_content text-center">
            <?php 
            // If username is set in session, (if logged in), redirect to feed.php.
            if(isset($_SESSION["username"])){ 
            ?>
                <p><?php header("Location: views/feed.php"); ?> </p>
            <?php
            }
            ?>
            <img class="img-fluid"src="images/millhouse_logo.png" alt="Millhouse logotype">
        </div>
        <div class="col-12 col-md-10 col-lg-8 text_about_blog">
        <p> Millhouse is a former wholesale with a long history in selling accessories and interior products. As a first step to selling our products online we created this blog to make it easier for our customers to have their say. Stay tuned for our upcoming webshop!
            </p>
           <p><i>Luxury is in each detail.</i></p>
        </div>
    </div> <!-- closing row-->
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 accordion" id="accordionExample">
            <div class="row justify-content-center">
                <div class="col-10 col-md-6 col-lg-5">
                    <h5 class="mb-0">
                        <button class="btn btn-light btn-lg btn-block collapse_login_reg_button" type="button" data-toggle="collapse" aria-pressed="true" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">SIGN IN</button>
                    </h5>
                    <div id="collapseOne" class="collapse style_login_reg_form" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
                            // Function which echoes unique message if register fails
                            $text = access_denied_messages(
                                "login_failed", "Username or password is incorrect, please try again."
                            );
                            echo $text;
                            ?>
                            <form action="includes/login.php" method="POST">
                                <label for="login_username">Your Username</label>
                                <input name="username" id="login_username" type="text">
                                <label for="login_password">Your Password</label>
                                <input name="password" id="login_password" type="password">
                                <br>
                                <button class="submit_login_reg_button btn-block" type="submit">Sign in</button>
                            </form>
                        </div> <!-- closing card-body-->
                    </div> <!-- closing collapseOne-->
                </div> <!-- closing col-8 col-md-5-->
                <div class="col-10 col-md-6 col-lg-5">
                    <h5 class="mb-0">
                        <button class="btn btn-light btn-lg btn-block collapse_login_reg_button" type="button" data-toggle="collapse" data-toggle="button" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">REGISTER</button>
                    </h5>
                    <div id="collapseTwo" class="collapse style_login_reg_form" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                           <?php
                            // Function which echoes unique message if register fails
                            $text = access_denied_messages(
                                "register_failed", "You need to fill in all fields."
                            );
                            echo $text;
                            
                            // Function which echoes unique message if register fails
                            $text = access_denied_messages(
                                "register_failed_exist", "A user with this name already exists, try again."
                            );
                            echo $text;
                            ?>
                            <!-- form to register users. We created a column in users table called "admin"
                                for users who register we set a hidden value to "not_admin" that inputs in 
                                to this column. The admin user is set to is_admin directly in the database.
                                We did this so no one could set their role to admin from the website.
                            -->
                            <form action="includes/register.php" method="POST">
                                <label for="reg_usernam">Your Username</label>
                                <input name="username" id="reg_username" type="text">
                                <label for="reg_password">Your Password</label>
                                <input name="password" id="reg_password" type="password">
                                <label for="email">Your E-mail</label>
                                <input name="email" id="email" type="text">
                                <input name="admin" value="not_admin" type="hidden">
                                <input class="submit_login_reg_button btn-block" type="submit" value="Register">
                            </form>
                        </div><!-- closing card-body-->
                    </div><!-- closing collapseTwo-->
                </div>  <!-- closing col-8 col-md-5-->
            </div> <!-- closing row-->
        </div> <!-- closing accordition-->
    </div> <!-- closing row-->
</main>
<?php
include "includes/footer-index.php";
?>