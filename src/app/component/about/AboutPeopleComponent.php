<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About <?= $this->data['title']; ?></title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutPeople.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">

    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="people-container">
        <img id="people-background" src="../../../public/media/img/<?= $this->data['title']; ?>/<?= $this->data['people']['img_path'] ?>" alt="<?= $this->data['people']['img_path'] ?>">

        <!-- Edit -->
        <?php if ($this->data["isAdmin"]) : ?>
            <button id="updateContentButton">
                <?php if($this->data['title'] == 'Director') : ?>
                <a href="http://localhost:8080/director/update?director_id=<?= $this->data['people']['director_id'] ?>">Edit</a>

                <?php elseif($this->data['title'] == 'Actor') : ?>
                    <a href="http://localhost:8080/actor/update?actor_id=<?= $this->data['people']['actor_id'] ?>">Edit</a>
                
                <?php endif; ?>
            </button>
        <?php endif; ?>
        
        <!-- About -->
        <h2 id="about-people" class="text">
            about <?= $this->data['title']; ?>,
        </h2>
        <img id="people-img" src="../../../public/media/img/<?= $this->data['title']; ?>/<?= $this->data['people']['img_path'] ?>" alt="<?= $this->data['people']['img_path'] ?>">
        <h1 id="people-name" class="text">
            <?= $this->data['people']['name'] ?>
        </h1>
        <h2 id="people-birth" class="text">
            <?= $this->data['people']['birth_date'] ?>
        </h2>
        <p id="people-description" class="text">
            <?= $this->data['people']['description'] ?>
        </p>
    </div>
    
    <div class="people-movie-container">
        <h1 id="known-for" class="text">
            KNOWN FOR:
        </h1>
        <div class="row">
            <?php $count = 0; ?>
            
            <?php if(count($this->data['movie']) == 0) : ?>
                <h3 id="known-for" class="text">
            There are no movies.
                </h3>
            <?php else : ?>
                <?php foreach ($this->data['movie'] as $index => $movie) : ?>
                    <?php if ($count >= 6) break; ?>
                    <? extract(["movie" => $movie]);
                    include(dirname(__DIR__) . '/movie/MovieComponent.php');
                    ?>
                    <?php $count++; ?>
                <?php endforeach; ?>
            <?php endif;?>

        </div>

        <!-- page navigation -->
        <div class="page-navigation">
            <div class="page">
                <?php if ($this->data['page'] > 1): ?>
                    <a href="<?= $this->data['people']['actor_id'] ?>?page=<?= $this->data['page'] - 1 ?>">
                        <span class="material-icons">
                            <
                        </span>
                    </a>
                <?php endif; ?>
                <span class="page-number">
                    <?= $this->data['page'] ?>
                </span>
                <?php if ($this->data['page'] < $this->data['totalPage']): ?>
                    <a href="<?= $this->data['people']['actor_id'] ?>?page=<?= $this->data['page'] + 1 ?>">
                        <span class="material-icons">
                            >
                        </span>
                    </a>
                <?php endif; ?>
            </div>

            <form action="update<?= $this->data['title']; ?>" method="POST" enctype="multipart/form-data">
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Edit Content</h2>
                        <input type="hidden" id="idInput" name="idInput" />
                        <input type="hidden" id="oldImage" name="oldImage" value="<?= $this->data['people']['img_path'] ?>"/>
                        <!-- Input field for Name -->
                        <div class="form-group">
                            <label for="nameInput">Name:</label>
                            <input type="text" id="nameInput" class="form-control" name="nameInput"/>
                        </div>
                        <!-- Input field for Birthdate -->
                        <div class="form-group">
                            <label for="birthDateInput">Birthdate:</label>
                            <input type="text" id="birthDateInput" class="form-control" name="birthDateInput"/>
                        </div>
                        <!-- Textarea for Description -->
                        <div class="form-group">
                            <label for="descriptionInput">Description:</label>
                            <textarea id="descriptionInput" class="form-control" name="descriptionInput"></textarea>
                        </div>
                        <!-- Input field for Image URL -->
                        <div class="form-group">
                            <label for="imageInput">Image:</label>
                            <img id="update-img" src="../../../public/media/img/<?= $this->data['title']; ?>/<?= $this->data['people']['img_path'] ?>" alt="<?= $this->data['people']['img_path'] ?>">
                            <input type="file" id="imageInput" class="form-control" name="imageInput"/>
                            
                        </div>
                        <!-- Save Button -->
                        <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

    </div>

   
</body>
</html>