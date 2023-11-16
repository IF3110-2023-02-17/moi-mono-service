<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/post/post.css">
    <?php 
        $post = $this->data['post'];
    ?>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="post-container">
        <div class="post-header" style='background-image: url("/media/img/post/Abang2an.png");'>
            <h2 class="post-title"><?= $post->title ?></h2>
        </div>
        <div class="post-content">
            <div class="post-date">
                <h4><?= $post->updated_at ?></h4>
            </div>
            <div class="post-body">
                <p><?= $post->body ?></p>
            </div>
        </div>
    </div>
</body>
</html>