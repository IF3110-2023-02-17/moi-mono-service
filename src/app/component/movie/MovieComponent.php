<div class="movie-card">
    <a href="/movie/detail/<?= $movie["movie_id"] ?>" class="movie-thumbnail">
        <img class="movie-img" src="<?= STORAGE_URL ?>/img/movie/<?= $movie["img_path"] ?>" alt="<?= $movie["title"] ?>" />
    </a>
    <div class="movie-header">
        <h4 class="title"><?= $movie["title"] ?></p>
    </div>    
</div>
