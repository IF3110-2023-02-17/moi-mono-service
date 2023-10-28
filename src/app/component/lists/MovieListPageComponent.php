<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <script type="text/javascript" defer>
        const ADMIN = "<?= $this->data["isAdmin"] ?>";
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/lists/lists.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/modal.css">
    <script type="text/javascript" src="/js/edit/deleteMovie.js" defer></script>
    
    <script type="text/javascript" src="/js/others/pagination.js" defer></script>

</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="list-container">
        <div class="list-header">
            <h1> List of Movies </h1>
            <?php if ($this->data["isAdmin"]) : ?>
                <a href="/movie/insert" class="btn btn-primary">Add New</a>
            <?php endif; ?>
        </div>
        <div class="movie-container"></div>
        <?php include(dirname(__DIR__) . '/others/PaginationGroup.php') ?>
        <?php if ($this->data["isAdmin"]) : ?>        
            <dialog class="modal">
                <?php 
                extract([
                    'titleInfo' => "Anda Akan Menghapus Movie", 
                    'descInfo' => "Pastikan anda sudah yakin dengan pilihan anda. Apakah anda ingin melanjutkan ?"
                ]);
                include(dirname(__DIR__) . '/modal/ModalComponent.php')?>
            </dialog>
        <?php endif; ?>
    </div>
</body>
</html>