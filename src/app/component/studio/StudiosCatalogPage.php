<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/modal.css">
    <link rel="stylesheet" type="text/css" href="/styles/studio/catalog.css">

    <script type="text/javascript" src="/js/studio/catalog.js" defer></script>
    <script type="text/javascript" defer>
        const countPage = "<?= $this->data['countPage'] ?>";
        const currentPage = "<?= $this->data['currPage'] ?>";
    </script>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <header class="studio-header">
        <div class="title"><h1>List of Studios</h1></div>
    </header>
    <section class="studio-section">                
        <div class="studio-container">
            <?php foreach ($this->data['studio'] as $index => $studio) : ?>
                <?php extract([ 'studio' => $studio]);
                include(dirname(__DIR__) . '/studio/StudioCardComponent.php') 
                ?>
            <?php endforeach; ?>
        </div>
        <?php include(dirname(__DIR__) . '/others/PaginationGroup.php') ?>
        <dialog class="modal">
            <?php extract([
                'titleInfo' => "Anda Akan Menghapus Review", 
                'descInfo' => "Data yang telah dihapus tidak dapat dikembalikan lagi. Apakah anda ingin melanjutkan ?"
            ]);
            include(dirname(__DIR__) . '/modal/ModalComponent.php')
            ?>
        </dialog>
    </section>
</body>
</html>
