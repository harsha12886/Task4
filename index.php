<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'database.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : "";
$like = "%$search%";

if ($search !== "") {
    $sql = "SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY time_stamp DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $like, $like, $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $count_sql = "SELECT COUNT(*) AS total FROM posts WHERE title LIKE ? OR content LIKE ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("ss", $like, $like);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total_posts = $count_result->fetch_assoc()['total'];
} else {
    $sql = "SELECT * FROM posts ORDER BY time_stamp DESC LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $count_result = $conn->query("SELECT COUNT(*) AS total FROM posts");
    $total_posts = $count_result->fetch_assoc()['total'];
}

$total_pages = ceil($total_posts / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Welcome, <?= $_SESSION['username'] ?></h3>
        <div>
            <a href="add.php" class="btn">+ Add Post</a>
            <a href="logout.php" class="btn" style="background-color: #dc3545;">Logout</a>
        </div>
    </div>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search posts..." value="<?= htmlspecialchars($search) ?>">
        <input type="submit" class="btn" value="Search">
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['content'] ?></td>
                        <td><?= $row['time_stamp'] ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">No posts found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="<?= ($page == $i) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>