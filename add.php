<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
include 'database.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $content = trim(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);
    if($stmt->execute()){
        header("Location: index.php");
        exit();
    }else{
        echo "Error: " . $stmt->error;
    }
}
?>
<form method="POST" action="">
    Title:<br>
    <input type="text" name="title" required maxlength="100"><br><br>

    Content:<br>
    <textarea name="content" rows="5" cols="40" required maxlength="500"></textarea><br><br>
    <input type="submit" value="Post">
</form>