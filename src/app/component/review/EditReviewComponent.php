<!DOCTYPE html>
<html lang="en">

<?php 
    $movie = $this->data['movie'];
    $edit = $this->data['edited'];
    if ($edit) {
        $review = $this->data['review'];
    }
?>
<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/review/edit-review.css">    
    <link rel="stylesheet" type="text/css" href="/styles/others/modal.css">   
    <script type="text/javascript" src="/js/others/debounce.js" defer></script>
    <?php if($edit): ?>
        <script type="text/javascript" src="/js/review/update-review.js" defer></script>
        <script type="text/javascript" defer>
            const reviewID = "<?= $review['review_id'] ?>";
        </script>
    <?php else: ?>
        <script type="text/javascript" src="/js/review/insert-review.js" defer></script>
        <script type="text/javascript" defer>
            const movieID = "<?= $movie['movie_id'] ?>";
        </script>
    <?php endif; ?>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <section class="edit-section">                
        <div class="movie-container">
            <img id="movie-img" src="../../../public/media/img/movie/<?= $movie['img_path'] ?>" alt="<?= $movie['title'] ?>">
            <h2 class="movie-desc"><?= $movie['title'] ?> (<?= $movie['year']?>)</h2>
        </div>
        <div class="form-container">
            <div class="edit-form" data="<?= $movie_id ?>">
                <header class="form-header">
                    <h1 class="form-title">
                        <?php if($edit) : ?>
                            Edit Review
                        <?php else : ?>
                            Add Review
                        <?php endif; ?>
                    </h1>
                </header>
                <div class="form-body">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input id="rate-input" class="form-input" name="rate" type="number" placeholder="1" min="1" max="10" 
                        <?php if($edit) : ?>
                            value=<?= $review['rate'] ?>
                        <?php else : ?>
                            value="10"
                        <?php endif; ?>
                        />
                        <i>
                            <p id="rate-warn" class="hide alert-text">Range rating hanya 1 - 10</p>
                        </i>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <?php if($edit) : ?>
                            <textarea id="comment-input" class="form-input" name="comment" type="text"><?= $review['comment'] ?></textarea>
                        <?php else : ?>
                            <textarea id="comment-input" class="form-input" name="comment" type="text" placeholder="Sebuah Deskripsi"></textarea>
                        <?php endif; ?>
                    </div>
                    <div class="form-horizontal">
                        <label for="blur">Blur your name ?</label>
                        <input id="blur-input" class="form-input-checkbox" name="blur" type="checkbox" placeholder="Sebuah Deskripsi" value="1" 
                        <?php if($edit && $review['is_blur_name']) : ?>
                            checked
                        <?php endif; ?>
                        />
                    </div>
                <div class="form-btns">
                    <div class="cancel-btn">
                        <button class="btn btn-primary">Discard</button>
                    </div>
                    <div class="submit-btn">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <dialog class="modal">
            <?php 
            if ($edit) {
                extract([
                    'titleInfo' => "Anda Akan Mengubah Review", 
                    'descInfo' => "Data yang telah diubah tidak dapat dikembalikan lagi. Apakah anda ingin melanjutkan ?"
                ]);
            } else {
                extract([
                    'titleInfo' => "Anda Akan Menambahkan Review", 
                    'descInfo' => "Data yang telah diunggah akan tertampil pada kolom komentar. Apakah anda ingin melanjutkan ?"
                ]);
            }
            include(dirname(__DIR__) . '/modal/ModalComponent.php')?>
        </dialog>
    </section>
</body>
</html>
