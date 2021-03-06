<?php
include "../includes/database-connection.php";

class CommentsInsert {

    private $pdo;

    public function __construct($pdo) {
      $this->pdo = $pdo;
    }

    public function insertComments() {
      //Redefine variables to make them more understandable and easier to use.
      // trip_tags to secure input fields from inserting harmful code to database.

      $created_by = $_SESSION["user_id"];
      $content = strip_tags($_POST["content"]);
      $post_id_insert = strip_tags($_POST["comment_post_id"]);
      date_default_timezone_set("Europe/Stockholm");
      $datetime = date('Y/m/d H:i');    

      $statement_insert_comment = $this->pdo->prepare("INSERT INTO comments
      (content, post_id, created_by, date) VALUES (:content, :post_id, :created_by, :date)");
      $statement_insert_comment->execute(
        [
          ":content" => $content,
          ":post_id" => $post_id_insert,
          ":created_by" => $created_by,
          ":date" => $datetime
        ]
      );
      
    $insert_comment = $statement_insert_comment;
    return $insert_comment;
    }
}

