<?php require 'config.php'; ?>

<?php
// Get blog ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the blog post
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

// If no blog found, redirect to homepage
if (!$blog) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['title']) ?> | Aminour Islam</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .blog-detail {
            max-width: 800px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        .blog-detail img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .blog-detail h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .blog-detail .date {
            color: #6c757d;
            margin-bottom: 30px;
        }
        .blog-detail .content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 30px;
            color: #3a86ff;
        }
    </style>
</head>
<body>
    <header>
        <div class="container nav-container">
            <a href="index.php" class="logo">Md<span>Aminour</span></a>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#blogs">Blogs</a></li>
                    <li><a href="index.php#projects">Projects</a></li>
                    <li><a href="index.php#skills">Skills</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <div class="blog-detail">
        <a href="index.php#blogs" class="back-link"><i class="fas fa-arrow-left"></i> Back to Blogs</a>
        <h1><?= htmlspecialchars($blog['title']) ?></h1>
        <div class="date"><?= date('F j, Y', strtotime($blog['created_at'])) ?></div>
        <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
        <div class="content">
            <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="index.php" class="footer-logo">Md<span>Aminour</span></a>
                <div class="footer-links">
                    <a href="index.php#home">Home</a>
                    <a href="index.php#about">About</a>
                    <a href="index.php#blogs">Blogs</a>
                    <a href="index.php#projects">Projects</a>
                    <a href="index.php#skills">Skills</a>
                    <a href="index.php#contact">Contact</a>
                </div>
                <p class="copyright">Copyright &copy; <span id="current-year"></span> MdAminour. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>