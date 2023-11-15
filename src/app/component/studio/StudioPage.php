<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/studio/dashboard.css">
    <script type="text/javascript" defer>
        const studio_id = "<?= $this->data['studio_id'] ?>";
        const _movieTotalPage = "<?= $this->data['movie_count'] ?>";
        const _movieCurrPage = "<?= $this->data['movie_page'] ?>";
        const _postTotalPage = "<?= $this->data['post_count'] ?>";
        const _postCurrPage = "<?= $this->data['post_page'] ?>";
        let movieTotalPage;
        let movieCurrPage;
        let postTotalPage;
        let postCurrPage;
    </script>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="studio-container">
        <div class="studio-movie">
            <div class="studio-movie-header">
                <h1><?= $this->data['studio_name']; ?></h1>
                <div class="btn-wrap">
                    <a href="/studio/menfess" class="btn btn-primary">Kirim Menfess</a>
                </div>
            </div>
            <div class="studio-movie-wrap">
                <?php extract([ 
                    'movies' => $this->data['movies'],
                    'movie_count' => $this->data['movie_count'],
                    'movie_page' => $this->data['movie_page'],
                ]); 
                    include(dirname(__DIR__) . '/studio/component/StudioMovieComponent.php') 
                ?>
            </div>
        </div>
        <div class="studio-post">
            <div class="studio-post-wrap">
                <?php extract([ 
                    'posts' => $this->data['posts'],
                    'post_count' => $this->data['post_count'],
                    'post_page' => $this->data['post_page'],
                ]); 
                include(dirname(__DIR__) . '/studio/component/StudioPostComponent.php') 
                ?>
            </div>
        </div>
    </div>
</body>
</html>