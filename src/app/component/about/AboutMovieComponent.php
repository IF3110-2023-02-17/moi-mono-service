<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Movie</title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutMovie.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="movie-container">
       
        <img id="movie-background" src="../../../public/media/img/movie/<?= $this->data['movie']['img_path'] ?>" alt="<?= $this->data['movie']['title'] ?>">
        <?php if ($this->data["isAdmin"]) : ?>
            <button id="updateContentButton"> <a href="http://localhost:8080/movie/update?movie_id=<?= $this->data['movie']['movie_id'] ?>">EDIT</a></button>
        <?php endif; ?>
        <h2 id="about-movie" class="text">
            about Movie,
        </h2>
        <img id="movie-img" src="../../../public/media/img/movie/<?= $this->data['movie']['img_path'] ?>" alt="<?= $this->data['movie']['title'] ?>">
        <video id="movie-trailer" controls>
            <source src="../../../public/media/img/trailer/<?= $this->data['movie']['trailer_path'] ?>" type="video/mp4">
        </video>
        <h1 id="movie-title" class="text">
            <?= $this->data['movie']['title'] ?>
        </h1>
        <p id="movie-release" class="text">
                <?= $this->data['movie']['year'] ?>
        </p>
        <p id="movie-duration" class="text">
                <?= $this->data['movie']['duration'] ?>
        </p>
        <div class="movie-director text">
            <?php foreach ($this->data['director'] as $key => $director): ?>
                <a href="/director/detail/<?= $director['director_id'] ?>" class="director-link">
                    <h3><?= $director['name'] ?></h3>
                </a>
                <?php if ($key !== array_key_last($this->data['director'])): ?>
                    <span> , </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="movie-cast text">
            <?php foreach ($this->data['actor'] as $key => $actor): ?>
                <a href="/actor/detail/<?= $actor['actor_id'] ?>" class="cast-link">
                    <span><?= $actor['name'] ?></span>
                </a>
                <?php if ($key !== array_key_last($this->data['actor'])): ?>
                    <span> | </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <p id="movie-description" class="text">
            <?= $this->data['movie']['description'] ?>
        </p>


    </div>
    
    <div id="review-container">
        <h2 id="review" class="text">
            REVIEW:
        </h2>
        <?php if(!$this->data["isAdmin"]) : ?>
            <button id="addReviewButton">
                <a href="http://localhost:8080/review/insert?movie_id=<?= $this->data['movie']['movie_id'] ?>">Add Review</a>
            </button>
        <? endif; ?>
        <div class="row">
            <?php if (empty($this->data['reviews'])): ?>
                <div class="review-card text">
                    <p>There are no reviews.</p>
                </div>
            <?php else: ?>
                <?php $count = 0; ?>
                
                    <?php foreach ($this->data['reviews'] as $review): ?>   
                            <?php if ($count >= 10) break; ?>
                                <?php if ($review) : ?>
                                    <div class="review-card text">
                                        <p class="review-content" ><?= $review['comment'] ?></p>
                                        <p>Rating: <?= $review['rate'] ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php $count++; ?>

                    <?php endforeach; ?>
                <?php endif; ?>
        </div>

        <!-- page navigation -->
        <div class="page-navigation">
            <div class="page">
                <?php if ($this->data['page'] > 1): ?>
                    <a href="<?= $this->data['movie']['movie_id'] ?>?page=<?= $this->data['page'] - 1 ?>">
                        <span class="material-icons">
                            <
                        </span>
                    </a>
                <?php endif; ?>
                <span class="page-number">
                    <?= $this->data['page'] ?>
                </span>
                <?php if ($this->data['page'] < $this->data['totalPage']): ?>
                    <a href="<?= $this->data['movie']['movie_id'] ?>?page=<?= $this->data['page'] + 1 ?>">
                        <span class="material-icons">
                            >
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        
            <form action="updateMovie" method="POST" enctype="multipart/form-data">
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Edit Content</h2>
                        <input type="hidden" id="idInput" name="idInput" />
                        <input type="hidden" id="oldImage" name="oldImage" value="<?= $this->data['movie']['img_path'] ?>"/>
                        <input type="hidden" id="oldTrailer" name="oldTrailer" value="<?= $this->data['movie']['trailer_path'] ?>"/>
                        <div class="form-group">
                            <label for="titleInput">Title:</label>
                            <input type="text" id="titleInput" class="form-control" name="titleInput"/>
                        </div>
                        <div class="form-group">
                            <label for="yearInput">Year:</label>
                            <input type="text" id="yearInput" class="form-control" name="yearInput"/>
                        </div>
                        <div class="form-group">
                            <label for="durationInput">duration:</label>
                            <input type="text" id="durationInput" class="form-control" name="durationInput"/>
                        </div>
                        <div class="form-group">
                            <label for="descriptionInput">Description:</label>
                            <textarea id="descriptionInput" class="form-control" name="descriptionInput"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imageInput">Image:</label>
                            <img id="update-img" src="../../../public/media/img/movie/<?= $this->data['movie']['img_path'] ?>" alt="<?= $this->data['movie']['title'] ?>">
                            <input type="file" id="imageInput" class="form-control" name="imageInput"/>
                        </div>
                        <div class="form-group">
                            <label for="trailerInput">Trailer:</label>
                            <video id="update-trailer" controls>
                                <source src="../../../public/media/img/trailer/<?= $this->data['movie']['trailer_path'] ?>" type="video/mp4">
                            </video>
                            <input type="file" id="trailerInput" class="form-control" name="trailerInput"/>
                        </div>
                        <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

    </div>
    
</body>
</html>