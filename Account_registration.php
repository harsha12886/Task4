<?php
include 'database.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    if($username !== "" && $password !== ""){
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        echo "Registered successfully!";
    }else{
        echo "Please enter valid data.";
    }
}
?>
<form method="POST" action="">
    Username: 
    <input type="text" name="username" required maxlength="20" pattern="[A-Za-z0-9_]+" title="Only letters, numbers, and underscores"><br><br>
    
    Password: 
    <input type="password" name="password" required minlength="4" maxlength="25"><br><br>
    <input type="submit" value="Register">
</form>