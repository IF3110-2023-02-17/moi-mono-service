<!DOCTYPE html>
<html lang="en">

<head>
    <title>User List Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/actor.css">
    <link rel="stylesheet" type="text/css" href="/styles/lists/lists.css">
</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="list-container">
        <div class="list-header">
            <h1>List of Users</h1>
        </div>
        <div class="actor-container">
            <?php foreach ($this->data['actor'] as $index => $actor) : ?>
                <? extract(["actor" => $actor]);
                include(dirname(__DIR__) . '/actor/ActorComponent.php');
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>