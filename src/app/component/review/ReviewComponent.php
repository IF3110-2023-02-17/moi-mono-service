<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/review/review.css">    
    <link rel="stylesheet" type="text/css" href="/styles/others/modal.css">    
    <script type="text/javascript" src="/js/review/delete-review.js" defer></script>
    <script type="text/javascript" src="/js/review/review.js" defer></script>
    <script type="text/javascript" defer>
        <?php if($this->data['isAdmin']): ?>            
            const ADMIN = true;
        <?php else: ?>
            const ADMIN = false;
        <?php endif; ?>
    </script>

</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <header class="review-header">
        <?php if (!$this->data['isAdmin']) : ?>
            <div class="title"><h1>Your Reviews</h1></div>
        <?php else: ?>
            <div class="title"><h1>All Reviews</h1></div>
        <?php endif; ?>
    </header>
    <section class="review-section">                
        <div class="review-container"></div>
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
