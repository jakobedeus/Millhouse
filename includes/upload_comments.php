<?php
session_start();
include 'database-connection.php';


$created_by = $_SESSION["user_id"];
$content = $_POST["content"];
$post_id = $_SESSION["post_id"];

/*var_dump($created_by);
var_dump($content);
var_dump($_SESSION["post_id"]);*/






$statement = $pdo->prepare("INSERT INTO comments
(content, post_id, created_by) VALUES (:content, :post_id, :created_by)");

$statement->execute(
  [
    ":content" => $content,
    ":post_id" => $post_id,
    ":created_by" => $created_by
  ]
);




$fetch_all_comments_statement = $pdo->prepare("SELECT * FROM comments WHERE post_id = :post_id");
$fetch_all_comments_statement->execute(
  [
    ":post_id" => $post_id
  ]
);

$comments_for_specific_post = $fetch_all_comments_statement->fetchAll(PDO::FETCH_ASSOC);


header ('location: ../views/post.php');
