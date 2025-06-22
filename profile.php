<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile page</title>   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <nav class="navbar navbar-dark p-3" style="background-color: #457a48;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand d-flex allign-items-center">
                <img src="logo.jpeg" alt="site-logo" class="me-2">
                <span class="text-light">World of Floral Inspiration!</span>
            </a>
            <?php if (isset($_COOKIE['User'])): ?>
                <form action="/logout.php" method="POST" class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="story-cont mb-2">
            <div class="story-text">


            </head>
            <body>
                <h1>Welcome!</h1>

                <div class="quote">
                    <span class="emoji">🌸</span> "Flowers are the poetry of the earth, written with the colors of the sun and the scents of the wind." <span class="emoji">🌸</span>
                </div>
                
                <div class="section">
                    <p>Our website is created for true flower enthusiasts - both professionals and amateurs - who see in flowers not just plants, but art, emotions, and magic.</p>
                </div>
                


            </div>
            <img src="developer.png" alt="developer photo" class="dev-image">
        </div>
        <div class="text-center mt-4">
            <button id="toggleBtn" class="btn btn-primary">Open</button>
        </div>
        <div id="extraImage" class="mt-3 text-center" style="display: none;">  
            <img class="dev-img" src="hidden.jpg" alt="hidden_photo">
        </div>
    </div>
    <div class="mt-3">
        <h2 class="text-center mb-4">Add new post <?php $username1 = $_COOKIE['User']; echo "$username1";?></h2>

        <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> 

        <form action="profile.php" id="postForm" class="d:flex flex-column gap-3" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" form="postTitle">Post Title</label>
                <input type="text" name="postTitle" class="form-control user-input" id="postTitle" placeholder="Enter post Title" required>
            </div>
            <div class="form-group">
                <label class="form-label" form="postTitle">Post Content</label>
                <textarea name="postContent" class="form-control user-input" id="postContent" placeholder="Enter post content" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="file">Upload file</label>
                <input type="file" name="file" class="form-control user-input" id="file">
            </div>
            <div class="text-center"> 
            <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>

<?php
if (!isset($_COOKIE['User'])) {
    header('Location: /login.php');
    exit();
}

require_once('db.php');
$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'site_db');

if (isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $main_text = $_POST['postContent'];
    if (!$title || !$main_text) die ("no data post");
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text');";

    if (!mysqli_query($link,$sql)) die("Error while adding post to the database!");

    if(!empty($_FILES['file'])) {
        if (((@$_FILES['file']['type'] == 'image/png') || (@$_FILES['file']['type'] == 'image/jpeg') || (@$_FILES['file']['type'] == 'image/jpg') || (@$_FILES['file']['type'] == 'image/gif')
        || (@$_FILES['file']['type'] == 'image/x-png') || (@$_FILES['file']['type'] == 'image/pjpeg')) && (@$_FILES['file']['size'] < 102400))
    {
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'. $_FILES['file']['name']);
    echo 'Load in: ' . 'uploads/' . $_FILES['file']['name'];
    }
    else
    {
    echo 'upload failed!';
    }
    }
}
?>