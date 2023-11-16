<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <?php 
        $post = $this->data;
    ?>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="menfess-container">
        <div class="menfess-header">
            <h2>Kirim Menfess ke <?=  $post['studio_name'] ?></h2>
        </div>
    </div>
</body>
</html>